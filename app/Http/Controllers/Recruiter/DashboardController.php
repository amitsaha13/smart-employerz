<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Job;
use App\Models\JobApplication;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $recruiterId = Auth::guard('recruiter')->user()->id;

            // Job categories counts 
            $jobCounts = Job::where('recruiter_id', $recruiterId)
                        ->select(
                            DB::raw('SUM(CASE WHEN status = 1 AND deadline > NOW() THEN 1 ELSE 0 END) as active_count'),
                            DB::raw('SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) as pending_count'),
                            DB::raw('SUM(CASE WHEN deadline < NOW() THEN 1 ELSE 0 END) as expired_count'),
                            DB::raw('SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) as draft_count')
                        )
                        ->first();
            
            // Recent Applicants
            $jobs = Job::where('recruiter_id', $recruiterId)
                    ->where('deadline', '>',  Carbon::now())
                    ->select('id','job_title')
                    ->get();

            $jobIds = $jobs->pluck('id');
            // Fetch all job applications for those jobs
            $jobApplicationsQuery = JobApplication::whereIn('job_id', $jobIds);

            // Get the total count of job applications
            $totalApplicants = $jobApplicationsQuery->count();

            // Get the latest 3 job applications
            $recentJobApplications = $jobApplicationsQuery->with('job')
                                ->orderBy('id', 'DESC')
                                ->take(5)
                                ->get();

            foreach ($recentJobApplications as $application) {
                $application->current_job_detail = json_decode($application->current_job_detail);
            }
            // dd($recentJobApplications);

            return view('recruiter.recruiter-dashboard',compact('jobCounts', 'recentJobApplications', 'totalApplicants'));
        } catch (\Throwable $th) {
            LogErrors($th);
            return view('400');
        }
    }
}
