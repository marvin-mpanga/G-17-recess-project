<!-- resources/views/admin/questions.blade.php -->
@extends('layouts.app', ['activePage' => 'questions', 'title' => 'Manage Questions', 'navName' => 'Manage Questions', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Manage Questions') }}</h4>
                            <p class="card-category">{{ __('Add, edit, or remove questions') }}</p>
                        </div>
                        <div class="card-body">
                            <!-- Add Question Form -->
                            <form method="POST" action="{{ route('admin.questions') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="question">{{ __('Question') }}</label>
                                    <textarea class="form-control" id="question" name="question" rows="3" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="difficulty">{{ __('Difficulty') }}</label>
                                    <select class="form-control" id="difficulty" name="difficulty" required>
                                        <option value="easy">{{ __('Easy') }}</option>
                                        <option value="medium">{{ __('Medium') }}</option>
                                        <option value="hard">{{ __('Hard') }}</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ __('Add Question') }}</button>
                            </form>

                            <!-- List of Questions -->
                            <div class="mt-4">
                                <h5>{{ __('Existing Questions') }}</h5>
                                <ul class="list-group">
                                    <!-- Example Question Item -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Example Question
                                        <span>
                                            <a href="{{ url('admin/questions/edit/1') }}" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="{{ url('admin/questions/delete/1') }}" class="btn btn-sm btn-danger">Delete</a>
                                        </span>
                                    </li>
                                    <!-- Add more question items dynamically -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
