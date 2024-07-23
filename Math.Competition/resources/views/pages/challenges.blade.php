<!DOCTYPE html>
<html>
<head>
    <title>Challenge</title>
    <script>
        // JavaScript to handle countdown timer
        let timeRemaining = {{ $timeRemaining }};
        setInterval(function() {
            if (timeRemaining <= 0) {
                document.getElementById('challengeForm').submit();
            } else {
                timeRemaining--;
                document.getElementById('time').innerHTML = Math.floor(timeRemaining / 60) + ":" + (timeRemaining % 60);
            }
        }, 1000);
    </script>
</head>
<body>
    <h1>Challenge</h1>
    <p>Time Remaining: <span id="time"></span></p>

    <form id="challengeForm" action="{{ route('challenge.submit') }}" method="POST">
        @csrf
        @foreach ($questions as $question)
            <div>
                <p>{{ $question->text }}</p>
                <input type="text" name="answer[{{ $question->id }}]" required>
            </div>
        @endforeach
        <button type="submit">Submit</button>
    </form>
</body>
</html>
