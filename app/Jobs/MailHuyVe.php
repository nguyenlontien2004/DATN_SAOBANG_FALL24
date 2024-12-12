<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MailHuyVe implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $email;
    public $ves;
    public function __construct($email,$ves)
    {
        $this->email = $email;
        $this->ves = $ves;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::send('mail.mailhuyve', ['ves'=>$this->ves], function ($message) {
            $message->to($this->email)
                ->subject('Huỷ vé vì một vài lý do');
        });
    }
}
