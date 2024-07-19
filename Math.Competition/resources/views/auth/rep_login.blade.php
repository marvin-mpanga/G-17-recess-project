
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rep Login</title>
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
        /* Style the popup login form */
        .login-popup {
            background-color: white;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
            height: 250px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>
    <!-- Create a popup login form in the middle of the screen -->
    <div class="login-popup">
        <div class="card">
            <div class="card-header">{{ __('Rep Login') }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('rep.login.submit') }}">
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
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8 offset-md-4">
                            <p>Don't have an account? <a href="{{ route('rep.register') }}" class="btn btn-link">Register!</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
