<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.filemanager.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.filemanager.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->storeImage(File::create($this->validateRequest($request)));
        return back()->wuth('success', 'Uploaded Successfully');
    }

    
    public function attach(Request $request)
    {
        return $request;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(File $files)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function validateRequest($request)
    {
        return $request->validate([
            'name' => 'required|string|min:5',
            'description' => 'sometimes',
            'file' => 'required|file|max:10',
        ]);
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
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
