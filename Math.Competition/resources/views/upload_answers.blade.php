<!-- resources/views/admin/answers.blade.php -->
@extends('layouts.app', ['activePage' => 'answers', 'title' => 'Manage Answers', 'navName' => 'Manage Answers','activeButton'=> 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Manage Answers') }}</h4>
                            <p class="card-category">{{ __('Add, edit, or remove answers') }}</p>
                        </div>
                        <div class="card-body">
                            <!-- Add Answer Form -->
                            <form method="POST" action="{{ route('upload_answers') }}">
                           @csrf
                        <select name="question_id">
                          @foreach($questions as $question)
                           <option value="{{ $question->id }}">{{ $question->title }}</option>
                          @endforeach
                             </select>
                         <textarea name="answer" placeholder="Answer"></textarea>
                                             <button type="submit">Upload Answer</button>
                                </form>

                            <!-- <form method="POST" action="{{ route('admin.upload_answers') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="question_id">{{ __('Question ID') }}</label>
                                    <input type="number" class="form-control" id="question_id" name="question_id" required>
                                </div>
                                <div class="form-group">
                                    <label for="answer">{{ __('Answer') }}</label>
                                    <textarea class="form-control" id="answer" name="answer" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ __('Add Answer') }}</button>
                            </form> -->

                            <!-- List of Answers -->
                            <div class="mt-4">
                                <h5>{{ __('Existing Answers') }}</h5>
                                <ul class="list-group">
                                    <!-- Example Answer Item -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Example Answer
                                        <span>
                                            <a href="{{ url('admin/answers/edit/1') }}" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="{{ url('admin/answers/delete/1') }}" class="btn btn-sm btn-danger">Delete</a>
                                        </span>
                                    </li>
                                    <!-- Add more answer items dynamically -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
