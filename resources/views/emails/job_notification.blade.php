<!DOCTYPE html>
<html>
<head>
    <title>New Job Notification</title>
</head>
<body>
    <h1>New Job Available!</h1>
    <p>Dear {{ $candidate->job_seeker_id }},</p>
    <p>A new job matching your profile has been posted:</p>
    <ul>
        <li>Job Title: {{ $job->job_title }}</li>
        <li>Business Area: {{ $job->business_area }}</li>
        <li>Publish Date: {{ $job->publish_date }}</li>
        <li>Deadline: {{ $job->deadline }}</li>
    </ul>
    <p>Best regards,<br>Your Company</p>
</body>
</html>
