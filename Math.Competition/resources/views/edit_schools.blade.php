

<!DOCTYPE html>
<html>
<head>
    <title>{{ __('Edit School') }}</title>
</head>
<body>
    <h1>{{ __('Edit School') }}</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


