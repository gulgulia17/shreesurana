<?php

namespace App\Http\Controllers;

use App\DataTables\LeadsDataTable;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LeadsDataTable $dataTable)
    {
        return $dataTable->render('pages.leads.index');
    }
}
