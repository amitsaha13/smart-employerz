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
                                                    class="input border-right-0"  oninput="checkOTP()" />
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

                                            <button id="timer" class="otp-btn">2.00</button>
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



</body>

</html>
