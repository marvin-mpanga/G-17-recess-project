
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rep Register</title>
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
        .register-popup {
    background-color: white;
    padding: 20px;
    border: 1px solid #888;
    width: 200px; /* Increased width */
    height: 400px; /* Increased height */
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
}


    </style>
</head>
<body>
    <!-- Create a popup register form in the middle of the screen -->
    Here is the updated code with the added form fields:

<div class="register-popup">
    <div class="card">
        <div class="card-header">{{ __('Rep Register') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('rep.register.submit') }}">
                @csrf
                <div class="form-group row">
                    <label for="repId" class="col-md-4 col-form-label text-md-right">{{ __('Rep ID') }}</label>
                    <div class="col-md-6">
                        <input id="repId" type="text" class="form-control @error('repId') is-invalid @enderror" name="repId" value="{{ old('repId') }}" required autocomplete="repId" autofocus>
                        @error('repId')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="schoolRegNo" class="col-md-4 col-form-label text-md-right">{{ __('School Reg No') }}</label>
                    <div class="col-md-6">
                        <input id="schoolRegNo" type="text" class="form-control @error('schoolRegNo') is-invalid @enderror" name="schoolRegNo" value="{{ old('schoolRegNo') }}" required autocomplete="schoolRegNo">
                        @error('schoolRegNo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="repName" class="col-md-4 col-form-label text-md-right">{{ __('Rep Name') }}</label>
                    <div class="col-md-6">
                        <input id="repName" type="text" class="form-control @error('repName') is-invalid @enderror" name="repName" value="{{ old('repName') }}" required autocomplete="repName">
                        @error('repName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                    <div class="col-md-6">
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary"> {{ __('Register') }} </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</body>
</html>

