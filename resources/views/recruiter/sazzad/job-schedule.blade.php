@extends('layouts.recruiter_layout')
<title>Job Schedule | Smartemployerz</title>

@section('content')
    <div class="dashboard custom-space pt-0 pb-0">
        <span class="humburger" onclick="openNav()">&#9776;</span>
        <div class="dashboard">
            <div class="job-schedule">
                <div class="card-body p-0">
                    <div class="top-header">
                        <div class="brand-details">
                            <div class="brand-logo">
                                <img src="{{ asset('img/brand.png') }}" alt="Brand Logo" class="img-fluid" />
                            </div>
                            <div class="brand-info">
                                <h1>Brand Manager</h1>
                                <h2>Part Time</h2>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur. Nunc nec proin
                                    ut leo. Mauris ut eu non est blandit. Imperdiet urna
                                    eu at nullam quisque auctor justo nunc.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="details">
                        <h3 class="mt-5 mb-4">Job Details :</h3>
                        <section class="mb-4">
                            <dl>
                                <dt>Job Type :</dt>
                                <dd>Part Time</dd>
                            </dl>
                            <dl>
                                <dt>Experience :</dt>
                                <dd>5-6 years</dd>
                            </dl>
                            <dl>
                                <dt>Location :</dt>
                                <dd>Dhaka, Bangladesh</dd>
                            </dl>
                        </section>
                        <section class="mb-4">
                            <h4>Description :</h4>
                            <p>
                                WellDev is looking for a Senior UI & UX Designer who
                                will be responsible for leading different projects for
                                designing interactive and user friendly interfaces for
                                state of the art products of our clients. If you are
                                eager to design world class user experience for the
                                global market, we’d like to meet you. Ultimately, you
                                will be creating both functional and appealing features
                                that address our clients’ needs and help us grow our
                                customer base.
                            </p>
                        </section>
                        <section class="mb-4">
                            <dl>
                                <dt>Salary :</dt>
                                <dd>8,000 Taka - 12,000 Taka</dd>
                            </dl>
                        </section>
                        <section class="mb-4">
                            <h4>Job Requirements & Skills :</h4>
                            <ul class="job-skills">
                                <li>Minimum of 30 hours per week</li>
                                <li>
                                    Previous experience as a Chef De Partie/Demi Chef in a
                                    busy a la carte operation
                                </li>
                                <li>
                                    Flexible to work rostered shifts, including weekends,
                                    late nights and public holidays.
                                </li>
                                <li>Minimum of 30 hours per week</li>
                                <li>
                                    Previous experience as a Chef De Partie/Demi Chef in a
                                    busy a la carte operation
                                </li>
                                <li>
                                    Flexible to work rostered shifts, including weekends,
                                    late nights and public holidays.
                                </li>
                            </ul>
                        </section>
                        <section class="mb-4">
                            <dl>
                                <dt>Educational Requirements :</dt>
                                <dd>NA</dd>
                            </dl>
                        </section>
                        <section class="mb-4">
                            <dl>
                                <dt>Training & Certifications :</dt>
                                <dd>NA</dd>
                            </dl>
                        </section>
                        <section class="mb-4">
                            <h4>Compensation & Benefits :</h4>
                            <ul>
                                <li>
                                    Discounts at our hotels, restaurants and spas across
                                    our network
                                </li>
                                <li>Staff, family and friends rates at our hotels</li>
                                <li>
                                    Meals on duty, staff parking and uniform provided
                                </li>
                                <li>Minimum of 30 hours per week</li>
                                <li>Excellent reward & recognition events</li>
                                <li>Service and anniversary gifts and benefits</li>
                                <li>
                                    Wellbeing programme including Health insurance
                                    discounts
                                </li>
                                <li>
                                    Paid training and individual Employee Development
                                    Plans
                                </li>
                                <li>
                                    Training towards NZQA qualifications and our very own
                                    online digital learning platform
                                </li>
                                <li>
                                    Free Life Insurance, Digital Will & Best Doctors
                                    teleservice after 3 months of employment
                                </li>
                            </ul>
                        </section>
                        <section class="mb-4">
                            <h4>Additional Information :</h4>
                            <ul class="add-info">
                                <li>Gender : Male</li>
                                <li>Nationality : Bangladeshi</li>
                                <li>Specialties : Na</li>
                                <li>Industry : IT/ITES</li>
                                <li>Age Range : 25 - 35</li>
                                <li>Workplace : Work From Home</li>
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
                </div>
            </div>
        </div>
    </div>

    {{-- Schedule for later modal --}}
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
@endsection
