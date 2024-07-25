<!DOCTYPE html>
<html>
<head>
    <title>Create Challenge</title>
</head>
<body>
<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-20 mt-10">
                  @if (session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                  @endif
                    <div class="card">
                        <div class="card-header">
                        <h4 class="card-title">{{ __('Manage Questions') }}</h4>
                        <p class="card-category">{{ __('upload questions from your desktop ') }}</p>
                        </div>
                         <div class="card-body" >   

                         <form action="{{ route('upload_questions') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                        <div class="form-group">
                    <label for="questions">Upload Questions File:</label>
                    <input type="file" name="import_questions" id="questions" required>
            </div>
        <button class="btn btn-primary" type="submit">Upload</button>
    </form>

    <div class="card-header">
                        <h4 class="card-title">{{ __('Manage Answers') }}</h4>
                        <p class="card-category">{{ __('upload answers from your desktop') }}</p>
                        </div>
                         <div class="card-body" >   

                         <form action="{{ route('upload_answers') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                        <div class="form-group">
                    <label for="questions">Upload Answers File:</label>
                    <input type="file" name="import_answers" id="questions" required>
            </div>
        <button class="btn btn-primary" type="submit">Upload</button>
    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    

    <div class="container">
        <div class="col-ml12 mt8">
            <div class="card">
                <div class="card-header">
            <h1 class="col-ml 5 mt 5">Set Challenge Parameters</h1> </div>
    <div class="card-content">

    <form action="{{ route('manage_challenge') }}" method="POST" class="challenge-card" style="color:green">
        @csrf
        <div class="challenge">
        <div>
            <div class="card-header">
            <h4 class="card-title">Start Date</h4>
            </div>
            <div class="col-lg-10 col-md-15">
            <input type="date" name="startDate" id="startDate" required>
            </div>
        </div>
        <div>
        <div class="card-header">
            <h4 class="card-title">End Date</h4>
            </div>
            <label for="endDate">End Date:</label>
            <input type="date" name="endDate" id="endDate" required>
        </div>
        <div>
        <div class="card-header">
            <h4 class="card-title">Duration</h4>
            </div>
            <label for="duration">Duration (minutes):</label>
            <input type="number" name="duration" id="duration" required>
        </div>
        <div>
        <div class="card-header">
            <h4 class="card-title">Number Of Questions</h4>
            </div>
            <label for="no_of_questions">Number of Questions:</label>
            <input type="number" name="no_of_questions" id="no_of_questions" required>
        </div>
        <div>
        <button type="submit" >Create Challenge</button>
        </div>
        </div>
    </form>
    </div>
    </div>
    </div>
</div>


    <table>
    <thead>
        <tr>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Duration</th>
            <th>Number of Questions</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($challenges as $challenge)
        <tr>
            <td>{{ $challenge->startDate }}</td>
            <td>{{ $challenge->endDate }}</td>
            <td>{{ $challenge->duration }}</td>
            <td>{{ $challenge->no_of_questions }}</td>
            <td>
                <a href="{{ route('edit-challenge', $challenge->id) }}">Edit</a>
                <form action="{{ route('delete-challenge', $challenge->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>



</table>

</body>
</html>
