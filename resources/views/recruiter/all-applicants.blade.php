@extends('layouts.recruiter_layout')
<title>All Applicants | {{ config('app.name') }}</title>

@section('content')
    <div class="dashboard custom-space pt-0 pb-0">
        <!-- Start Filtering Bar -->
        <div class="filtering-bar">
            <div class="row">
                <div class="col-lg-6 col-md-5 col-sm-6">
                    <div class="search-filed">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path
                                d="M17.5 17.5L13.875 13.875M15.8333 9.16667C15.8333 12.8486 12.8486 15.8333 9.16667 15.8333C5.48477 15.8333 2.5 12.8486 2.5 9.16667C2.5 5.48477 5.48477 2.5 9.16667 2.5C12.8486 2.5 15.8333 5.48477 15.8333 9.16667Z"
                                stroke="#667085" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>
                        <input type="search" name="search" id="searchFileld" placeholder="Search" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-7 col-sm-6">
                    <div class="select-filter">
                        <div class="form-group">
                            <select class="form-select" id="numberOfEmployees" aria-label="Default select example"
                                fdprocessedid="ngsxem">
                                <option value="1" selected="">Select Job</option>
                                <option value="2">A</option>
                                <option value="3">B</option>
                            </select>
                        </div>
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                fill="none">
                                <path d="M5 10H15M2.5 5H17.5M7.5 15H12.5" stroke="#344054" stroke-width="1.67"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <span>Filters</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Filtering Bar -->

        <!-- Start Applicant Section -->
        <div class="applicants-info">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="applicants-bar">
                        <h3>Recent Applicants <span>100</span></h3>
                    </div>
                    <div class="all-applicants">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="applicants-wrapper all-applicants-wrapper">
                                    @foreach ($allJobApplications as $application)
                                        <a href="#" class="text-decoration-none">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="description">
                                                        <div class="image">
                                                            <img src="{{$application->profile_image }}"
                                                                alt="Applicants - 1" class="img-fluid" />
                                                        </div>
                                                        <div class="content">
                                                            <h2>{{$application->first_name}} {{$application->last_name}}
                                                                <span>({{calculateAge($application->dob)}})</span></h2>
                                                            <h3>UI/UX Designer <span>(6mo)
                                                                    At, Grameen Phone ltd.</span></h3>
                                                        </div>
                                                    </div>
                                                    <div class="location">
                                                        <div class="content">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="15"
                                                                height="14" viewBox="0 0 15 14" fill="none">
                                                                <path
                                                                    d="M2.66276 4.83203H11.9961C12.2262 4.83203 12.4128 5.01858 12.4128 5.2487V11.082C12.4128 11.3122 12.2262 11.4987 11.9961 11.4987H2.66276C2.43264 11.4987 2.24609 11.3122 2.24609 11.082V5.2487C2.24609 5.01858 2.43264 4.83203 2.66276 4.83203Z"
                                                                    stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <mask id="path-2-inside-1_1088_12133" fill="white">
                                                                    <path
                                                                        d="M9.66276 12.25V2.91667C9.66276 2.60725 9.53984 2.3105 9.32105 2.09171C9.10226 1.87292 8.80551 1.75 8.49609 1.75H6.16276C5.85334 1.75 5.5566 1.87292 5.3378 2.09171C5.11901 2.3105 4.99609 2.60725 4.99609 2.91667V12.25" />
                                                                </mask>
                                                                <path
                                                                    d="M8.16276 12.25C8.16276 13.0784 8.83433 13.75 9.66276 13.75C10.4912 13.75 11.1628 13.0784 11.1628 12.25H8.16276ZM8.49609 1.75V0.25V1.75ZM6.16276 1.75V0.25V1.75ZM4.99609 2.91667H3.49609H4.99609ZM3.49609 12.25C3.49609 13.0784 4.16767 13.75 4.99609 13.75C5.82452 13.75 6.49609 13.0784 6.49609 12.25H3.49609ZM11.1628 12.25V2.91667H8.16276V12.25H11.1628ZM11.1628 2.91667C11.1628 2.20942 10.8818 1.53115 10.3817 1.03105L8.26039 3.15237C8.19788 3.08986 8.16276 3.00507 8.16276 2.91667H11.1628ZM10.3817 1.03105C9.88161 0.530952 9.20334 0.25 8.49609 0.25L8.49609 3.25C8.40769 3.25 8.3229 3.21488 8.26039 3.15237L10.3817 1.03105ZM8.49609 0.25H6.16276V3.25H8.49609V0.25ZM6.16276 0.25C5.45552 0.25 4.77724 0.530952 4.27714 1.03105L6.39846 3.15237C6.33595 3.21488 6.25117 3.25 6.16276 3.25V0.25ZM4.27714 1.03105C3.77705 1.53115 3.49609 2.20942 3.49609 2.91667H6.49609C6.49609 3.00507 6.46097 3.08986 6.39846 3.15237L4.27714 1.03105ZM3.49609 2.91667V12.25H6.49609V2.91667H3.49609Z"
                                                                    fill="black"
                                                                    mask="url(#path-2-inside-1_1088_12133)" />
                                                            </svg>
                                                            <span>$ {{$application->expected_salary}}</span>
                                                        </div>
                                                        <div class="content">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="15"
                                                                height="14" viewBox="0 0 15 14" fill="none">
                                                                <path
                                                                    d="M12.0898 5.83203C12.0898 7.57224 10.953 9.28522 9.67038 10.6391C9.04438 11.2999 8.41584 11.8414 7.94296 12.218C7.81161 12.3226 7.69275 12.4141 7.58985 12.4915C7.48694 12.4141 7.36807 12.3226 7.23673 12.218C6.76384 11.8414 6.1353 11.2999 5.50931 10.6391C4.22665 9.28522 3.08984 7.57224 3.08984 5.83203C3.08984 4.63856 3.56395 3.49396 4.40786 2.65005C5.25178 1.80614 6.39637 1.33203 7.58984 1.33203C8.78332 1.33203 9.92791 1.80614 10.7718 2.65005C11.6157 3.49396 12.0898 4.63856 12.0898 5.83203Z"
                                                                    stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M8.58984 5.83203C8.58984 6.38432 8.14213 6.83203 7.58984 6.83203C7.03756 6.83203 6.58984 6.38432 6.58984 5.83203C6.58984 5.27975 7.03756 4.83203 7.58984 4.83203C8.14213 4.83203 8.58984 5.27975 8.58984 5.83203Z"
                                                                    stroke="black" stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                            </svg>
                                                            <span>{{$application->current_address ?? 'N/A'}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Applicant Section -->
    </div>
@endsection
