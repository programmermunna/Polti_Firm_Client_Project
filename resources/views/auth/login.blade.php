<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $settings->project_name }} | Login</title>
    <link rel="icon" href="{{ asset("custom/logos/")."/".$settings->project_logo }}" type="image/ico" />
    <!-- Bootstrap -->
    <link href="{{ asset('asset/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('asset/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('asset/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ asset('asset/vendors/animate.css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('asset/build/css/custom.min.css') }}" rel="stylesheet">
</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    @if (session('message'))
                        <div class="alert alert-danger">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form action="{{ route('login.store') }}" method="post">
                        @csrf
                        <h1>Login Form</h1>
                        <div>
                            <input type="email" name="email" class="form-control" placeholder="Email" />
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <input type="password" name="password" class="form-control" placeholder="Password" />
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <input type="submit" class="btn btn-primary" value="Log in">
                            <a class="reset_pass" href="#">Lost your password?</a>
                        </div>                        

                        <div class="separator">

                            <p class="change_link">New to site?
                                <a href="#signup" class="to_register"><small>Create Account</small></a>
                            </p>

                            
                            <br />

                            <div>
                                <h1><img style="width:40px; height:40px;" src="{{ asset("custom/logos/")."/".$settings->project_logo }}"
                                        alt=""> {{ $settings->project_name }}</h1>
                                <p>©2023 All Rights Reserved {{ $settings->project_name }}
                                    <br>
                                    Privacy and Terms Conditions
                                </p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>

            <div id="register" class="animate form registration_form">
                <section class="login_content">
                    <form>
                        <h1>Create Account</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Username" required="" />
                        </div>

                        <div>
                            <input type="email" class="form-control" placeholder="Email" required="" />
                        </div>

                        <div>
                            <input type="password" class="form-control" placeholder="Password" required="" />
                        </div>

                        <div>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>

                        

                        <div class="separator">
                            <p class="change_link">Already a member ?
                                <a href="#signin" class="to_register"> Log in </a>
                            </p>

                            
                            <br />

                            <div>
                                <h1> <img style="width:40px; height:40px;" src="{{ asset("custom/logos/")."/".$settings->project_logo }}"
                                        alt=""> {{ $settings->project_name }}</h1>
                                        <p>©2023 All Rights Reserved {{ $settings->project_name }}
                                            <br>
                                            Privacy and Terms Conditions
                                        </p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>

</html>
