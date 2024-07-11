@extends('layouts.recruiter_layout')
<title>Create New Job | {{ config('app.name') }}</title>

@section('content')
    <!-- Start Main Section -->
    <!-- Main Bar -->

    <div class="custom-space custom-space-form py-0">


        <!-- Start New Job Form -->
        <form action="{{ route('create.new.job') }}" method="post" class="create-new-job-form form" id="msform">
            @csrf
            <div class="steper-wrapper">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group mb-3">
                            <div class="form-title custom-border-bottom">
                                <h2 class="text-capitalize">Job Information</h2>
                                <p class="mb-0">
                                    Update your photo and personal details here.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-xl-12">
                        <h3 class="title-bar mb-4">Job title and Location</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mx-md-4">
                                    <label for="jobTitle" class="form-label">Job Title</label>
                                    <input type="text" class="form-control" id="jobTitle" aria-describedby="jobTitle"
                                        name="job_title" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ms-md-4">
                                    <label class="form-label" for="jobLevel">Job
                                        Level</label>
                                    <select class="form-select" name="job_level" id="job_level"
                                        aria-label="Default select example" required>
                                        <option value="1" selected>Entry Level</option>
                                        <option value="2">Intermediate Level</option>
                                        <option value="3">Advanced Level</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group me-md-4">
                                    <label class="form-label" for="numberOfEmployees">Year of
                                        Experience (e.g.: 1-2 Years)</label>
                                    <div class="d-flex gap-3">
                                        <select class="form-select" name="min_experience" id="min_experience"
                                            aria-label="Default select example" required>
                                            <option value="" selected>Min</option>
                                            @for ($i = 0; $i <= settings('MAX_EXPERIENCE'); $i++)
                                                <option value="{{ $i }}">
                                                    {{ numberToWord($i) }}</option>
                                            @endfor

                                        </select>
                                        <select class="form-select" name="max_experience" id="max_experience"
                                            aria-label="Default select example" required>
                                            <option value="" selected>Max</option>
                                            @for ($i = 1; $i <= settings('MAX_EXPERIENCE'); $i++)
                                                <option value="{{ $i }}">
                                                    {{ numberToWord($i) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-xl-12">
                        <div class="title-bar-with-btn mb-4">
                            <h3 class="title-bar">Description</h3>
                            <button type="button" onclick="generateWithAI()"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="15" viewBox="0 0 16 15" fill="none">
                                    <path
                                        d="M8.32917 0.956239C8.41897 0.679846 8.80999 0.679847 8.8998 0.95624L9.65243 3.27259C9.69259 3.3962 9.80778 3.47989 9.93775 3.47989H12.3733C12.6639 3.47989 12.7848 3.85177 12.5496 4.02259L10.5792 5.45418C10.4741 5.53057 10.4301 5.66598 10.4703 5.78959L11.2229 8.10594C11.3127 8.38233 10.9963 8.61217 10.7612 8.44135L8.79082 7.00977C8.68567 6.93337 8.54329 6.93337 8.43815 7.00977L6.46774 8.44135C6.23263 8.61217 5.91628 8.38233 6.00609 8.10594L6.75872 5.78959C6.79888 5.66598 6.75488 5.53057 6.64974 5.45418L4.67933 4.02259C4.44421 3.85177 4.56505 3.47989 4.85566 3.47989H7.29122C7.42119 3.47989 7.53638 3.3962 7.57654 3.27259L8.32917 0.956239Z"
                                        fill="#FCBD1C" />
                                    <path
                                        d="M3.40699 8.33905C3.4968 8.06266 3.88782 8.06266 3.97762 8.33905L4.45393 9.80496C4.49409 9.92857 4.60928 10.0123 4.73925 10.0123H6.2806C6.57121 10.0123 6.69205 10.3841 6.45693 10.555L5.20995 11.4609C5.10481 11.5373 5.06081 11.6728 5.10097 11.7964L5.57728 13.2623C5.66708 13.5387 5.35074 13.7685 5.11562 13.5977L3.86864 12.6917C3.7635 12.6153 3.62112 12.6153 3.51597 12.6917L2.26899 13.5977C2.03388 13.7685 1.71754 13.5387 1.80734 13.2623L2.28364 11.7964C2.32381 11.6728 2.27981 11.5373 2.17466 11.4609L0.927684 10.555C0.69257 10.3841 0.813402 10.0123 1.10402 10.0123H2.64537C2.77534 10.0123 2.89053 9.92857 2.93069 9.80496L3.40699 8.33905Z"
                                        fill="#FCBD1C" />
                                    <path
                                        d="M13.3455 9.28072C13.4054 9.09646 13.6661 9.09646 13.726 9.28072L14.0435 10.258C14.0703 10.3404 14.1471 10.3962 14.2337 10.3962H15.2613C15.455 10.3962 15.5356 10.6441 15.3788 10.758L14.5475 11.362C14.4774 11.4129 14.4481 11.5032 14.4749 11.5856L14.7924 12.5629C14.8523 12.7471 14.6414 12.9004 14.4846 12.7865L13.6533 12.1825C13.5832 12.1316 13.4883 12.1316 13.4182 12.1825L12.5869 12.7865C12.4301 12.9004 12.2192 12.7471 12.2791 12.5629L12.5966 11.5856C12.6234 11.5032 12.5941 11.4129 12.524 11.362L11.6927 10.758C11.5359 10.6441 11.6165 10.3962 11.8102 10.3962H12.8378C12.9244 10.3962 13.0012 10.3404 13.028 10.258L13.3455 9.28072Z"
                                        fill="#FCBD1C" />
                                </svg>Generate with
                                AI</button>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mx-md-4">
                                    <label for="floatingTextarea" class="form-label">Job
                                        Description</label>
                                    <div class="form-floating">
                                        <textarea class="form-control" name="job_description" id="jobDescription" required>Descriptions</textarea>
                                    </div>
                                    <div class="form-text">275 characters left</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mx-md-4">
                                    <label for="floatingTextarea" class="form-label">Job Responsibilities</label>
                                    <div class="form-floating">
                                        <textarea class="form-control" name="job_responsibilities" id="responsibilities" required>Responsibilities
                            </textarea>
                                    </div>
                                    <div class="form-text">275 characters left</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mx-md-4">
                                    <label for="floatingTextarea" class="form-label">Job Requirement & Skills</label>
                                    <div class="form-floating">
                                        <textarea class="form-control" name="job_requirements_skills" id="requiredSkills" required>Job Requirement & Skills
                            </textarea>
                                    </div>
                                    <div class="form-text">275 characters left</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mx-md-4">
                                    <label for="floatingTextarea" class="form-label">Employment Benefits</label>
                                    <div class="form-floating">
                                        <textarea class="form-control" name="employment_benefits" id="benifits" required>Employment Benefits
                            </textarea>
                                    </div>
                                    <div class="form-text">275 characters left</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group custom-select2 mx-md-4">
                                <label class="form-label" for="countries">Job Location</label>
                                <svg width="19" height="19" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 7.5L10 12.5L15 7.5" stroke="#343a40" stroke-width="1.66667"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <select class="form-select" aria-label="Default select example" name="job_location"
                                    required id="countries">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->countries_iso_code }}" data-capital="Capital">
                                            {{ $country->countries_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-xl-12">
                        <h3 class="title-bar mb-4">
                            Company industry and Job function
                        </h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ms-md-4">
                                    <label for="CompanyIndustry" class="form-label">Company industry</label>
                                    <input type="text" placeholder="Education Management" class="form-control"
                                        name="company_industry" id="CompanyIndustry"
                                        aria-describedby="CompanyIndustry" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group me-md-4">
                                    <label for="jobFunction" class="form-label">Job function</label>
                                    <input type="text" placeholder="Job function" class="form-control"
                                        name="job_function" id="jobFunction" aria-describedby="jobFunction" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-xl-12">
                        <div class="title-bar-with-switch mb-4">
                            <h3 class="title-bar">Employment Details</h3>
                            <div class="form-check form-switch">
                                <div>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Monthly</label>
                                </div>
                                <input class="form-check-input" type="checkbox" role="switch" name="salary_duration"
                                    id="flexSwitchCheckChecked" checked />
                                <label class="form-check-label" for="flexSwitchCheckChecked">Yearly</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 col-lg-6">
                                <div class="form-group ms-md-4">
                                    <label for="FullTime" class="form-label">Employment type</label>
                                    <input type="text" placeholder="Full Time" class="form-control"
                                        id="employmentType" name="employment_type" aria-describedby="FullTime" />
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-6">
                                <div class="form-group me-md-4">
                                    <label for="writeHere" class="form-label">Specialized or Experience Area</label>
                                    <input type="text" placeholder="Write Here" class="form-control"
                                        name="specialization" id="specialization" aria-describedby="writeHere" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-xl-12">
                        <div class="title-bar-with-switch mb-4">
                            <h3 class="title-bar">Salary Range</h3>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group ms-md-4">
                                    <label for="FromToFirst" class="form-label">Minimum</label>
                                    <input type="text" placeholder="Minimum" class="form-control" name="min_salary"
                                        id="min_salary" aria-describedby="FromToFirst" />
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group me-md-4 me-lg-0">
                                    <label for="FromToLast" class="form-label">Maximum</label>
                                    <input type="text" placeholder="Maximum" class="form-control" name="max_salary"
                                        id="max_salary" aria-describedby="FromToLast" />
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group me-md-4 ms-md-4 ms-lg-0">
                                    <label class="form-label" for="Currency">Currency</label>
                                    <select class="form-select" id="currency" name="currency"
                                        aria-label="Default select example">
                                        <option value="" selected>Select Currency</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency->id }}">
                                                {{ $currency->name }}({{ $currency->code }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-check form-switch ms-md-4">
                                    <input class="form-check-input me-2" type="checkbox" role="switch"
                                        name="company_info_visibility" id="flex2SwitchCheckChecked" checked />
                                    <span class="d-block">Hide Company Information</span>
                                    <label class="form-check-label ps-1" for="flex2SwitchCheckChecked">I’m open and
                                        available for
                                        freelance work.</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mx-md-4">
                                    <label class="form-label" for="CompanyName">Alternative Company Name</label>
                                    <input type="text" class="form-control" id="alternative_company_name"
                                        aria-describedby="jobTitle" name="alternative_company_name" />

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="next btn-form btn-form-continue">
                    Continue
                </button>
                <button type="submit" class="btn-form btn-default me-2">
                    Save
                </button>
                <button type="button" class="btn-form btn-default me-2">
                    Cancel
                </button>
            </div>
            <div class="steper-wrapper">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group mb-3">
                            <div class="form-title custom-border-bottom">
                                <h2 class="text-capitalize">Candidate Reqirement</h2>
                                <p class="mb-0">
                                    Update your photo and personal details here.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="form-group me-md-4">
                            <label class="form-label" for="IndustryExpert">Business Area</label>
                            <select class="form-select" id="IndustryExpert" name="business_area"
                                aria-label="Default select example">
                                @foreach ($jobCategories as $category)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group me-md-4">
                            <label for="skillOne" class="form-label">Educational Requirements</label>
                            <input type="text" class="form-control" id="educational_requirements"
                                name="educational_requirements" aria-describedby="skillOne" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group me-md-4">
                            <label for="skillOne" class="form-label">Major / Concentration Subject</label>
                            <input type="text" class="form-control" id="skillOne" name="major_concentration_subject"
                                aria-describedby="skillOne" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group me-md-4">
                            <label for="floatingTextarea" class="form-label">Additional Academic Requirement</label>
                            <div class="form-floating">
                                <textarea class="form-control" name="additional_academic_requirement" id="floatingTextarea">Additional Academic Requirement
                          </textarea>
                            </div>
                            <div class="form-text">275 characters left</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="Workplace">Workplace /
                                Workstation</label>
                            <select class="form-select" id="workplace" name="workplace"
                                aria-label="Default select example">
                                <option value="1">On-Site/Physical</option>
                                <option value="2">Remote</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group me-md-4">
                            <label class="form-label" for="Nationality">Nationality</label>
                            <input type="text" class="form-control" id="nationality" name="nationality"
                                aria-describedby="skillOne" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="Gender">Gender</label>
                            <select class="form-select" name="gender" id="gender"
                                aria-label="Default select example">
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                                <option value="3">Both</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group me-md-4">
                            <label class="form-label" for="AgeOfRange">Age Range</label>
                            <div class="d-flex gap-3">

                                <input type="number" placeholder="18" class="form-control" name="min_age"
                                    id="min_age" aria-describedby="min_age" />

                                <input type="number" placeholder="59" class="form-control" name="max_age"
                                    id="max_age" aria-describedby="max_age" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group me-md-4">
                            <label for="Certifications" class="form-label">Training &
                                Certification</label>
                            <input type="text" class="form-control" name="training_certification"
                                id="training_certification" aria-describedby="Certifications" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group me-md-4">
                            <label for="Specialities" class="form-label">Specialties</label>
                            <input type="text" class="form-control" name="specialties" id="Specialities"
                                aria-describedby="Specialities" />
                        </div>
                    </div>
                </div>
                <a href="#" class="text-decoration-underline custom-links ms-md-0">Customize
                    Application Form</a>
                <button type="button" id="previewBtn" class="btn-form btn-form-continue" data-bs-toggle="modal"
                    data-bs-target="#jobCircularModal">
                    Preview
                </button>

                <button type="submit" class="btn-form btn-default me-2">
                    Save
                </button>
                <button type="button" class="previous btn-form btn-default me-2">
                    Back
                </button>
            </div>
        </form>
        <!-- End New Job Form -->
    </div>



    <!-- Modal -->
    <div class="modal custom-modal fade" id="jobCircularModal" tabindex="-1" aria-labelledby="jobCircularModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="top-header">
                        <div class="brand-details">
                            <div class="brand-logo">
                                <img src="{{ asset('img/recruiters/brand.png') }}" alt="Brand Logo" class="img-fluid" />
                            </div>
                            <div class="brand-info">
                                <h1 id="jobTitle_preview">Brand Manager</h1>
                                <h2 id="employmentType_preview">Part Time</h2>
                                <p id="jobDescription_preview">
                                    Lorem ipsum dolor sit amet consectetur. Nunc nec proin ut
                                    leo. Mauris ut eu non est blandit. Imperdiet urna eu at
                                    nullam quisque auctor justo nunc.
                                </p>
                            </div>
                        </div>
                        <div class="action-btn">
                            <a class="text-decoration-none" type="button" href="#">Apply Now</a>
                        </div>
                    </div>
                    <div class="details">
                        <h3 class="mt-5 mb-4">Job Details :</h3>
                        <section class="mb-4">
                            <dl>
                                <dt>Job Type :</dt>
                                <dd id="employmentType_preview1">Part Time</dd>
                            </dl>
                            <dl>
                                <dt>Experience :</dt>
                                <dd id="experience_preview">5-6 years</dd>
                            </dl>
                            <dl>
                                <dt>Location :</dt>
                                <dd id="location_preview">Dhaka, Bangladesh</dd>
                            </dl>
                        </section>
                        <section class="mb-4">
                            <h4>Description :</h4>
                            <p id="jobDescription_preview1">
                                WellDev is looking for a Senior UI & UX Designer who will be
                                responsible for leading different projects for designing
                                interactive and user friendly interfaces for state of the art
                                products of our clients. If you are eager to design world
                                class user experience for the global market, we’d like to meet
                                you. Ultimately, you will be creating both functional and
                                appealing features that address our clients’ needs and help us
                                grow our customer base.
                            </p>
                        </section>
                        <section class="mb-4">
                            <dl>
                                <dt>Salary :</dt>
                                <dd id="salary_preview">8,000 Taka - 12,000 Taka</dd>
                            </dl>
                        </section>
                        <section class="mb-4">
                            <h4>Job Requirements & Skills :</h4>
                            <ul class="job-skills" id="requiredSkills_preview">

                            </ul>
                        </section>
                        <section class="mb-4">
                            <dl>
                                <dt>Educational Requirements :</dt>
                                <dd id="educational_requirements_preview">NA</dd>
                            </dl>
                        </section>
                        <section class="mb-4">
                            <dl>
                                <dt>Training & Certifications :</dt>
                                <dd id="training_certification_preview">NA</dd>
                            </dl>
                        </section>
                        <section class="mb-4">
                            <h4>Compensation & Benefits :</h4>
                            <ul id="benifits_preview">
                                <li>
                                    Discounts at our hotels, restaurants and spas across our
                                    network
                                </li>
                                <li>Staff, family and friends rates at our hotels</li>
                                <li>Meals on duty, staff parking and uniform provided</li>
                                <li>Minimum of 30 hours per week</li>
                                <li>Excellent reward & recognition events</li>
                                <li>Service and anniversary gifts and benefits</li>
                                <li>
                                    Wellbeing programme including Health insurance discounts
                                </li>
                                <li>
                                    Paid training and individual Employee Development Plans
                                </li>
                                <li>
                                    Training towards NZQA qualifications and our very own online
                                    digital learning platform
                                </li>
                                <li>
                                    Free Life Insurance, Digital Will & Best Doctors teleservice
                                    after 3 months of employment
                                </li>
                            </ul>
                        </section>
                        <section class="mb-4">
                            <h4>Additional Information :</h4>
                            <ul class="add-info">
                                <li>Gender : <span id="gender_preview">Male</span></li>
                                <li>Nationality : <span id="nationality_preview">Bangladeshi</span></li>
                                <li>Specialties : <span id="specialization_preview">NA</span></li>
                                <li>Industry : <span id="industry_preview">IT</span></li>
                                <li>Age Range : <span id="age_preview">25 - 35 Years</span></li>
                                <li>Workplace : <span id=workplace_preview>Work From Home</span></li>
                            </ul>
                        </section>
                    </div>
                    <div class="button-end">
                        <!-- <button type="button" class="btn-default">
                                      Ready To Publish
                                  </button> -->
                        <div class="row">
                            <div class="col-xl-10">
                                <div class="form-datePicker-wrapper">
                                    <div class="form-datePicker">
                                        <div class="form-group">
                                            <input class="form-control" type="date" id="timeFramTo" />
                                        </div>
                                        <span>To</span>
                                        <div class="form-group">
                                            <input class="form-control" type="date" id="timeFramFrom" />
                                        </div>
                                    </div>
                                    <button type="button" class="btn-form btn-form-continue me-0">
                                        Schedule For Later
                                    </button>
                                </div>
                            </div>
                            <div class="col-xl-2">
                                <button type="button" class="btn-default" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Publish Now
                                </button>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="modal-end">
                        <button type="button" class="btn-default" onclick="window.print()">Ready To
                            Publish</button>
                    </div> --}}
                </div>

            </div>
        </div>
    </div>
    <!-- End Main Section -->

    <div class="modal fade job-schedule-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" id="exampleModalLabel">
                        <h1>Schedule Job Post</h1>
                        <p>Here is today’s report and performances</p>
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="active-date">
                                <div class="form-group">
                                    <label for="">Post Date</label>
                                    <input class="form-control" type="date" id="timeFramTo" />
                                </div>
                                <div class="form-group">
                                    <label for="">Post Time</label>
                                    <p>12:00 AM</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="active-date">
                                <div class="form-group">
                                    <label for="">Post Date</label>
                                    <input class="form-control" type="date" id="timeFramTo" />
                                </div>
                                <div class="form-group">
                                    <label for="">Post Time</label>
                                    <p>12:00 AM</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a type="button" class="modal-btn" href="./job-schedule-done.html">Done</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('js/create-new-job.js') }}"></script>
@endsection
