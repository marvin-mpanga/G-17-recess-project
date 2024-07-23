<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Admin Profile</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h6>Profile Picture</h6>
                                    <img src="{{ asset('images/admin-profile-picture.jpg') }}" alt="Admin Profile Picture" class="img-fluid">
                                    <button class="btn btn-primary">Change Picture</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <h6>Admin Information</h6>
                                    <form action="{{ route('admin.update.profile') }}" method="POST">
                                        @csrf
                                        @if ($admin){{ $admin->name }}
                                            @endif

                                        <div class="form-group">
                                            <label for="name">Admin Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Admin Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ $admin->email }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" value="{{ $admin->password }}">
                                        </div>
                                        <button class="btn btn-primary">Update Profile</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
