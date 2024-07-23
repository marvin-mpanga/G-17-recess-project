@extends('layouts.app', ['activePage' => 'schools', 'title' => 'Manage Schools', 'navName' => 'Manage Schools', 'activeButton' => 'laravel'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        <h4 class="card-title">{{ __('Manage Answers') }}</h4>
                        <h2 class="card-title" > upload Answers</h2>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('upload_questions') }}" method="POST" enctype="multipart/form-data">
                     @csrf
        
        <div>
            <label for="answers">Upload Answers File:</label>
            <input type="file" name="answers" id="answers" required>
        </div>
        <button type="submit">Upload</button>
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    @endsection
    
