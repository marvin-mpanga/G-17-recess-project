<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pupil Login</title>
    <style>
        /* Add a background image to the body tag */
        body {
            background-image: url('/light-bootstrap/img/math-olympiad-2.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(5px);
        }
        
        

        /* Style the popup login form */
        .login-popup {
            background-color: white;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 30px;
            width: 350px;
            /* Increased width */
            height: 300px;
            /* Increased height */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0px 0px 10px rgba(0,0,0,0.3)
        }  
        .card {
            border-radius: 30px;
            margin: 20px;
        }      
        .form-control {
            opacity: 0.6;
        }
        .form-control::placeholder {
            color: #666;height: 30px;
            width: 300px;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <!-- Create a popup login form in the middle of the screen -->
    <div class="login-popup">
        <div class="card">
            <div class="card-header">{{ __('') }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('pupil.login.submit') }}" id="loginForm">
                    @csrf
                    <!-- <div class="form-group row">
                        <label for="schoolRegNo" class="col-md-4 col-form-label text-md-right">{{ __('') }} <span class="text-danger"></span></label>
                        <div class="col-md-6">
                            <input id="schoolRegNo" type="text" class="form-control @error('schoolRegNo') is-invalid @enderror" name="schoolRegNo" value="{{ old('schoolRegNo') }}" required autocomplete="schoolRegNo" autofocus placeholder="Please enter your school registration number">
                            @error('schoolRegNo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> -->
                    </div>
                    <br>
                    <br>
                    <div class="form-group row">
                        <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('') }} <span class="text-danger"></span></label>
                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Please enter your username">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('') }} <span class="text-danger"></span></label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Please enter your password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary" id="loginBtn">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8 offset-md-4">
                        <p><a href="{{ route('pupil_register') }}" class="btn btn-link">Register</a> | <a  class="btn btn-link">Forgot Password?</a></p>


                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
   </body>
   </html>