
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-25">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Manage Challenges') }}</h4>
                        <p class="card-category">{{ __('Add, edit, or remove challenges') }}</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('set.challenge.params') }}">
                            @csrf
                            <div class="form-group">
                                <label for="start_date">Start Date:</label>
                                <input type="date" class="form-control" name="start_date" required>
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date:</label>
                                <input type="date" class="form-control" name="end_date" required>
                            </div>
                            <div class="form-group">
                                <label for="duration">Duration (minutes):</label>
                                <input type="number" class="form-control" name="duration" required min="1">
                            </div>
                            <div class="form-group">
                                <label for="num_questions">Number of Questions:</label>
                                <input type="number" class="form-control" name="num_questions" required min="1" max="100">
                            </div>
                            <button type="submit" class="btn btn-primary">Set Challenge Parameters</button>
                        </form>
                        <!-- List of challenges -->
                        <div class="card mt-4">
                            <div class="card-header">Challenges</div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach($challenges as $challenge)
                                    <li class="list-group-item">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Challenge {{ $loop->iteration }}</h5>
                                                <p class="card-text">
                                                    Start Date: {{ $challenge->start_date }}<br>
                                                    End Date: {{ $challenge->end_date }}<br>
                                                    Duration: {{ $challenge->duration }} minutes<br>
                                                    Number of Questions: {{ $challenge->num_questions}}
                                                    </p>
                                                    </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@end

