@include('toastr')
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
        Login | {{ config('app.name') }}
    </title>

</head>

<body>
    @include('toastr')


    <!-- Start Main Section -->
    <main>
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="login-wrapper d-flex">
                        <div class="card login-card border-0 bg-transparent">
                            <div class="card-header bg-transparent border-0 p-0">
                                <a href="/">
                                    <img src="{{ asset('img/logo/logo.png') }}" alt="logo" class="img-fluid" />
                                </a>
                            </div>
                            <div class="card-body p-0 h-100 ">
                                <div class="form-title">
                                    <h2 class="text-capitalize ">user login</h2>
                                    <p class="mb-0">Here is today’s report and performances</p>
                                </div>
                                <div class="social-links">
                                    <a href="/auth/google"
                                        class="text-center d-flex align-items-center justify-content-center text-decoration-none mb-3">
                                        <img src="{{ asset('img/auth/gmail.png') }}" alt="gmail-logo" />
                                        Login With Google
                                    </a>

                                    <a href="/auth/facebook"
                                        class="text-center d-flex align-items-center justify-content-center text-decoration-none mb-3"
                                        target="_blank">
                                        <img src="{{ asset('img/auth/facebook.png') }}" alt="facebook-logo" />
                                        Login With Facebook
                                    </a>
                                    <a href="/auth/linkedin"
                                        class="text-center d-flex align-items-center justify-content-center text-decoration-none mb-3">
                                        <img src="{{ asset('img/auth/linkedin.png') }}" alt="linkedin-logo" />
                                        Login With Linkedin
                                    </a>
                                </div>
                                <form method="post" action="{{ route('recruiter.login') }}" autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label" for="email">Email</label>
                                        <input class="form-control" type="email" name="email" id="email"
                                            autocomplete="off" placeholder="John.snow@gmail.com" required>
                                    </div>
                                    <div class="form-group position-relative" id="show_hide_password">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" id="password" name="password"
                                                placeholder="Enter your Password" autocomplete="off"
                                                class="form-control" required />
                                            <div class="input-group-addon">
                                                <a href="javascript:void(0)">
                                                    <i class="far slash-icon fa-eye-slash" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-center form-footer mt-5">Forget Password? Click <a
                                            href="/recruiter/reset-password">Reset Password</a>
                                    </p>
                                    <div class="form-group">
                                        <div class="d-grid col-12">
                                            <button type="submit" class="btn rounded-0 ">Log
                                                in</button>
                                        </div>
                                    </div>

                                </form>
                                <p class="text-center form-footer">If You Don’t Have Any Account, Click <a
                                        href="/recruiter/register">Sign Up</a>
                                </p>
                            </div>
                        </div>
                        <div class="login-image">
                            <img src="{{ asset('img/auth/login-image.png') }}" class="img-fluid" alt="Login Image" />
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
