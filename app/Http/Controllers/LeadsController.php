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


        // $data = $lead->whereHas('users', function ($query) use ($lead) {
        //     $query->where(['data_id' => $lead->id, 'user_id' => Auth::id()]);
        // })->first();

        // abort_if(!$data, 404);
        $validated = $request->validate([
            'data_id' => 'exists:data,id',
            'user_id' => 'exists:users,id',
            'later' => 'sometimes',
            'response_id' => 'required|exists:responses,id',
            'remark' => 'required|min:3',
        ]);
        if (!array_key_exists('later', $validated)) {
            $validated['later'] = null;
        }

        Lead::updateOrCreate(
            [
                'data_id' => $request->data_id,
                'user_id' => $request->user_id,
            ],
            $validated
        );

        return redirect(route('home'))->with('success', 'Successfully');
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
