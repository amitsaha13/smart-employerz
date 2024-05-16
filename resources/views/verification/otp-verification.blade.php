<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('img/logo/favicon.ico') }}" title="smartemployerz" sizes="32x32">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="smartemployerz">

    <!-- Bootstrap 5.1.3  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--  Font-Awesome 5.15.4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Select2 4.0.4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css">
    <!-- intlTelInput 17.0.13 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <title>
        smartemployerz
    </title>

</head>

<body>

    @include('toastr')

    <!-- Start Main Section -->
    <main>
        <div class="container-fluid">
            <div class="row no-gutters">
                <div class="col-xxl-12 px-0">
                    <div class="login-wrapper d-flex">
                        <div class="card login-card border-0 bg-transparent">
                            <div class="card-header bg-transparent border-0 p-0">
                                <a href="/">
                                    <img src="{{ asset('img/logo/logo.png') }}" alt="logo" class="img-fluid" />
                                </a>
                            </div>
                            <div class="card-body p-0 h-100 ">
                                <div class="form-title">
                                    <h2 class="text-capitalize ">Check Your Email</h2>
                                    <p class="mb-0">Input OTP to reset password</p>
                                </div>

                                <form method="POST" action="/recruiter/register" autocomplete="off">
                                    @csrf
                                    <input type="text" name="name" id="" value="amti">
                                    <div class="form-group">
                                        <fieldset>
                                            <label class="form-label" for="otp">Input OTP</label>
                                            <div class="inputfield">
                                                <input type="number" maxlength="1" name="otp1" id="otp1"
                                                    class="input border-right-0" oninput="checkOTP()" />
                                                <input type="number" name="otp2" id="otp2" maxlength="1"
                                                    class="input rounded-0 border-right-0" disabled
                                                    oninput="checkOTP()" />
                                                <input type="number" name="otp3" maxlength="1" id="otp3"
                                                    class="input rounded-0 border-right-0" disabled
                                                    oninput="checkOTP()" />
                                                <input type="number" name="otp4" maxlength="1" id="otp4"
                                                    class="input" disabled oninput="checkOTP()" />
                                                <input type="number" name="otp5" maxlength="1" id="otp5"
                                                    class="input" disabled oninput="checkOTP()" />

                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-grid col-12">

                                            <button id="timer" class="otp-btn">2:00</button>
                                            <button id="resendButton" type="button" style="display: none;"
                                                onclick="resendOTP()">Resend OTP</button>
                                            <button id="verifyButton" type="submit" style="display: none;">Verify
                                                OTP</button>

                                        </div>

                                    </div>
                                </form>
                                <p class="text-center form-footer">Check Email & Input OTP Within 2 minutes
                                </p>
                            </div>
                        </div>
                        <div class="login-image forget-image">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- End Main Section -->

    <!-- JQuery 3.7.1 -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Bootstrap 5.1.3 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <!-- Select2 4.0.4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <!-- intlTelInput 17.0.13 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/custom.js') }}"></script>

    <script>
        // Countdown timer for 2 minutes
        var timeLeft = 120; // 2 minutes in seconds
        var timerElement = document.getElementById('timer');
        var otpInputs = document.querySelectorAll('.input');
        var verifyButton = document.getElementById('verifyButton');
        var resendButton = document.getElementById('resendButton');

        function countdown() {
            var minutes = Math.floor(timeLeft / 60);
            var seconds = timeLeft % 60;
            timerElement.textContent = minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
            if (timeLeft === 0) {
                clearInterval(timerInterval);
                verifyButton.style.display = 'none';
                timerElement.style.display = 'none';
                resendButton.style.display = 'block';
                resendButton.disabled = false;
            } else {
                console.log(timeLeft);
                timeLeft--;
            }
        }

        var timerInterval = setInterval(countdown, 1000);

        // Function to check if all OTP inputs are filled
        function checkOTP() {
            var allFilled = true;
            otpInputs.forEach(input => {
                if (input.value === "") {
                    allFilled = false;
                }
            });

            if (allFilled) {
                verifyButton.style.display = 'block';
                verifyButton.disabled = false;
                // resendButton.style.display = 'none';
                // resendButton.disabled = true;
            } else {
                verifyButton.style.display = 'none';
                verifyButton.disabled = true;
            }
        }

        // Attach input event listeners to OTP inputs
        otpInputs.forEach(input => {
            input.addEventListener('input', function() {
                checkOTP();
                var nextInput = this.nextElementSibling;
                if (nextInput && nextInput.classList.contains('input')) {
                    nextInput.disabled = false;
                    nextInput.focus();
                }
            });
        });

        // Function to resend OTP
        function resendOTP() {

            otpInputs.forEach(input => {
                input.value = ""
            });
            // Get the CSRF token from the meta tag
            const csrfToken = "{{ csrf_token() }}";

            // Make an AJAX request to resend OTP
            fetch('/recruiter/register/mail-verification', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken, // Include CSRF token in the headers
                    },
                    body: JSON.stringify({}),
                })
                .then(response => {
                    console.log(response)
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    // Reset the timer and hide the Resend button
                    timeLeft = 120; // Resetting timer to 2 minutes
                    timerElement.textContent = '2:00';
                    resendButton.style.display = 'none';
                    timerElement.style.display = 'block';
                    verifyButton.style.display = 'none';
                    verifyButton.disabled = true;

                    timerInterval = setInterval(countdown, 1000); // Restart the countdown
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
        }

        // Initial setup
        window.onload = function() {
            var verifyButton = document.getElementById('verifyButton');
            var resendButton = document.getElementById('resendButton');
            verifyButton.style.display = 'none';
            resendButton.style.display = 'none';
            otpInputs.forEach((input, index) => {
                input.disabled = index !== 0; // Only the first input is enabled initially
            });
            countdown(); // Start the countdown on page load
        }
    </script>

</body>

</html>
