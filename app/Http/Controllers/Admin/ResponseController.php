<?php

namespace App\Http\Controllers\Admin;

use App\Models\Response;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ResponseDataTable;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ResponseDataTable $dataTable)
    {
        return $dataTable->render('admin.response.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Response $response)
    {
        return view('admin.response.create', compact('response'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Response::create($this->validateRequest($request));
        return back()->with('success', 'Inserted Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function show(Response $response)
    {
        return view('admin.response.show', compact('response'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function edit(Response $response)
    {
        return view('admin.response.edit', compact('response'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Response $response)
    {
        $response->update($this->validateRequest($request));
        return back()->with('success', 'Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function destroy(Response $response)
    {
        $response->delete();
        return back()->with('success', 'Deleted Successfully.');
    }

    public function validateRequest($request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'color' => 'required',
        ]);
        
        $request->merge([
            'jsid' => Str::slug($request->name),
        ]);

        return $request->all();
    }
}
