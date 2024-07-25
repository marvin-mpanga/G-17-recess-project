<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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
        }
        
        /* Style the popup register form */
        .login-popup {
            background-color: white;
            padding: 20px;
            border: 1px solid #888;
            width: 500px; /* Increased width */
            height: 300px; /* Increased height */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
            border-radius: 10px;
            
        }
         .card {
             margin: 20px;
        }
        .form-control {
            height: 30px;
            width: 400px;
            font-size: 15px;
        }
        .form-control::placeholder {
            color: #666;
                opacity: 0.6;}
                
    </style>
</head>
<body>
    <!-- Create a popup login form in the middle of the screen -->
    <div class="login-popup">
        <div class="card">
            <div class="card-header">{{ __('') }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.login.submit') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="adminId" class="col-md-4 col-form-label text-md-right">{{ __('') }} <span class="text-danger"></span></label>
                        <div class="col-md-6">
                            <input id="adminId" type="text" class="form-control @error('adminId') is-invalid @enderror" name="adminId" value="{{ old('adminId') }}" required autocomplete="adminId" autofocus placeholder="Enter Admin ID">
                            @error('adminId')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <span class="text-muted"></span>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('') }} <span class="text-danger"></span></label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Enter Name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <span class="text-muted"></span>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('') }} <span class="text-danger"></span></label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <span class="text-muted"></span>
                        </div>
                    </div>
                    <br>
                    </div>
                    <div class="form-group row mb-0">
                             <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                            <a href="{{ url('/index.php') }}" class="btn btn-primary">Login</a>

                            </button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8 offset-md-4">
                        <p><a href="{{ route('admin_register') }}" class="btn btn-link">Register</a> | <a  class="btn btn-link">Forgot Password?</a></p>


                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>