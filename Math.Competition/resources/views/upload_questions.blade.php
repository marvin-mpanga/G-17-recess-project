@extends('layouts.app', ['activePage' => 'schools', 'title' => 'Manage Schools', 'navName' => 'Manage Schools', 'activeButton' => 'laravel'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        <h4 class="card-title">{{ __('Manage Questions') }}</h4>
                        <p class="card-category">{{ __('Add, edit, or remove schools') }}</p>
                        </div>
                         <div class="card-body" >   

                         <form action="{{ route('upload_questions') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                        <div class="form-group">
                    <label for="questions">Upload Questions File:</label>
                    <input type="file" name="questions" id="questions" required>
</div>
        <!-- <div>
            <label for="answers">Upload Answers File:</label>
            <input type="file" name="answers" id="answers" required>
        </div> -->
        <button type="submit">Upload</button>
    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
    
