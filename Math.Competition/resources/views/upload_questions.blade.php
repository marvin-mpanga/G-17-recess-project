
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mt-10">
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

                         <form action="{{ route('upload_questions') }}" method="POST" enctype="multipart/form-data">
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

    
