<?php

namespace App\Listeners;

use App\Models\Copy;
use App\Events\CopyWasLoaned;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateCopyStatus
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CopyWasLoaned  $event
     * @return void
     */
    public function handle(CopyWasLoaned $event)
    {
        Copy::findOrFail($event->copy)->update([
            'state' => 'Prestado'
        ]);
    }
}
