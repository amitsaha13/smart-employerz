<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Description Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <form id="jobForm">
        <div class="form-group">
            <label for="jobTitle">Job Title:</label>
            <input type="text" class="form-control" id="jobTitle" name="jobTitle" required>
        </div>

        <div class="form-group">
            <label for="jobDescription">Job Description:</label>
            <textarea class="form-control" id="jobDescription" name="jobDescription" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="responsibilities">Responsibilities:</label>
            <textarea class="form-control" id="responsibilities" name="responsibilities" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="requiredSkills">Required Skills:</label>
            <textarea class="form-control" id="requiredSkills" name="requiredSkills" rows="4" required></textarea>
        </div>

        <button type="button" class="btn btn-primary" onclick="generateWithAI()">Generate with AI</button>

        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function generateWithAI() {
        console.log(5);
        // Simulate the fetch request to the specified route
        fetch('/fetch-job-description')
            .then(response => response.json())
            .then(data => {
                // Set the fetched data to the corresponding form fields
                document.getElementById('jobDescription').value = data['Job Description'];
                document.getElementById('responsibilities').value = data['Responsibilities'];
                document.getElementById('requiredSkills').value = data['Required Skills'];
            })
            .catch(error => console.error('Error fetching job details:', error));
    }
</script>

</body>
</html>
