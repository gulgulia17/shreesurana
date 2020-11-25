<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use App\DataTables\LeadsDataTable;
use App\DataTables\PendingLeadDataTable;
use Illuminate\Support\Facades\Validator;

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

    public function update(Request $request, $id)
    {
        $request->merge([
            'data_id' => $id,
            'user_id' => auth()->id(),
        ]);

        $validation = Validator::make($request->all(), [
            'data_id' => 'exists:data,id',
            'user_id' => 'exists:users,id',
            'closed' => 'sometimes',
        ]);

        if ($validation->fails()) {
            return response(['success' => false, 'errors' => $validation->errors()]);
        }

        $lead = $this->previoudLead($request->data_id, $request->user_id);

        if (!$lead) {
            $lead = Lead::create($validation->getData());
        }

        $lead->update(['closed' => 1]);

        return response(['success' => true, 'data' => $lead]);
    }

    public function pending(PendingLeadDataTable $dataTable,Lead $model)
    {
        return $dataTable->render('pages.leads.pending');
        // $pending = $request->session()->get('leads') ? $request->session()->get('leads')->load('data') : [];
        // if (!$pending) {
        //     $pending = $this->getPending();
        // }
        // return view('pages.leads.pending', ['leads' => $pending]);
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

        $leadPrevios = $this->previoudLead($request->data_id, $request->user_id);

        if ($leadPrevios) {
            $leadPrevios->update(['later' => null]);
        }

        Lead::create($validated);

        return redirect(route('leads.index'))->with('success', 'Successfully');
    }

    private function getPending()
    {
        return Lead::with('response', 'data')
            ->get()->filter(function ($lead) {
                if (!$lead->is_allowed) {
                    $this->is_allowed = false;
                    return $lead;
                }
            });
    }

    /**
     * @param \App\Models\Data $data_id | ID of data model
     * @param \App\User $user_id | ID of user model
     * @return Lead $lead | Collection of Lead Model
     */

    private function previoudLead(int $data_id, int $user_id, int $closed = 0)
    {
        return Lead::where([
            'data_id' => $data_id,
            'user_id' => $user_id,
            'closed' => $closed
        ])->first();
    }
}
