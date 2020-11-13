<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Lead;
use Illuminate\Http\Request;
use App\DataTables\LeadsDataTable;
use Illuminate\Support\Facades\Auth;

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

    public function action(Request $request, Data $lead)
    {
        $data = $lead->whereHas('users', function ($query) use ($lead) {
            $query->where(['data_id' => $lead->id, 'user_id' => Auth::id()]);
        })->first();

        abort_if(!$data, 404);

        return $request->all();
    }
}
