<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\JobSeekerMail;
use App\Mail\SendOTPMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\Recruiter;
use App\Models\JobSeeker;
use App\Models\JobApplication;



class JobSeekerManagementController extends Controller
{
    // Get All Applicants
    public function getAllApplicants()
    {
        try {
            $recruiterId = Auth::guard('recruiter')->user()->id;

            // Fetch the recruiter with jobs and job applications
           // Fetch all jobs for the recruiter
            $jobIds = Job::where('recruiter_id', $recruiterId)->pluck('id');

            // Fetch all job applications for those jobs
            $allJobApplications = JobApplication::whereIn('job_id', $jobIds)->with('job')->get();
            // foreach ($allJobs as $key => $allJob) {
            //     dd($allJob->jobApplications);
            // }
            // dd($allJobApplications);


            // // Flatten the job applications collection, including job information
            // $jobApplications = $recruiter->jobs->flatMap(function ($job) {
            //     return $job->jobApplications->map(function ($jobApplication) use ($job) {
            //         $jobApplication->job = $job;
            //         return $jobApplication;
            //     });
            // });
            // dd($jobApplications);
            return view('recruiter.all-applicants', compact('allJobApplications'));
        } catch (\Throwable $th) {
            LogErrors($th);
            return view('400');
        }
    }
    
    public function sendIndividualEmailToJobSeeker(Request $request, $jobSeekerId = 1)
    {
        try {
            $jobSeeker = JobSeeker::findOrFail($jobSeekerId); // Fetch the specific job seeker
            Mail::to($jobSeeker->email)->send(new SendOTPMail($jobSeeker));
            return redirect()->back()->with('info', 'Email sent to the job seeker.');
        } catch (\Throwable $th) {
            LogErrors($th);
            return view('400');
        }
    }

    public function sendBulkEmailToJobSeekers(Request $request)
    {
        try {
            $jobSeekers = JobSeeker::all(); // Retrieve job seekers from database
            foreach ($jobSeekers as $jobSeeker) {
                Mail::to($jobSeeker->email)->queue(new JobSeekerMail($jobSeeker));
            }
            return redirect()->back()->with('info', 'Bulk emails queued for sending.');

        } catch (\Throwable $th) {
            LogErrors($th);
            return view('400');
        }
    }

    // public function fetchJobDetailsByAI()
    // {
    //     // The static JSON response you provided
    //     $staticResponse = '{
    //         "id": "cmpl-8Yz07ZK17QCnVqLCdnWQI6HQbMndE",
    //         "object": "text_completion",
    //         "created": 1703348331,
    //         "model": "gpt-3.5-turbo-instruct",
    //         "choices": [
    //             {
    //             "text": "\n\nJob Description:\n\nThe Assistant Engineer (Electrical) will support the Electrical Engineer in planning, designing, and overseeing the installation and maintenance of electrical systems for various projects. They will work in collaboration with the project team to ensure that all electrical systems are installed and functioning properly. \n\nResponsibilities:\n- Assist the Electrical Engineer in designing and reviewing electrical system layouts \n- Participate in site visits to assess electrical system requirements and provide recommendations \n- Prepare technical specifications and cost estimates for electrical equipment and materials \n- Collaborate with contractors and vendors to ensure timely delivery of materials and equipment \n- Monitor and inspect the installation of electrical systems to ensure compliance with project specifications \n- Troubleshoot and resolve any issues related to electrical systems \n- Conduct regular maintenance checks on electrical systems to ensure they are functioning properly \n- Keep track of project progress and provide regular status updates to the Electrical Engineer \n- Comply with all safety regulations and standards \n\nRequired Skills:\n- Bachelor’s degree in Electrical Engineering or a related field \n- Minimum of 5 years of experience working as an Assistant Engineer (Electrical) \n- In-depth knowledge of electrical systems and components \n- Proficient in reading and interpreting electrical plans and specifications \n- Familiarity with AutoCAD and other industry-specific software \n- Strong analytical and problem-solving skills \n- Excellent communication and interpersonal skills \n- Time management and organizational abilities \n- Ability to work well in a team and independently \n- Knowledge of relevant codes and regulations \n- Willingness to work on-site and travel to project locations \n- Possess a valid driver’s license.",
    //             "index": 0,
    //             "logprobs": null,
    //             "finish_reason": "stop"
    //             }
    //         ],
    //         "usage": {
    //             "prompt_tokens": 19,
    //             "completion_tokens": 319,
    //             "total_tokens": 338
    //         }
    //     }';

    //     // Decode the JSON response
    //     $responseData = json_decode($staticResponse, true);

    //     // Return the decoded JSON response
    //     return $responseData['choices'][0]['text'];
    // }

    
    public function createJob()
    {
        try {
            return view('recruiter.create-job');
        } catch (\Throwable $th) {
            LogErrors($th);
            return view('400');
        }
    }

    

    


}
