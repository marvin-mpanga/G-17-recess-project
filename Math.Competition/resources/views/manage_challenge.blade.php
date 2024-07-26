@extends('layouts.app', ['activePage' => 'schools', 'title' => 'Manage Schools', 'navName' => 'Manage Schools', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row"></div>
<div>
<h1 style="text-align: center; font-weight: bold; font-family: Arial Black;">Manage Challenge</h1>

</div>

<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mt-10">
                  @if (session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                  @endif
                    <div class="card">
                        <div class="card-header">
                        <h4 class="card-title" style="color: #333; font-weight: bold; font-family: Arial Black;">{{ __('Manage Questions') }}</h4>
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
                        <h4 class="card-title" style="color: #333; font-weight: bold; font-family: Arial Black;">{{ __('Manage Answers') }}</h4>
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

<div class="col-md-11">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Set Challenge Parameters') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('store_challenge') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="StartDate" style="color: #333; font-weight: bold; font-family: Arial Black;">{{ __('Start Date') }}</label>
                                    <input type="date" class="form-control" id="startDate" name="repId" required>
                                </div>
                                <div class="form-group">
                                    <label for="endDate" style="color: #333; font-weight: bold; font-family: Arial Black;">{{ __('End Date') }}</label>
                                    <input type="date" class="form-control" id="startDate" name="startDate" required>
                                </div>
                                <div class="form-group">
                                    <label for="Duration" style="color: #333; font-weight: bold; font-family: Arial Black;">{{ __('Duration(mins)') }}</label>
                                    <input type="time" class="form-control" id="duration" name="duration" required>
                                </div>
                                <div class="form-group">
                                    <label for="noOfQuestions" style="color: #333; font-weight: bold; font-family: Arial Black;">{{ __('Number Of Questions') }}</label>
                                    <input type="number" class="form-control" id="noOfQuestions" name="noOfQuestions" required>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ __('Add Challenge') }}</button>
                            </form>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
@endsection