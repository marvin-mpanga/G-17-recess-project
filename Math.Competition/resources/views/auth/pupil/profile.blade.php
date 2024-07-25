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
        #page-content-wrapper {
           min-width: 100vw;
           padding-left: 20px; /* Add this line */
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
        table {
            border-collapse: collapse;
            border: 1px solid #ddd;
            width: 950px;
        }

        th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
        }
        th {
            color: white;
            background-color: #2f4050;
        }
        td {
            height:120px;
        }
        .card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    width: 800px;
}

.card {
margin: 10px;
position: 280px;
padding: 20px;
border: 1px solid #ddd;
border-radius: 10px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
width: 1000px
flex: 1; /* Add this line */
}

.card h3 {
margin-top: 0;
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
    <div class="main-container">
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
                <a href="{{ route('pupil.profile') }}" class="list-group-item list-group-item-action bg-light">Profile</a><br><br><br>
                <a href="{{ route('pupil.challenges') }}" class="list-group-item list-group-item-action bg-light">Challenges</a><br><br><br>
                <a href="{{ route('pupil.progress') }}" class="list-group-item list-group-item-action bg-light">Progress</a><br><br><br>
                <a href="{{ route('pupil.help') }}" class="list-group-item list-group-item-action bg-light">Help</a><br><br><br>
                <a href="{{ route('pupil.settings') }}" class="list-group-item list-group-item-action bg-light">Settings</a><br>
            </div>
        </div>
       <div class="col-md-8 mt-1">
             <div class="card mb-3 content">
                <h1 class="m-3 pt-3"> About</h1>
                    <div class="row">
                        <div class="col-md-3">
                            <h5> Full Name </h5>
                        </div> 
                        <div class="col-md-9 text-secondary">
                            Burt Macklin
                        </div>  
                    </div> 
                    <hr> 
                    <div class="row">
                        <div class="col-md-3">
                            <h5> Email </h5>
                        </div>
                        <div class="col-md-9 text-secondary">
                            burt.macklin@fbi.gov
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <h5> Phone </h5>
                        </div>
                        <div class="col-md-9 text-secondary">
                            555-555-5555
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <h5> Address </h5>
                            </div>
                            <div class="col-md-9 text-secondary">
                                1234 Main St    
                                Anytown, CA 12345
                            </div>
                        </div>
                    </div>
                </div> 
                   




       
    
</body>
</html>












