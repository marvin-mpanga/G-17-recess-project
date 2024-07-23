<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <title>Pupil dashboard </title>
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
            background-color: #2f4050; /* changed background color */
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
        /* added styling for sidebar items */
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
            <a href="{{ route('pupil.dashboard') }}" class="list-group-item list-group-item-action bg-light">dashboard</a><br><br><br>
            <a href="{{ route('pupil.challenges') }}" class="list-group-item list-group-item-action bg-light">Challenges</a><br><br><br>
            <a href="{{ route('pupil.progress') }}" class="list-group-item list-group-item-action bg-light">Progress</a><br><br><br>
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
            </div>
            
        </div>
        <!-- resources/views/auth/pupil_dashboard.blade.php -->
       

        
        
    </div>

        <!-- /#page-content-wrapper -->
    <!-- /#wrapper -->
    
</body>
</html>

