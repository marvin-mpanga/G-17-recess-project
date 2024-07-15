@extends('layouts.app', ['activePage' => 'notifications', 'title' => 'Maths Competition Notifications', 'navName' => 'Notifications', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Notifications</h4>
                <p class="card-category">Stay updated with the latest notifications for your role.</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>
                            <small>Notifications Style</small>
                        </h5>
                        <div class="alert alert-info">
                            <span>This is a plain notification</span>
                        </div>
                        <div class="alert alert-info">
                            <button type="button" aria-hidden="true" class="close" data-dismiss="alert">
                                <i class="nc-icon nc-simple-remove"></i>
                            </button>
                            <span>This is a notification with a close button.</span>
                        </div>
                       
                        <div class="alert alert-info alert-with-icon" data-notify="container">
                            <button type="button" aria-hidden="true" class="close" data-dismiss="alert">
                                <i class="nc-icon nc-simple-remove"></i>
                            </button>
                            <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                            <span data-notify="message">This is a notification with a close button and icon and has many lines. You can see that the icon and the close button are always vertically aligned. This is a beautiful notification. So you don't have to worry about the style.</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>
                            <small>Notification States</small>
                        </h5>
                        <div class="alert alert-primary">
                            <button type="button" aria-hidden="true" class="close" data-dismiss="alert">
                                <i class="nc-icon nc-simple-remove"></i>
                            </button>
                            <span>
                                <b> Primary - </b> This is a regular notification made with ".alert-primary"</span>
                        </div>
                        <div class="alert alert-info">
                            <button type="button" aria-hidden="true" class="close" data-dismiss="alert">
                                <i class="nc-icon nc-simple-remove"></i>
                            </button>
                            <span>
                                <b> Info - </b> This is a regular notification made with ".alert-info"</span>
                        </div>
                        <div class="alert alert-success">
                            <button type="button" aria-hidden="true" class="close" data-dismiss="alert">
                                <i class="nc-icon nc-simple-remove"></i>
                            </button>
                            <span>
                                <b> Success - </b> This is a regular notification made with ".alert-success"</span>
                        </div>
                        <div class="alert alert-warning">
                            <button type="button" aria-hidden="true" class="close" data-dismiss="alert">
                                <i class="nc-icon nc-simple-remove"></i>
                            </button>
                            <span>
                                <b> Warning - </b> This is a regular notification made with ".alert-warning"</span>
                        </div>
                        <div class="alert alert-danger">
                            <button type="button" aria-hidden="true" class="close" data-dismiss="alert">
                                <i class="nc-icon nc-simple-remove"></i>
                            </button>
                            <span>
                                <b> Danger - </b> This is a regular notification made with ".alert-danger"</span>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div class="places-buttons">
                    <div class="row">
                        <div class="col-md-6 offset-md-3 text-center">
                            <h4 class="card-title">Notifications Places
                                <p class="card-category">
                                    <small>Click to view notifications</small>
                                </p>
                            </h4>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-2 col-lg-2">
                            <button class="btn btn-default btn-block" onclick="showNotification('top', 'left', 'warning', 'New pupils are waiting for your approval!')">Top Left</button>
                        </div>
                        <div class="col-md-2 col-lg-2">
                            <button class="btn btn-default btn-block" onclick="showNotification('top', 'center', 'info', 'New event created: Math Olympiad 2024!')">Top Center</button>
                        </div>
                        <div class="col-md-2 col-lg-2">
                            <button class="btn btn-default btn-block" onclick="showNotification('top', 'right', 'success', 'You have new challenges to solve!')">Top Right</button>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-2 col-lg-2">
                            <button class="btn btn-default btn-block" onclick="showNotification('bottom', 'left', 'primary', 'Profile update successful!')">Bottom Left</button>
                        </div>
                        <div class="col-md-2 col-lg-2">
                            <button class="btn btn-default btn-block" onclick="showNotification('bottom', 'center', 'primary', 'You have a new message from the admin.')">Bottom Center</button>
                        </div>
                        <div class="col-md-2 col-lg-2">
                            <button class="btn btn-default btn-block" onclick="showNotification('bottom', 'right', 'primary', 'New participant joined your school!')">Bottom Right</button>
                        </div>
                    </div>
                </div>
                

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Example notifications based on user roles
        let userRole = @json(auth()->user()->role); // Assume role is available on user model
        
        switch (userRole) {
            case 'admin':
                showNotification('top', 'center', 'info', 'New event created: Math Olympiad 2024! Update your schedules accordingly.');
                showNotification('top', 'center', 'info', 'You have 5 new pupils registered.');
                break;
            case 'pupil':
                showNotification('top', 'right', 'success', 'Welcome to the competition! You have 3 new challenges awaiting.');
                showNotification('top', 'right', 'success', 'Your profile update was successful.');
                break;
            case 'school_rep':
                showNotification('top', 'left', 'warning', 'New pupils are waiting for your approval!');
                showNotification('top', 'left', 'warning', 'Event Math Olympiad 2024 needs your participation confirmation.');
                break;
            default:
                showNotification('bottom', 'center', 'primary', 'Welcome! Here are your latest notifications.');
        }
    });

    function showNotification(from, align, type, message) {
        $.notify({
            icon: "nc-icon nc-bell-55",
            message: message
        }, {
            type: type,
            timer: 8000,
            placement: {
                from: from,
                align: align
            }
        });
    }
</script>
@endsection
