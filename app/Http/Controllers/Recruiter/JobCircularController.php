<?php
namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobSeeker;
use App\Models\Recruiter\Job;
use App\Models\Admin\JobCategory;
use App\Models\Admin\JobLevel;
use App\Models\Admin\Currency;
use App\Models\Admin\CompensationAndBenefit;
use App\Models\Recruiter\DraftJob;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\JobSeekerMail;
use App\Mail\SendOTPMail;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;


class JobCircularController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::guard('recruiter')->user();
            $countries = DB::table('countries')->get();
            $jobCategories = JobCategory::where('status', 1)->get();
            $jobLevels = JobLevel::where('status', 1)->get();
            $currencies = Currency::all();
            // dd($jobLevels, $currencies);
            return view('recruiter.create-new-job', compact('user','countries','jobCategories','jobLevels','currencies'));
        } catch (\Exception $e) {
            \Log::error('Error in JobCircularController[index]: ' . $e->getMessage());
            abort(500, 'Something went wrong. Please try again later.');
        }
    }
    // public function fetchJobDetailsByAI(Request $request)
    // {
    //     // dd($request->all());
    //     // The static JSON response you provided
    //     $staticResponse = '{
    //         "id": "cmpl-8Yz07ZK17QCnVqLCdnWQI6HQbMndE",
    //         "object": "text_completion",
    //         "created": 1703348331,
    //         "model": "gpt-3.5-turbo-instruct",
    //         "choices": [
    //             {
    //                 "text": "\n\nJob Description:\n\nThe Assistant Engineer (Electrical) will support the Electrical Engineer in planning, designing, and overseeing the installation and maintenance of electrical systems for various projects. They will work in collaboration with the project team to ensure that all electrical systems are installed and functioning properly!. \n\nResponsibilities:\n- Assist the Electrical Engineer in designing and reviewing electrical system layouts \n- Participate in site visits to assess electrical system requirements and provide recommendations \n- Prepare technical specifications and cost estimates for electrical equipment and materials \n- Collaborate with contractors and vendors to ensure timely delivery of materials and equipment \n- Monitor and inspect the installation of electrical systems to ensure compliance with project specifications \n- Troubleshoot and resolve any issues related to electrical systems \n- Conduct regular maintenance checks on electrical systems to ensure they are functioning properly \n- Keep track of project progress and provide regular status updates to the Electrical Engineer \n- Comply with all safety regulations and standards! \n\nRequired Skills:\n- Bachelor’s degree in Electrical Engineering or a related field \n- Minimum of 5 years of experience working as an Assistant Engineer (Electrical) \n- In-depth knowledge of electrical systems and components \n- Proficient in reading and interpreting electrical plans and specifications \n- Familiarity with AutoCAD and other industry-specific software \n- Strong analytical and problem-solving skills \n- Excellent communication and interpersonal skills \n- Time management and organizational abilities \n- Ability to work well in a team and independently \n- Knowledge of relevant codes and regulations \n- Willingness to work on-site and travel to project locations \n- Possess a valid driver’s license!",
    //                 "index": 0,
    //                 "logprobs": null,
    //                 "finish_reason": "stop"
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

    //     // Extract Job Description
    //     $jobDescription = $this->extractSection($responseData['choices'][0]['text'], 'Job Description:', 'Responsibilities:');
    //     // Extract Responsibilities
    //     $responsibilities = $this->extractSection($responseData['choices'][0]['text'], 'Responsibilities:', 'Required Skills:');
    //     // Extract Required Skills
    //     $requiredSkills = $this->extractSection($responseData['choices'][0]['text'], 'Required Skills:');

    //     // Return the sections as an associative array
    //     return [
    //         'Job Description' => $jobDescription,
    //         'Responsibilities' => $responsibilities,
    //         'Required Skills' => $requiredSkills,
    //     ];
    // }

    // public function fetchJobDetailsByAI(Request $request)
    // {
    //     $jobTitle = $request->jobTitle;
    //     $max_experience = $request->maxExperience;

    //     $url = 'https://api.openai.com/v1/completions';
    //     $api_key = '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';
    //     // $prompt = 'provide Job description, required skills of Senior Software engineer(Laravel) of 3 years of experience';
    //     $prompt = 'provide Job description, required skills of '.$jobTitle.' of '.$max_experience.' of experience';
    //     $payload = [
    //         'model' => 'gpt-3.5-turbo-instruct',
    //         'prompt' => $prompt,
    //         'max_tokens' => 350
    //     ];

    //     $headers = [
    //         'Authorization' => 'Bearer '.$api_key,
    //         'Content-Type' => 'application/json',
    //     ];

    //     $response = Http::withHeaders($headers)->post($url, $payload);
    //     if (!$response->successful()) {
    //         return response()->json([
    //             'success' => false
    //         ], 200);
    //     } 
       
    //     // The static JSON response for testing
    //     $response = '{
    //         "id": "cmpl-8Yz07ZK17QCnVqLCdnWQI6HQbMndE",
    //         "object": "text_completion",
    //         "created": 1703348331,
    //         "model": "gpt-3.5-turbo-instruct",
    //         "choices": [
    //             {
    //                 "text": "\n\nJob Description:\n\nThe Assistant Engineer (Electrical) will support the Electrical Engineer in planning, designing, and overseeing the installation and maintenance of electrical systems for various projects. They will work in collaboration with the project team to ensure that all electrical systems are installed and functioning properly!. \n\nResponsibilities:\n- Assist the Electrical Engineer in designing and reviewing electrical system layouts \n- Participate in site visits to assess electrical system requirements and provide recommendations \n- Prepare technical specifications and cost estimates for electrical equipment and materials \n- Collaborate with contractors and vendors to ensure timely delivery of materials and equipment \n- Monitor and inspect the installation of electrical systems to ensure compliance with project specifications \n- Troubleshoot and resolve any issues related to electrical systems \n- Conduct regular maintenance checks on electrical systems to ensure they are functioning properly \n- Keep track of project progress and provide regular status updates to the Electrical Engineer \n- Comply with all safety regulations and standards! \n\nRequired Skills:\n- Bachelor’s degree in Electrical Engineering or a related field \n- Minimum of 5 years of experience working as an Assistant Engineer (Electrical) \n- In-depth knowledge of electrical systems and components \n- Proficient in reading and interpreting electrical plans and specifications \n- Familiarity with AutoCAD and other industry-specific software \n- Strong analytical and problem-solving skills \n- Excellent communication and interpersonal skills \n- Time management and organizational abilities \n- Ability to work well in a team and independently \n- Knowledge of relevant codes and regulations \n- Willingness to work on-site and travel to project locations \n- Possess a valid driver’s license!",
    //                 "index": 0,
    //                 "logprobs": null,
    //                 "finish_reason": "stop"
    //             }
    //         ],
    //         "usage": {
    //             "prompt_tokens": 19,
    //             "completion_tokens": 319,
    //             "total_tokens": 338
    //         }
    //     }';

    //     // Decode the JSON response
    //     $responseData = json_decode($response, true);

    //     // Extract Job Description
    //     $jobDescription = $this->extractSection($responseData['choices'][0]['text'], 'Job Description:', 'Responsibilities:');
    //     // Extract Responsibilities
    //     $responsibilities = $this->extractSection($responseData['choices'][0]['text'], 'Responsibilities:', 'Required Skills:');
    //     // Extract Required Skills
    //     $requiredSkills = $this->extractSection($responseData['choices'][0]['text'], 'Required Skills:');

    //     // Return the sections as an associative array
       
    //     return response()->json([
    //         'success' => true,
    //         'Job Description' => $jobDescription,
    //         'Responsibilities' => $responsibilities,
    //         'Required Skills' => $requiredSkills,
    //     ], 200);
        
    // }
    public function fetchJobDetailsByAI(Request $request)
    {
        $jobTitle = $request->jobTitle;
        $max_experience = $request->maxExperience;

        $url = 'https://api.openai.com/v1/completions';
        $api_key = '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';
        $prompt = 'provide Job description, required skills of '.$jobTitle.' of '.$max_experience.' of experience';

        $payload = [
            'model' => 'gpt-3.5-turbo-instruct',
            'prompt' => $prompt,
            'max_tokens' => 350
        ];

        $headers = [
            'Authorization' => 'Bearer '.$api_key,
            'Content-Type' => 'application/json',
        ];

        // Make the API request
        $response = Http::withHeaders($headers)->post($url, $payload);

        // Check if the request was successful
        if ($response->successful()) {
            // Decode the JSON response
            $responseData = $response->json();

            // Extract Job Description, Responsibilities, and Required Skills
            $jobDescription = $this->extractSection($responseData['choices'][0]['text'], 'Job Description:', 'Responsibilities:');
            $responsibilities = $this->extractSection($responseData['choices'][0]['text'], 'Responsibilities:', 'Required Skills:');
            $requiredSkills = $this->extractSection($responseData['choices'][0]['text'], 'Required Skills:');

            // Return the sections as an associative array
            return response()->json([
                'success' => true,
                'Job Description' => $jobDescription,
                'Responsibilities' => $responsibilities,
                'Required Skills' => $requiredSkills,
            ]);
        } else {
            // Log the error
            Log::error('API request failed:', [
                'jobTitle' => $jobTitle,
                'max_experience' => $max_experience,
                'url' => $url,
                'payload' => $payload,
                'error' => $response->body()
            ]);

            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch job details. Please try again later.'
            ], $response->status());
        }
    }

    public function postCreateNewJob(Request $request)
    {
        // try {
            // Define custom validation messages
            $messages = [
                'required' => 'The :attribute field is required.',
                'string' => 'The :attribute must be a string.',
                'numeric' => 'The :attribute must be a number.',
                'gte' => 'The :attribute must be greater than or equal to :value.',
            ];

            // Validate the request data
            // $validator = Validator::make($request->all(), [
            //     'job_title' => 'required|string',
            //     'job_level' => 'required|string',
            //     'min_experience' => 'required|numeric',
            //     'max_experience' => 'required|numeric|gte:min_experience',
            //     'job_description' => 'required|string',
            //     'job_responsibilities' => 'required|string',
            //     'job_requirements_skills' => 'required|string',
            //     'employment_benefits' => 'required|string',
            //     'job_location' => 'required|string',
            //     'company_industry' => 'required|string',
            //     'job_function' => 'required|string',
            //     'salary_duration' => 'required|string',
            //     'employment_type' => 'required|string',
            //     'specialization' => 'required|string',
            //     'min_salary' => 'required|numeric',
            //     'max_salary' => 'required|numeric|gte:min_salary',
            //     'currency' => 'required|string',
            //     'company_info_visibility' => 'required|string',
            //     'business_area' => 'nullable|string',
            //     'educational_requirements' => 'required|string',
            //     'level_of_education' => 'required|string',
            //     'degree' => 'required|string',
            //     'workplace' => 'required|string',
            //     'nationality' => 'required|string',
            //     'gender' => 'required|string',
            //     'min_age' => 'required|numeric',
            //     'max_age' => 'required|numeric|gte:min_age',
            // ], $messages);

            // If validation fails, throw a ValidationException
            // if ($validator->fails()) {
            //     return redirect()->back();
            // }
            

            // Your existing code to create and save the job instance
            $recruiter = Auth::guard('recruiter')->user();
            $job = new DraftJob();
            // Set each attribute on the job instance
            $job->recruiter_id = $recruiter->id;
            $job->job_title = $request->input('job_title');
            $job->job_level = $request->input('job_level');
            $job->min_experience = min($request->input('min_experience'), $request->input('max_experience'));
            $job->max_experience = max($request->input('min_experience'), $request->input('max_experience'));
            $job->job_description = $request->input('job_description');
            $job->job_responsibilities = $request->input('job_responsibilities');
            $job->job_requirements_skills = $request->input('job_requirements_skills');
            $job->employment_benefits = $request->input('employment_benefits');
            $job->job_location = $request->input('job_location');
            $job->company_industry = $request->input('company_industry');
            $job->job_function = $request->input('job_function');
            $job->salary_duration = $request->input('salary_duration') == 'on' ? 1 : 0;
            $job->employment_type = $request->input('employment_type');
            $job->specialization = $request->input('specialization');
            $job->min_salary = min($request->input('min_salary'), $request->input('max_salary'));
            $job->max_salary = max($request->input('min_salary'), $request->input('max_salary'));
            $job->currency = $request->input('currency');
            $job->company_info_visibility = $request->input('company_info_visibility') == 'on' ? 1 : 0;
            $job->alternative_company_name = $request->input('alternative_company_name');
            $job->business_area = $request->input('business_area');
            $job->educational_requirements = $request->input('educational_requirements');
            $job->level_of_education = $request->input('level_of_education');
            $job->degree = $request->input('degree');
            $job->major_concentration_subject = $request->input('major_concentration_subject');
            $job->additional_academic_requirement = $request->input('additional_academic_requirement');
            $job->workplace = $request->input('workplace');
            $job->nationality = $request->input('nationality');
            $job->gender = $request->input('gender');
            $job->min_age = min($request->input('min_age'), $request->input('max_age'));
            $job->max_age = max($request->input('min_age'), $request->input('max_age'));
            $job->training_certification = $request->input('training_certification');
            $job->specialties = $request->input('specialties');
            $job->status = 1;

            // Save the job data to the database
            $job->save();

            return redirect()->back();
        // }
        //  catch (\Exception $e) {
        //     \Log::error('Error in JobCircularController[postCreateNewJob]: ' . $e->getMessage());
        //     return redirect()->back()->withErrors()->withInput();
        // }
    }



    // public function fetchJobDetailsByAI()
    // {
    //     // The static JSON response you provided
    //     $staticResponse = '{
    //         "id": "cmpl-8tGVUE9jCqPOonoSxOE38s6kBfv0r",
    //         "object": "text_completion",
    //         "created": 1708182184,
    //         "model": "gpt-3.5-turbo-instruct",
    //         "choices": [
    //             {
    //                 "text": "\n\nPosition: Senior Software Engineer (Laravel)\n\nYears of Experience: Minimum 3 years\n\nJob Description:\n\nWe are seeking a highly skilled and experienced Senior Software Engineer proficient in Laravel to join our dynamic team. The ideal candidate should have a strong understanding of web development principles and be able to work collaboratively with cross-functional teams to deliver high-quality software solutions. The Senior Software Engineer will be responsible for designing, developing, and maintaining complex web applications using Laravel.\n\nKey Responsibilities:\n\n1. Design and develop highly efficient and robust software solutions using Laravel framework.\n2. Collaborate with product managers, designers, and other team members to understand business requirements and translate them into technical specifications.\n3. Write clean, efficient, and well-documented code while following coding standards and best practices.\n4. Continuously optimize and enhance existing applications for improved performance and scalability.\n5. Develop and implement new features and functionalities based on business needs.\n6. Troubleshoot and debug complex technical issues in a timely manner.\n7. Stay updated with the latest technologies and trends in web development and provide recommendations for improvement.\n8. Mentor and provide technical guidance to junior engineers.\n\nRequired Skills:\n\n1. Minimum 3 years of experience in software development with strong proficiency in Laravel.\n2. Good understanding of Object-Oriented Programming (OOP) concepts.\n3. Experience in developing RESTful APIs and integrating third-party APIs.\n4. Proficient in MySQL and database design principles.\n5. Strong knowledge of front-end web technologies such as HTML, CSS, and JavaScript.\n6. Experience with front-end frameworks like Vue.js or React.js is a plus.\n7. Familiarity with Agile development methodologies.\n8. Good understanding of code versioning tools such as Git.\n9.",
    //                 "index": 0,
    //                 "logprobs": null,
    //                 "finish_reason": "length"
    //             }
    //         ],
    //         "usage": {
    //             "prompt_tokens": 19,
    //             "completion_tokens": 350,
    //             "total_tokens": 369
    //         }
    //     }';
        
    //     $staticResponse = '{
    //         "id": "cmpl-8Yz07ZK17QCnVqLCdnWQI6HQbMndE",
    //         "object": "text_completion",
    //         "created": 1703348331,
    //         "model": "gpt-3.5-turbo-instruct",
    //         "choices": [
    //             {
    //                 "text": "\n\nJob Description:\n\nThe Assistant Engineer (Electrical) will support the Electrical Engineer in planning, designing, and overseeing the installation and maintenance of electrical systems for various projects. They will work in collaboration with the project team to ensure that all electrical systems are installed and functioning properly!. \n\nResponsibilities:\n- Assist the Electrical Engineer in designing and reviewing electrical system layouts \n- Participate in site visits to assess electrical system requirements and provide recommendations \n- Prepare technical specifications and cost estimates for electrical equipment and materials \n- Collaborate with contractors and vendors to ensure timely delivery of materials and equipment \n- Monitor and inspect the installation of electrical systems to ensure compliance with project specifications \n- Troubleshoot and resolve any issues related to electrical systems \n- Conduct regular maintenance checks on electrical systems to ensure they are functioning properly \n- Keep track of project progress and provide regular status updates to the Electrical Engineer \n- Comply with all safety regulations and standards! \n\nRequired Skills:\n- Bachelor’s degree in Electrical Engineering or a related field \n- Minimum of 5 years of experience working as an Assistant Engineer (Electrical) \n- In-depth knowledge of electrical systems and components \n- Proficient in reading and interpreting electrical plans and specifications \n- Familiarity with AutoCAD and other industry-specific software \n- Strong analytical and problem-solving skills \n- Excellent communication and interpersonal skills \n- Time management and organizational abilities \n- Ability to work well in a team and independently \n- Knowledge of relevant codes and regulations \n- Willingness to work on-site and travel to project locations \n- Possess a valid driver’s license!",
    //                 "index": 0,
    //                 "logprobs": null,
    //                 "finish_reason": "stop"
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

    //     // Extract Job Description
    //     $jobDescription = $this->extractSection($responseData['choices'][0]['text'], 'Job Description:', 'Responsibilities:');
    //     // Extract Responsibilities
    //     $responsibilities = $this->extractSection($responseData['choices'][0]['text'], 'Responsibilities:', 'Required Skills:');
    //     // Extract Required Skills
    //     $requiredSkills = $this->extractSection($responseData['choices'][0]['text'], 'Required Skills:');

    //     // Return the sections as an associative array
    //     return [
    //         'Job Description' => $jobDescription,
    //         'Responsibilities' => $responsibilities,
    //         'Required Skills' => $requiredSkills,
    //     ];
    // }

    // Helper function to extract a section between two keywords
    private function extractSection($text, $startKeyword, $endKeyword = null)
    {
        $start = strpos($text, $startKeyword);
        if ($start !== false) {
            $start += strlen($startKeyword);
            $end = $endKeyword ? strpos($text, $endKeyword, $start) : strlen($text);

            if ($end !== false) {
                return trim(substr($text, $start, $end - $start));
            }
        }

        return null;
    }
    
    
}
