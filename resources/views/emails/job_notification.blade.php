<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Alert</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .email-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .email-header {
            text-align: center;
            padding: 10px 0;
        }

        .email-footer {
            text-align: left;
            padding: 10px 0;
        }

        .email-body {
            padding: 20px 0;
        }

        .job-details {
            background-color: #ebf5f7;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .btn-apply {
            display: block;
            width: 100%;
            height: 50px;
            text-align: center;
            margin-top: 20px;
            background-color: #00756a;
            border: #00756a;
            color: white
        }
    </style>
</head>

<body>

    <div class="email-container">
        <div class="email-header">
            <img src="https://smartemployerz-web.netlify.app/img/logo/logo.svg" alt="Smartemployers Logo">
        </div>

        <div class="email-body">
            <p>Dear {{ $candidate->first_name }} {{ $candidate->last_name }},</p>
            <p>The Employer from {{ $job->company_name }} is actively hiring for an <b>{{ $job->job_title }}</b>, and
                your
                profile appears to be a good match.</p>

            <div class="job-details">
                <p><strong>Job Role:</strong> {{ $job->job_title }}</p>
                <p><strong>Experience Required:</strong> {{ $job->min_experience }} - {{ $job->max_experience }} years</p>
                <p><strong>Job Location:</strong> {{ $job->job_location }}</p>
            </div>

            <p>Please ensure your latest details are updated and apply for the job at your earliest convenience.</p>

            <a href="#" class="btn btn">Apply Now</a>
        </div>

        <div class="email-footer">
            <p>Best regards,</p>
            <p>Team Smartemployers</p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
