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
}


.card h3 {
    margin-top: 0;
}

.card p {
    margin-bottom: 20px;
}

.card {
margin: 10px;
position: 280px;
padding: 20px;
border: 1px solid #ddd;
border-radius: 10px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
width: 250px
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
    <div class="main" class="container">
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
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            
            <div class="container-fluid">
                <h1>Welcome to Pupil Dashboard!</h1>
                <p>We hope you have a great day!</p>
                <h2></h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Recent Event</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>no recent events!</td>
                        </tr>
                    </tbody>
                </table>
                
                <h2>Did You Know?</h2>
<div class="card-container">
    <div class="card">
        <h3>Butterflies taste with their feet.</h3>
        <p>Butterflies have tiny sensors on their feet <br> that help them detect the sweetness or bitterness of a substance.</p>
    </div>
    <div class="card">
        <h3>The shortest war in history was between <br>Britain and Zanzibar on August 27, 1896.</h3>
        <p>Zanzibar surrendered after just 38 minutes.</p>
    </div>
</div>

            </div>
        </div>
    </div>
    
   
</body>
</html>

