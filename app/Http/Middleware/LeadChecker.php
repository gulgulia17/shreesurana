<?php

namespace App\Http\Middleware;

use App\Models\Lead;
use Closure;

class LeadChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    private $is_allowed = true;
    public function handle($request, Closure $next)
    {
        $leads = Lead::with('response','data')
            ->get()->filter(function ($lead) {
                if (!$lead->is_allowed) {
                    $this->is_allowed = false;
                    return $lead;
                }
            });
        if (!$this->is_allowed) {
            return redirect(route('leads.pending'))->with(['leads' => $leads]);
        }
        return $next($request);
    }
}
