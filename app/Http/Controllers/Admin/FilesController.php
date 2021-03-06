<?php

namespace App\Http\Controllers\Admin;

use App\Models\File;
use App\Imports\DataImport;
use Illuminate\Http\Request;
use App\DataTables\FilesDataTable;
use App\Http\Controllers\Controller;
use Faker\Factory as Faker;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FilesDataTable $dataTable)
    {
        return $dataTable->render('admin.filemanager.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(File $file)
    {
        return view('admin.filemanager.create', [
            'file' => $file,
            'companies' => \App\Models\Company::orderBy('name', 'ASC')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->storeImage(File::create($this->validateRequest($request)));
        if ($data->extracted) {
            return $this->import($data);
        }
        return back()->with('success', 'Uploaded Successfully');
    }

    public function import(File $files)
    {
        set_time_limit(600);
        $import = new DataImport($files);
        $import->import($files->file);

        $fails = [];

        foreach ($import->failures() as $failure) {
            $fails = array_merge($fails, $failure->errors());
        }

        if (count($fails)) {
            return back()->with([
                'error' => 'Some data skiped to be extracted due to errors.',
                'data' => array_unique($fails),
            ]);
        }
        $files->update(['extracted' => 1]);
        return back()->with('success', 'Data extracted successfully');
    }

    public function attach(Request $request, File $files)
    {
        if ($request->ajax()) {
            return response([
                'total' => count($files->data),
                'users' => \App\User::all(),
            ]);
        }

        if ($request->method() == 'POST') {
            $request->validate([
                'total' => 'required|numeric|min:0',
                'start' => "required|numeric|min:0|lte:total",
                'end' => "required|numeric|gte:start|lte:total",
                'user' => "required|exists:users,id"
            ], [
                'lte' => 'The :attribute must be less than or equal to total.',
                'gte' => 'The :attribute must be less than or equal to total.',
            ]);

            $dataID = \App\Models\Data::skip($request->start)
                ->take($request->end)->pluck('id');

            $userHasData = \App\User::whereHas('data', function ($query) use ($dataID) {
                $query->whereIn('data_id', $dataID);
            })->where('id', '!=', $request->user)->exists();

            if ($userHasData)
                return back()->with('error', 'Given data already attached');

            \App\User::find($request->user)->data()
                ->syncWithoutDetaching($dataID);

            return back()->with('success', 'Assigned Successfully');
        }
    }

    public function show(File $file)
    {
        return $file;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        return view('admin.filemanager.edit', [
            'file' => $file,
            'companies' => \App\Models\Company::orderBy('name', 'ASC')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        $validated = $request->validate([
            "name" => 'required|string|min:5',
            "description" => 'sometimes',
            "companies_id" => "required|exists:companies,id",
        ]);

        $file->update($validated);
        return redirect(route('files.index'))->with('success', 'Updated Successfully');
    }

    public function validateRequest($request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:5',
            'description' => 'sometimes',
            'extracted' => 'sometimes',
            'file' => 'required|file|max:10000',
            "companies_id" => "required|exists:companies,id",
        ]);

        $data['extracted'] = $data['extracted'] ?? 0;

        return $data;
    }

    public function storeImage($data)
    {
        if (request()->hasfile('file')) {
            $imageName = time() . '.' . $data->file->getClientOriginalExtension();
            $imagePath = "assets/files/$imageName";
            $data->file->move(public_path('assets/files'), $imageName);
            $data->file = $imagePath;
            $data->save();
        }
        return $data;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        $file->data()->each(function ($query) {
            $query->users()->detach();
            $query->forceDelete();
        });
        $file->delete();
        return back()->with('success', 'Deleted Successfully.');
    }
}
