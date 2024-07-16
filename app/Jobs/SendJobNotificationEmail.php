<?php

namespace App\Jobs;

use App\Mail\JobNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendJobNotificationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $candidateData;
    protected $jobData;

    public function __construct($candidate, $job)
    {
        $this->candidateData = $candidate;
        $this->jobData = $job;
    }

    public function handle()
    {
        try {
            Mail::to($this->candidateData->email)
                ->send(new JobNotification($this->candidateData, $this->jobData));
        } catch (\Throwable $th) {
            LogErrors($th);
        }
    }
}


