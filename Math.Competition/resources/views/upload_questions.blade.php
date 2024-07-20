<!DOCTYPE html>
<html>
<head>
    <title>Upload Questions and Answers</title>
</head>
<body>
    <h1>Upload Questions and Answers</h1>

    <form action="{{ route('upload_questions') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="questions">Upload Questions File:</label>
            <input type="file" name="questions" id="questions" required>
        </div>
        <div>
            <label for="answers">Upload Answers File:</label>
            <input type="file" name="answers" id="answers" required>
        </div>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
