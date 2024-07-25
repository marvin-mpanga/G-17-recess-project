<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="(link unavailable)"></script>
    <title>Pupil Dashboard</title>
    <style>
        body {
            overflow-x: hidden;
        }

        #wrapper {
            display: flex;
            align-items: stretch;
        }

        #sidebar-wrapper {
            min-height: 100vh;
            width: 250px;
            transition: margin 0.25s ease-out;
            background-color: #2f4050;
        }

        #sidebar-wrapper .list-group {
            width: 15rem;
        }

        #page-content-wrapper {
            min-width: 100vw;
        }

        #wrapper.toggled #sidebar-wrapper {
            margin-left: 0;
        }

        .list-group-item {
            text-decoration: none;
            color: white;
            font-size: 2rem;
            padding: 20px;
            border-bottom: 1px solid #ccc;
        }

        .list-group-item:hover {
            background-color: blue;
            text-decoration: underline;
        }

        .list-group-item:active {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading"></div>
            <div class="list-group list-group-flush">
                <a href="{{ route('pupil.dashboard') }}" class="list-group-item list-group-item-action bg-light">Dashboard</a><br><br><br>
                <a href="{{ route('pupil.analytics') }}" class="list-group-item list-group-item-action bg-light">Analytics</a><br><br><br>
                <a href="{{ route('pupil.profile') }}" class="list-group-item list-group-item-action bg-light">Profile</a><br><br><br>
                <a href="{{ route('pupil.help') }}" class="list-group-item list-group-item-action bg-light">Help</a><br><br><br>
                <a href="{{ route('pupil.settings') }}" class="list-group-item list-group-item-action bg-light">Settings</a><br>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                @yield('content')
                <div class="help-view">
                    <h1>Help</h1>
                    <p>This page is dedicated to providing helpful resources and information for pupils.</p>
                    <hr>
                    <h2>Frequently Asked Questions</h2>
                    <p>Here are some frequently asked questions and their answers:</p>
                    <ul>
                        <li>Q: How do I access my dashboard?</li>
                        <p>A: You can access your dashboard by clicking on the "Dashboard" link in the sidebar.</p>
                        <li>Q: How do I update my profile information?</li>
                        <p>A: You can update your profile information by clicking on the "Profile" link in the sidebar and then clicking on the "Edit Profile" button.</p>
                    </ul>
                    <hr>
                    <h2>Contact Support</h2>
                    <p>If you have any questions or need help, you can contact our support team at <a href="mailto:support@example.com">support@example.com</a>.</p>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
</body>
</html>
