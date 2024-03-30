function generateWithAI() {
    var jobTitle = $("#jobTitle").val().trim();
    var jobLevel = $("#job_level option:selected").text().trim();
    var minExperience = ($("#min_experience").val().trim());
    var maxExperience = ($("#max_experience").val().trim());

    var payload = {
        jobTitle: jobTitle,
        jobLevel: jobLevel,
        minExperience: minExperience,
        maxExperience: maxExperience
    };
    // Fetch CSRF token from the meta tag
    var token = $('meta[name="csrf-token"]').attr('content');

    fetch('/fetch-job-details', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify(payload)
    })
        .then(response => response.json())
        .then(data => {
            // Check if the response indicates failure
            if (data.success === false) {
                // Display an alert message to the user
                alert(data.message);
                return;
            }

            // Set the fetched data to the corresponding form fields
            document.getElementById('jobDescription').value = data['Job Description'];
            document.getElementById('responsibilities').value = data['Responsibilities'];
            document.getElementById('requiredSkills').value = data['Required Skills'];
        })
        .catch(error => console.error('Error fetching job details:', error));
}

// Update Preview Job Circular Modal
$(document).ready(function () {
    $("#previewBtn").on("click", function () {
        $("#jobTitle_preview").text($("#jobTitle").val());
        $("#employmentType_preview").text($("#employmentType").val());
        $("#jobDescription_preview").text($("#jobDescription").val());

        $("#employmentType_preview1").text($("#employmentType").val());
        $("#experience_preview").text($("#min_experience").val() + ' - ' + $("#max_experience")
            .val() + ' Years');
        $("#location_preview").text($("#countries option:selected").text());
        $("#jobDescription_preview1").text($("#jobDescription").val());
        $("#salary_preview").text($("#min_salary").val() + ' - ' + $("#max_salary").val() + $(
            "#currency option:selected").text());

        var skillsText = $("#requiredSkills").val();
        // Split the skillsText into an array of lines
        var skillsArray = skillsText.split('\n-');

        // Remove empty lines
        skillsArray = skillsArray.filter(function (skill) {
            return skill.trim() !== '';
        });
        $("#requiredSkills_preview").text('');
        // Create the list items and append them to the #requiredSkills_preview ul
        for (var i = 0; i < skillsArray.length; i++) {
            $("#requiredSkills_preview").append("<li>" + skillsArray[i].trim() + "</li>");
        }

        $("#educational_requirements_preview").text($("#educational_requirements").val());
        $("#training_certification_preview").text($("#training_certification").val());
        // Benefits Preview
        var benifitsText = $("#benifits").val();
        var benifitsArray = benifitsText.split('\n-');

        // Remove empty lines
        benifitsArray = benifitsArray.filter(function (benefit) {
            return benefit.trim() !== '';
        });

        // Clear the content of the #benifits_preview div
        $("#benifits_preview").empty();

        // Create the list items and append them to the #benifits_preview div
        for (var j = 0; j < benifitsArray.length; j++) {
            $("#benifits_preview").append("<li>" + benifitsArray[j].trim() + "</li>");
        }

        $("#gender_preview").text($("#gender option:selected").text());
        $("#nationality_preview").text($("#nationality").val());
        $("#specialization_preview").text($("#specialization").val());
        $("#industry_preview").text($("#CompanyIndustry").val());
        $("#age_preview").text($("#min_age").val() + ' - ' + $("#max_age").val() + ' Years');
        $("#workplace_preview").text($("#workplace option:selected").text());

    });

});