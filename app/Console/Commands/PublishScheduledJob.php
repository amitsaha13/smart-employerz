<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Job; 
use App\Models\DraftJob; 
use App\Models\JobApplication;
use App\Jobs\SendJobNotificationEmail;

class PublishScheduledJob extends Command
{
    
    protected $signature = 'publish-scheduled-job';
    protected $description = 'Publish scheduled jobs by updating their status';

    public function handle()
    {
        try {
            $today = Carbon::today();
            $tomorrow = Carbon::tomorrow();
            $allPendingJobs = Job::where('publish_date', '<', $tomorrow)
                    ->where('publish_date', '>', $today)
                    ->where('status', 0 )
                    ->where('deadline', '>', $today )
                    ->select('id', 'recruiter_id', 'job_title', 'business_area', 'status', 'publish_date', 'deadline' )
                    ->get();

            foreach ($allPendingJobs as $key => $job) 
            {
                $job->status = 1;
                // $update = $job->save();
                $update = 1;

                if ($update) {
                    $this->info('JOB ID '. $job->id.' has been published');
                }

                // Email the old candidates of this Company for this category Job post
                $candidates  = DB::table('job_applications')->where('job_category_id', $job->business_area)
                                ->select('job_id','job_category_id','job_seeker_id','email')
                                ->get();

                if ($candidates->isEmpty()) {
                    $this->info('No candidates found for job category ' . $job->business_area);
                    continue;
                }

                foreach ($candidates as $candidate) {
                    SendJobNotificationEmail::dispatch($candidate, $job);
                    $this->warn($candidate->email);
                }

            }
        } catch (\Throwable $th) {
            LogErrors($th);
        }

    }
}
