<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\JobSeeker;
use Symfony\Component\String\ByteString;
use Symfony\Pdf\PdfParser;
use Spatie\PdfToText\Pdf;
use Str;

class JobApplicationController extends Controller
{
    public function applyJob($job)
    {
        $brand = generalInformation('brand');
        $website = generalInformation('website');
        return view('job_seeker.apply-job',compact('brand','website'));
    }
    public function storeCV(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'cv' => 'required|mimes:pdf',
        ]);
        $cvFile = $request->file('cv');
        if ($cvFile) {
            $cvPath = $cvFile->getClientOriginalName();
    
            // Process the uploaded CV
            $upload = $request->file('cv')->move(public_path('/cvs/'), $cvPath);
            // Extract data from the PDF CV (you'll need a package for this)
            $pdf = new \Smalot\PdfParser\Parser();
            $pdfObject = $pdf->parseFile(public_path('/cvs/' . $cvPath)); 
            
            $text = $pdfObject->getText();
            // return $text;
            // $text = str_replace(' ', '', $text);
            $text = str_replace('\n', '#', $text);
            // $text = str_replace('\n', ' ', $text);
            // Extract email, phone, DOB, experience, and skills using regular expressions
            $name = $this->extractNames($text);
            $email = preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}/', $text, $emailMatches) ? $emailMatches[0] : null;
            $phone = preg_match('/\d{10,}/', $text, $phoneMatches) ? $phoneMatches[0] : null;
            
            $dob = preg_match('/Date\s*of\s*Birth\s*:\s*([^\n]+)/', $text, $dobMatches) ? trim($dobMatches[1]) : null;
            $fatherName = preg_match('/Father’s\s*Name\s*:\s*([^\n]+)/', $text, $fatherNameMatches) ? trim(preg_replace('/\t+/', ' ', $fatherNameMatches[1])) : null;
            $motherName = preg_match('/Mother’s\s*Name\s*:\s*([^\n]+)/', $text, $motherNameMatches) ? trim($motherNameMatches[1]) : null;
            $permanentAddress = preg_match('/Permanent\s*Address\s*:\s*([^\n]+)/', $text, $permanentAddressMatches) ? $permanentAddressMatches[1] : null;
            $sex = preg_match('/Sex\s*:\s*([^\n]+)/', $text, $sexMatches) ? trim($sexMatches[1]) : null;
            $maritalStatus = preg_match('/Marital\s*Status\s*:\s*([^\n]+)/', $text, $maritalStatusMatches) ? trim($maritalStatusMatches[1]) : null;
            $religion = preg_match('/Religion\s*:\s*([^\n]+)/', $text, $religionMatches) ? trim($religionMatches[1]) : null;
            $nationality = preg_match('/Nationality\s*:\s*([^\n]+)/', $text, $nationalityMatches) ? trim($nationalityMatches[1]) : null;
            $blood_group = preg_match('/Blood\s*Group\s*:\s*([^\n]+)/', $text, $blood_groupMatches) ? trim(preg_replace('/\t+/', ' ', $blood_groupMatches[1])) : null;
        
            
            
            // Extract skills
            $skills = $this->extractSkills($text);
            $educationInfo = $this->extractEducation($text);
            $references = $this->extractReferences($text);
            $personalInfo = $this->extractPersonalInfo($text);
            

            $cvData = [
                // 'text' => $text,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'dob' => $dob,
                'father_name' => $fatherName,
                'mother_name' => $motherName,
                'permanent_address' => $permanentAddress,
                'sex' => $sex,
                'marital_status' => $maritalStatus,
                'religion' => $religion,
                'nationality' => $nationality,
                'blood_group' => $blood_group,
                'personalInfo' => $personalInfo,
                'skills' => $skills,
                'educationInfo' => $educationInfo,
                'references' => $references
            ];
            
        } else {
            return "No file uploaded.";
        }

        return response()->json(['message' => 'CV data has been extracted and stored.',$cvData]);
    }

    public function extractNames($text)
    {
        $nameKeywords = ['name', 'full name', 'first name', 'last name', 'title'];

        $nameInfo = [];

        // Split text into lines and process each line
        $lines = explode("\n", $text);
        foreach ($lines as $line) {
            // Check if any name keyword is present in the line
            if (Str::contains(strtolower($line), $nameKeywords)) {
                $nameInfo[] = trim($line);
            }
        }

        if (empty($nameInfo)) {
            return $lines[0];
        }

        return $nameInfo;
    }

    
    public function extractSkills($text)
    {
        // Software Engineer Skills
        $softwareEngineerSkills = ['Laravel', 'Bootstrap', 'tensorflow', 'scikit learn', 'pandas', 'python', 'java', 'machine learning', 'mysql', 'html', 'css', 'MSSQL', 'github'];
        // Other Job Categories Skills
        $cseSkills = ['c', 'c++', 'java', 'data structures', 'algorithms', 'networking', 'security'];
        $bbaSkills = ['business analysis', 'marketing', 'finance', 'accounting', 'management'];
        $marketingSkills = ['digital marketing', 'social media', 'content marketing', 'SEO', 'market research'];
        $lecturerSkills = ['teaching', 'research', 'academic writing', 'presentation'];
        $doctorSkills = ['medicine', 'patient care', 'surgery', 'diagnosis', 'medical research'];
        // Merge all skills into a single array
        $allSkills = array_merge(
            $softwareEngineerSkills,
            $cseSkills,
            $bbaSkills,
            $marketingSkills,
            $lecturerSkills,
            $doctorSkills
        );

        // Remove duplicates and convert to lowercase
        $allSkills = array_unique(array_map('strtolower', $allSkills));

        // Extract lines from the text
        $tokens = explode(" ", $text);
        $skills = [];
        foreach ($tokens as $token) {
            // Remove trailing punctuation and trim whitespace
            $cleanedToken = trim($token, " \t\n\r\0\x0B,");
            $lowercaseToken = strtolower($cleanedToken);
            // Check if the lowercase cleaned token is in the lowercase $skillsKeywords array
            if (in_array($lowercaseToken, $allSkills)) {
                $skills[] = $cleanedToken;
            }
        }

        $uniqueSkills = array_unique($skills);
        return array_values($uniqueSkills);
    }

    public function extractEducation($text)
    {
        // Define education keywords
        $educationKeywords = [ 'degree', 'university', 'graduation', 'BSC', 'MSC', 'BA', 'MA', 'PHD', 'LLB', 'college', 'heigher secondary', 'sceondary School','school'];
        // $educationKeywords = array_map('strtolower', $educationKeywords);

        
        $educationInfo = [];

        // Split text into lines and process each line
        $lines = explode("\n", $text);
        foreach ($lines as $line) {
            // Check if any education keyword is present in the line
            if (Str::contains(strtolower($line), $educationKeywords)) {
                $educationInfo[] = trim($line);
            }
        }

        return $educationInfo;
    }
    public function extractReferences($text)
    {
        // Define reference keywords (customize based on your specific use case)
        $referenceKeywords = ['reference', 'references', 'referee', 'referees'];

        $referenceInfo = [];

        // Split text into lines and process each line
        $lines = explode("\n", $text);
        $isReferenceSection = false;

        foreach ($lines as $index => $line) {
            // Check if any reference keyword is present in the line
            if (Str::contains(strtolower($line), $referenceKeywords)) {
                // Set a flag to indicate that we are in the reference section
                $isReferenceSection = true;

                // Skip the current line, as it contains the reference keyword
                continue;
            }

            // If we are in the reference section, add the line to the $referenceInfo array
            if ($isReferenceSection) {
                $referenceInfo[] = trim($line);

                // Check if we have collected the next 15 lines
                if (count($referenceInfo) >= 15) {
                    break; // Exit the loop once we have 15 lines
                }
            }
        }
        if (empty($referenceInfo)) {
            return ['No references provided.'];
        }

        return $referenceInfo;
    }

   
    public function extractPersonalInfo($text)
    {
        $religionValues = ['pdf', 'report', 'hindu', 'hinduism', 'muslim', 'islam', 'christian', 'buddhist', 'jewish', 'sikh'];
        $bloodGroupValues = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'unknown', 'other'];
        $maritalStatusValues = ['single', 'married', 'divorced', 'widowed', 'separated'];
        $sexValues = ['male', 'female', 'other'];

        // Add nationality values based on your specific requirements
        $nationalityValues = ['nationality1', 'nationality2', 'nationality3'];

        // Extract lines from the text
        $tokens = explode(" ", $text);
        $religions = [];
        $bloodGroups = [];
        $maritalStatus = [];
        $sex = [];
        $nationality = [];
        $address = [];

        foreach ($tokens as $token) {
            // Remove trailing punctuation and trim whitespace
            $cleanedToken = trim($token, " \t\n\r\0\x0B,");

            $lowercaseToken = strtolower($cleanedToken);

            if (in_array($lowercaseToken, $religionValues)) {
                $religions[] = $cleanedToken;
            }
            if (in_array($lowercaseToken, $bloodGroupValues)) {
                $bloodGroups[] = $cleanedToken;
            }
            if (in_array($lowercaseToken, $maritalStatusValues)) {
                $maritalStatus[] = $cleanedToken;
            }
            if (in_array($lowercaseToken, $sexValues)) {
                $sex[] = $cleanedToken;
            }
            if (in_array($lowercaseToken, $nationalityValues)) {
                $nationality[] = $cleanedToken;
            }
            // // Adjust this condition based on your address extraction logic
            // if (/* your address extraction condition */) {
            //     $address[] = $cleanedToken;
            // }
        }

        $uniqueReligions = array_values(array_unique($religions));
        $uniqueBloodGroups = array_values(array_unique($bloodGroups));
        $uniqueMaritalStatus = array_values(array_unique($maritalStatus));
        $uniqueSex = array_values(array_unique($sex));
        $uniqueNationality = array_values(array_unique($nationality));
        $uniqueAddress = array_values(array_unique($address));

        $personalInfo['religion'] = $uniqueReligions;
        $personalInfo['blood_group'] = $uniqueBloodGroups;
        $personalInfo['marital_status'] = $uniqueMaritalStatus;
        $personalInfo['sex'] = $uniqueSex;
        $personalInfo['nationality'] = $uniqueNationality;
        $personalInfo['address'] = $uniqueAddress;

        return $personalInfo;
    }
}
