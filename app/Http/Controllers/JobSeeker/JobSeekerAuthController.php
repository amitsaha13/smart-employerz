<?php

namespace App\Http\Controllers\JobSeeker;
use App\Http\Controllers\Controller;
use Str;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\String\ByteString;
use Symfony\Pdf\PdfParser;
use Spatie\PdfToText\Pdf;
use Carbon\Carbon;
use App\Models\JobSeeker;
use App\Models\LoginHistory;


class JobSeekerAuthController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/job_seeker/dashboard';
    protected $guard = 'job_seeker';

    public function showLoginForm()
    {
        return view('job_seeker.job_seeker-login');
    }

    public function login(Request $request)
    {

        // If not authenticated, proceed with the login attempt
        $credentials = $request->only('email', 'password');

        if (Auth::guard($this->guard)->attempt($credentials, $request->filled('remember'))) {
            // Authentication passed...
            $user = Auth::guard('job_seeker')->user();
            $sessionId = $request->session()->getId();
            insertLoginHistory($user->id, 'job_seeker', $sessionId, Carbon::now(), $request->ip(), $request->userAgent());
            return redirect()->intended($this->redirectTo);
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function showRegistrationForm()
    {
        return view('job_seeker.job_seeker-register');
    }

    protected function register(Request $request)
    {
        $admin = new JobSeeker();
        $admin->name = $request['name'];
        $admin->email = $request['email'];
        $admin->password = Hash::make($request['password']);
        $admin->save();

        return redirect('/job_seeker/login');
    }

    public function logout(Request $request)
    {
        $user = Auth::guard($this->guard)->user();
        $sessionId = $request->session()->getId();
        // Get the user's last login record for update
        $lastLogin = LoginHistory::where('user_id', $user->id)
            ->where('user_type', 'job_seeker') 
            ->where('session_id', $sessionId)
            ->orderBy('login_time', 'desc')
            ->first();

        if ($lastLogin) {
            $lastLogin->logout_time = Carbon::now(); 
            $lastLogin->save();
        }
        Auth::guard($this->guard)->logout(); // Logout the admin user
        
        return redirect('/job_seeker/login');
    }


    
    public function index()
    {
        $user = Auth::guard('job_seeker')->user();
        return view('job_seeker.job_seeker-dashboard');
    }


    public function parseCV(Request $request)
    {
        // Get the uploaded file
        $file = $request->file('cv');

        // Check if a file was uploaded
        if ($file) {
            dd($file);
            // $parser = new PdfParser();
            // $document = $parser->parseFile($file);
            $text = (new Pdf())->getText($file);
            // $text = ByteString::fromArray($document->getPages())->toString();
            // Process $text further as needed for CV parsing

            return response()->json(['text' => $text]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }
    // public function storeCV(Request $request)
    // {
    //     // Validate the uploaded file
    //     $request->validate([
    //         'cv' => 'required|mimes:pdf',
    //     ]);
    //     $cvFile = $request->file('cv');
    //     if ($cvFile) {
    //         $cvPath = $cvFile->getClientOriginalName();
    
    //         // Process the uploaded CV
    //         $upload = $request->file('cv')->move(public_path('/cvs/'), $cvPath);
    //         // Extract data from the PDF CV (you'll need a package for this)
    //         $pdf = new \Smalot\PdfParser\Parser();
    //         $pdfObject = $pdf->parseFile(public_path('/cvs/' . $cvPath)); 
            
    //         $text = $pdfObject->getText();

    //         // $sectionHeaders = ['Objective', 'Education', 'Publications'];

    //         // foreach ($sectionHeaders as $header) {
    //         //     // Use regular expressions to identify the start and end of each section
    //         //     $start = strpos($text, $header);
    //         //     $end = ($start != false) ? strpos($text, $sectionHeaders[array_search($header, $sectionHeaders) + 1], $start) : false;

    //         //     if ($start !== false) {
    //         //         // Extract and store the data for this section
    //         //         $sectionContent = substr($text, $start, ($end !== false) ? $end - $start : strlen($text));
    //         //         $sectionData[$header] = trim($sectionContent);
    //         //     }
    //         // }

    //         // return response()->json(['message' => 'CV data has been extracted and stored.',$sectionData]);

    //         $text = str_replace(' ', '', $text);
    //         $text = str_replace('\n', '', $text);

    //         // Extract email, phone, DOB, experience, and skills using regular expressions
    //         $email = preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}/', $text, $emailMatches) ? $emailMatches[0] : null;
    //         $phone = preg_match('/\d{10,}/', $text, $phoneMatches) ? $phoneMatches[0] : null;
    //         $dob = preg_match('/Date\s*of\s*Birth\s*:\s*([^\n]+)/', $text, $dobMatches) ? trim($dobMatches[1]) : null;
    //         $fatherName = preg_match('/Father’s\s*Name\s*:\s*([^\n]+)/', $text, $fatherNameMatches) ? trim(preg_replace('/\t+/', ' ', $fatherNameMatches[1])) : null;
    //         $motherName = preg_match('/Mother’s\s*Name\s*:\s*([^\n]+)/', $text, $motherNameMatches) ? trim($motherNameMatches[1]) : null;
    //         $permanentAddress = preg_match('/Permanent\s*Address\s*:\s*([^\n]+)/', $text, $permanentAddressMatches) ? $permanentAddressMatches[1] : null;
    //         $sex = preg_match('/Sex\s*:\s*([^\n]+)/', $text, $sexMatches) ? trim($sexMatches[1]) : null;
    //         $maritalStatus = preg_match('/Marital\s*Status\s*:\s*([^\n]+)/', $text, $maritalStatusMatches) ? trim($maritalStatusMatches[1]) : null;
    //         $religion = preg_match('/Religion\s*:\s*([^\n]+)/', $text, $religionMatches) ? trim($religionMatches[1]) : null;
    //         $nationality = preg_match('/Nationality\s*:\s*([^\n]+)/', $text, $nationalityMatches) ? trim($nationalityMatches[1]) : null;
    //         $blood_group = preg_match('/Blood\s*Group\s*:\s*([^\n]+)/', $text, $blood_groupMatches) ? trim(preg_replace('/\t+/', ' ', $blood_groupMatches[1])) : null;
        
    //         $skills = [];
    //         if (preg_match_all('/\b(skill1|skill2|skill3)\b/i', $text, $skillMatches)) {
    //             $skills = $skillMatches[0];
    //         }
            
    //         $cvData = [
    //             'text' => $text,
    //             'email' => $email,
    //             'phone' => $phone,
    //             'dob' => $dob,
    //             'father_name' => $fatherName,
    //             'mother_name' => $motherName,
    //             'permanent_address' => $permanentAddress,
    //             'sex' => $sex,
    //             'marital_status' => $maritalStatus,
    //             'religion' => $religion,
    //             'nationality' => $nationality,
    //             'blood_group' => $blood_group,
    //             'skills' => $skills
    //             // Add skills and other fields as needed
    //         ];
            
    //     } else {
            
    //         return "No file uploaded.";
    //     }

    //     return response()->json(['message' => 'CV data has been extracted and stored.',$cvData]);
    // }

    



    


}
