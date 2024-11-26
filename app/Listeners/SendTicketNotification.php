<?php

namespace App\Listeners;

use App\Events\OrderSuccess;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\ThongTinVe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SendTicketNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderSuccess $event): void
    {
        $ve = $event->ve;
        $food = $event->food;
        $ghe = $event->ghe;
        $urlCode=$event->urlCode;
        $emaiUser = $event->emaiUser;
        log::info($ve);
        
        Mail::to($emaiUser)->send(new ThongTinVe($ve,$food,$ghe,$urlCode));
    }
}
