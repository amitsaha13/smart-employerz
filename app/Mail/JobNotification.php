<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $candidate;
    public $job;

    public function __construct($candidate, $job)
    {
        $this->candidate = $candidate;
        $this->job = $job;
    }

    public function build()
    {
        return $this->view('emails.job_notification')
                    ->with([
                        'candidate' => $this->candidate,
                        'job' => $this->job,
                    ]);
    }
}
