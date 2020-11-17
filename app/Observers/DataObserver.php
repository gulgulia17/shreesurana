<?php

namespace App\Observers;

use App\Models\Data;

class DataObserver
{
    /**
     * Handle the data "created" event.
     *
     * @param  \App\Models\Data  $data
     * @return void
     */
    public function created(Data $data)
    {
        //
    }

    /**
     * Handle the data "updated" event.
     *
     * @param  \App\Models\Data  $data
     * @return void
     */
    public function updated(Data $data)
    {
        //
    }

    /**
     * Handle the data "deleted" event.
     *
     * @param  \App\Models\Data  $data
     * @return void
     */
    public function deleted(Data $data)
    {
        $data->users()->detach();
    }

    /**
     * Handle the data "restored" event.
     *
     * @param  \App\Models\Data  $data
     * @return void
     */
    public function restored(Data $data)
    {
        //
    }

    /**
     * Handle the data "force deleted" event.
     *
     * @param  \App\Models\Data  $data
     * @return void
     */
    public function forceDeleted(Data $data)
    {
        //
    }
}
