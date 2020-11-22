<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use App\DataTables\LeadsDataTable;

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

    public function pending(Request $request)
    {
        $pending = $request->session()->get('leads') ? $request->session()->get('leads')->load('data') : [];
        if (!$pending) {
            $pending = $this->getPending();
        }
        return view('pages.leads.pending', ['leads' => $pending]);
    }

    public function action(Request $request, $lead)
    {
        $request->merge([
            'data_id' => $lead,
            'user_id' => auth()->id(),
        ]);

        $validated = $request->validate([
            'data_id' => 'exists:data,id',
            'user_id' => 'exists:users,id',
            'later' => 'sometimes',
            'closed' => 'sometimes',
            'response_id' => 'required|exists:responses,id',
            'remark' => 'required|min:3',
        ]);

        if (!$validated['later']) {
            $validated['closed'] = 1;
        }

        $leadPrevios = Lead::where(['data_id' => $request->data_id, 'user_id' => $request->user_id, 'closed' => 0])->first();

        if ($leadPrevios) {
            $leadPrevios->update(['later' => null]);
        }

        Lead::create($validated);

        return redirect(route('leads.index'))->with('success', 'Successfully');
    }

    private function getPending()
    {
        return Lead::all()->filter(function ($lead) {
            if (!$lead->is_allowed) {
                $this->is_allowed = false;
                return $lead;
            }
        });
    }
}
