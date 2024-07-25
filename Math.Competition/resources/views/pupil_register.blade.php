<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pupil Registration</title>
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
        .btn-primary {
            font-size: 22px;
            width: 150px;
        }
        /* Style the popup registration form */
        .registration-popup {
            background-color: white;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 30px;
            width: 600px;
            height: 400px; /* Increased height */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .card {
            border-radius: 30px;
            margin: 20px;
        }
        .form-control {
            height: 40px;
            width: 250px;
            font-size: 18px;
        }
        .form-control::placeholder {
            color: #666;
            font-size: 13px;
        }
        .form-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        .left-column, .right-column {
            width: 48%;
        }
        .form-group label {
            display: block;
        }
        .form-group input {
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- Create a popup registration form in the middle of the screen -->
    <div class="registration-popup">
        <div class="card">
            <div class="card-header">{{ __('Pupil Registration') }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('pupil.register.submit') }}" id="registerForm">
                    @csrf
                    <div class="form-group">
                        <div class="left-column">
                            <label for="pupilId"> <span class="text-danger"></span></label>
                            <input id="pupilId" type="text" class="form-control @error('pupilId') is-invalid @enderror" name="pupilId" value="{{ old('pupilId') }}" required autocomplete="pupilId" autofocus placeholder="Please enter your pupil ID">
                            @error('pupilId')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="right-column">
                            <label for="username"><span class="text-danger"></span></label>
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Please enter your username">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="left-column">
                            <label for="fName"><span class="text-danger"></span></label>
                            <input id="fName" type="text" class="form-control @error('fName') is-invalid @enderror" name="fName" value="{{ old('fName') }}" required autocomplete="fName" placeholder="Please enter your first name">
                            @error('fName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="right-column">
                            <label for="lName"><span class="text-danger"></span></label>
                            <input id="lName" type="text" class="form-control @error('lName') is-invalid @enderror" name="lName" value="{{ old('lName') }}" required autocomplete="lName" placeholder="Please enter your last name">
                            @error('lName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="left-column">
                            <label for="email"> <span class="text-danger"></span></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Please enter your email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="right-column">
                            <label for="D_O_B"><span class="text-danger"></span></label>
                            <input id="D_O_B" type="date" class="form-control @error('D_O_B') is-invalid @enderror" name="D_O_B" value="{{ old('D_O_B') }}" required autocomplete="D_O_B" placeholder="Please enter your date of birth">
                            @error('D_O_B')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="left-column">
                            <label for="password"><span class="text-danger"></span></label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Please enter your password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="right-column">
                            <label for="renterPassword"><span class="text-danger"></span></label>
                            <input id="renterPassword" type="password" class="form-control @error('renterPassword') is-invalid @enderror" name="renterPassword" required autocomplete="current-password" placeholder="Please re-enter your password">
                            @error('renterPassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
    <div class="

<div class="form-group row mb-0"> 
    <div class="col-md-8 offset-md-4" style="display: flex; justify-content: center;"> 
        <button type="submit" class="btn btn-primary"> {{ __('Register') }} </button> 
    </div> 
</div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>