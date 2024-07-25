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
        .topbar{
            background-color: teal;
            overflow: hidden;
        }
        .topbar a{
            float: right;
            color: whitesmoke;
            text-align: center;
            padding: 20px 26px;
            text-decoration: none;
            font-size: 26px;
        } 
    </style>
</head>
<body>


            <div class="topbar">
                <a href="{{ route('pupil.login') }}" class="nav-link">
                    {{ __('Login') }}
                </a>
                <a href="{{ route('contact') }}" class="nav-link">
                         {{ __('Contact') }}
                </a>
                <a href="{{ route('aboutUs') }}" class ="nav-link" >
                        {{ __('AboutUs') }}
                </a>
                <a href="{{ route('welcome') }}" class ="nav-link" >
                        {{ __('Home') }}
                </a>

            </div>

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
                <div class="settings-view">
                    <h1>Settings</h1>
                    <p>This page is dedicated to providing settings options for pupils.</p>
                    <hr>
                    <h2>Account Settings</h2>
                    <p>Here you can update your account information:</p>
                    <ul>
                        <li>Username: <input type="text" value="pupil"></li>
                        <li>Email: <input type="email" value="pupil@example.com"></li>
                        <li>Password: <input type="password" value="password"></li>
                    </ul>
                    <hr>
                    <h2>Notification Settings</h2>
                    <p>Here you can manage your notification preferences:</p>
                    <ul>
                        <li>Receive email notifications: <input type="checkbox" checked></li>
                        <li>Receive in-app notifications: <input type="checkbox" checked></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
</body>
</html>


