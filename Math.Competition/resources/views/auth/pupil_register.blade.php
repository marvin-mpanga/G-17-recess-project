
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pupil Registration</title>
    <style>
        /* Add a background image to the body tag */
        body {
            background-image: url('/light-bootstrap/img/math-olympiad-one.png');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .btn-primary {
            padding: 10px 10px;
            font-size: 22px;
            width: 150px;
        }
        /* Style the popup registration form */
        .registration-popup {
            background-color: white;
            padding: 40px;
            border: 1px solid #888;
            width: 700px;
            height: 500px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
        }
        .form-control {
            height: 40px;
            width: 250px;
            font-size: 18px;
        }
        .form-control::placeholder {
            color: #666;
            opacity: 0.6;
        }
        /* Make the form fields side by side */
        .form-group {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
        
.left-column {
    width: 50%;
    padding-right: 20px;
}

.right-column {
    width: 50%;
    padding-left: 20px;
}

.form-group {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}
        .form-group label {
            width: 120px;
        }
        .form-group input {
            width: 250px;
        }
    </style>
</head>
<body>
    <!-- Create a popup registration form in the middle of the screen -->
    <div class="registration-popup">
        <div class="card">
            <div class="card-header">{{ __('') }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('pupil.register.submit') }}" id="registerForm">
                    @csrf
                   

<div class="form-group">
    <div class="left-column">
        <label for="pupilId" class="col-md-4 col-form-label text-md-right">{{ __('') }} <span class="text-danger">*</span></label>
        <input id="pupilId" type="text" class="form-control @error('pupilId') is-invalid @enderror" name="pupilId" value="{{ old('pupilId') }}" required autocomplete="pupilId" autofocus placeholder="Please enter your pupil ID">
        @error('pupilId')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <br><br>
    <div class="right-column">
        <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('') }} <span class="text-danger">*</span></label>
        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Please enter your username">
        @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div><br><br>
<div class="form-group">
    <div class="left-column">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('') }} <span class="text-danger">*</span></label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Please enter your name">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div><br><br>
    <div class="right-column">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('') }} <span class="text-danger">*</span></label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Please enter your email">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div><br><br>
<div class="form-group">
    <div class="left-column">
        <label for="D_O_B" class="col-md-4 col-form-label text-md-right">{{ __('') }} <span class="text-danger">*</span></label>
        <input id="D_O_B" type="date" class="form-control @error('D_O_B') is-invalid @enderror" name="D_O_B" value="{{ old('D_O_B') }}" required autocomplete="D_O_B" placeholder="Please enter your date of birth">
        @error('D_O_B')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="right-column">
        <!-- Empty column to balance the grid -->
    </div>
</div><br><br>
<div class="form-group">
    <div class="left-column">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('') }} <span class="text-danger">*</span></label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Please enter your password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div><br><br>
    <div class="right-column">
        <label for="renterPassword" class="col-md-4 col-form-label text-md-right">{{ __('') }} <span class="text-danger">*</span></label>
        <input id="renterPassword" type="password" class="form-control @error('renterPassword') is-invalid @enderror" name="renterPassword" required autocomplete="current-password" placeholder="Please re-enter your password">
        @error('renterPassword')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div><br><br>
<div class="form-group">
    <div class="

<div class="form-group row mb-0"> 
<div class="col-md-8 offset-md-4" style="display: flex; justify-content: center;">
    <a href="{{ route('pupil.register.submit') }}">
        <button type="submit" class="btn btn-primary" > {{ __('Register') }} </button>
    </a>
</div>

</div>
