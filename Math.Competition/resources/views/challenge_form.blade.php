<!DOCTYPE html>
<html>
<head>
    <title>Create Challenge</title>
</head>
<body>
    <h1>Create Challenge</h1>

    <form action="{{ route('createChallenge') }}" method="POST">
        @csrf
        <div>
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" required>
        </div>
        <div>
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" required>
        </div>
        <div>
            <label for="duration">Duration (minutes):</label>
            <input type="number" name="duration" id="duration" required>
        </div>
        <div>
            <label for="num_questions">Number of Questions:</label>
            <input type="number" name="num_questions" id="num_questions" required>
        </div>
        <button type="submit">Create Challenge</button>
    </form>
</body>
</html>
