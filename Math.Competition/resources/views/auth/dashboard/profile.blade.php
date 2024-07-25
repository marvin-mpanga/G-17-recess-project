<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <link rel= "stylesheet" href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" >
    <title>Pupil Dashboard</title>
    <style>
        :root {
            --color-main: #1a202e;
        }
        * {
            font-family: 'poppins', 'sans-serif';
            box-sizing: border-box;
            text-decoration: none;
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        #sidebar-toggle{
            display: none;
        }
        #sidebar-toggle:checked ~ .sidebar{
            left: -100%;
        }
        #sidebar-toggle:checked ~ . main-content header{
            width: 100%;
            left: 0;
            right:0;
        }
        #sidebar-toggle:checked ~ .main-content{
            margin-left: 0;
        }

        .sidebar {
            width: 280px;
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            padding: 1rem;
            background: #2f4050;
            color: white;
            z-index: 20;
        
        }
        .sidebar-brand {
            height:70px;
        }
        .brand-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .brand-icons span {
            font-size: 1.5rem;
            margin-left: 0.5rem;
        }
        .sidebar-user {
            margin: 1rem 0rem 1rem 0rem;
            text-align: center;   
        }
        .sidebar-user img{
            width: 110px;
            height: 110px;
            border-radius: 50%;
            border-left: 2px solid transparent;
            border-right: 2px solid #efefef;
            border-bottom: 2px solid #efefef;
            border-top: 2px solid #efefef;
        }
        .sidebar-user h3 {
            font-size: 1rem;
        }
        .sidebar-user span{
            font-size: 0.75rem;
        }
        .sidebar-menu{
            margin-top: 2rem;
        }
        .menu-head{
            text-transform: uppercase;
            color: #2f4050;
            font-size: 0.75rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        .sidebar ul{
            margin-bottom: 1.5rem;
        }
        .sidebar menu li{
            margin-bottom: 0.8rem;
        }
        .sidebar-menu li a {
            font-size: 0.9rem;
            color: #efefef;
        }
        .sidebar-menu li a span {
            font-size: 1.5rem;
            display: inline-block;
            margin-right: 0.8rem
        }
        .main-content {
            margin-left: 280px;
            padding: 2rem;
        }
        header{
            height: 70px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #efefef;
            padding: 1rem 1.5rem;
            position: fixed;
            left: 280px;
            width: calc(100% - 280px);
            top: 0;
            z-index: 20;
            background: teal;
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.1);
            transition: left 300ms;
        }
        .menu-toggle label {
            height: 60px;
            width: 60px;
            display: grid;
            place-items: center;
            font-size: 1.5rem;
            border-radius: 50px;
        }
       
        .page-header{
            display: flex;
            justify-content: space-between;
        }  
        .header-actions button{
            outline: none;
            color: #fff;
            background: #5850ec;
            border: none;
            padding: .6rem 1rem;
            margin-left: 1rem;
            border-radius: 3px;
            font-weight: 600;
        }
        .header-actions button span{
            font-size: 1.2rem;
            margin-right: .6rem;
        }
        
      
        span.indicator {
            background: #c9f7f5;
            height: 30px;
            width: 30px;
            border-radius: 50%;
        }
        span.indicator.even {
            background: #fff4de;
            height: 15px;
            width: 15px;
            border-radius: 50%;

        }
        @media only screen and (max-width: 1124px){
            .sidebar {
                left: -100%;
                z-index: 30;
            }
            .main-content {
                margin-left: 0;
            }
            .header {
                left: 0;
                width: 100%;
            }
            #sidebar-toogle: checked ~ .sidebar {
                left: 0;
            }
        }
        .search-box {
  position: relative;
  width: 200px; /* adjust the width as needed */
}

.search-box input {
  width: 100%;
  padding: 0.6rem 1rem;
  border: 1px solid #ccc;
  border-radius: 3px;
}

.search-box span {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  font-size: 1.2rem;
  color: #666;
}
/* Responsive design */
@media (max-width: 768px) {
  .search-box {
    width: 150px; /* adjust the width as needed */
  }
}

@media (max-width: 480px) {
  .search-box {
    width: 100px; /* adjust the width as needed */
  }
}

.topbar a{
            float: right;
            color: whitesmoke;
            text-align: center;
            padding: 20px 26px;
            text-decoration: none;
            font-size: 26px;
        } 
        .topbar span{
            float: right;
            color: whitesmoke;
            text-align: center;
            padding: 20px 26px;
            text-decoration: none;
            font-size: 26px;
        }
        body {
    background-color: #f9f9fa
}

.padding {
    padding: 3rem !important
}

.user-card-full {
    overflow: hidden;
}

.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 20px 0 rgba(69,90,100,0.08);
    box-shadow: 0 1px 20px 0 rgba(69,90,100,0.08);
    border: none;
    margin-bottom: 30px;
}

.m-r-0 {
    margin-right: 0px;
}

.m-l-0 {
    margin-left: 0px;
}

.user-card-full .user-profile {
    border-radius: 5px 0 0 5px;
}

.bg-c-lite-green {
    background: teal;
}

.user-profile {
    padding: 20px 0;
}

.card-block {
    padding: 1.25rem;
}

.m-b-25 {
    margin-bottom: 25px;
}

.img-radius {
    border-radius: 5px;
}


 
h6 {
    font-size: 14px;
}

.card .card-block p {
    line-height: 25px;
}

@media only screen and (min-width: 1400px){
p {
    font-size: 14px;
}
}

.card-block {
    padding: 1.25rem;
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0;
}

.m-b-20 {
    margin-bottom: 20px;
}

.p-b-5 {
    padding-bottom: 5px !important;
}

.card .card-block p {
    line-height: 25px;
}

.m-b-10 {
    margin-bottom: 10px;
}

.text-muted {
    color: #919aa3 !important;
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0;
}

.f-w-600 {
    font-weight: 600;
}

.m-b-20 {
    margin-bottom: 20px;
}

.m-t-40 {
    margin-top: 20px;
}

.p-b-5 {
    padding-bottom: 5px !important;
}

.m-b-10 {
    margin-bottom: 10px;
}

.m-t-40 {
    margin-top: 20px;
}

.user-card-full .social-link li {
    display: inline-block;
}

.user-card-full .social-link li a {
    font-size: 20px;
    margin: 0 10px 0 0;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}
.profile-pic {
            width: 200px;
            height: 200px;
            background-color: #007bff;
            color: #ffffff;
            font-size: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        #profile-picture {
    float: left;
  }

        #username-preview {
    float: right;
    margin-top: 20px; /* Adjust the margin to your liking */
  }








        


    </style>
</head>
<body>
    <div class="main-content">
        <header>
            <div class="menu-toggle">
                <label for="">
                    <span class="las la-bars"><span>
                    
                </label>
            </div> 
            <div>
            
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
                <span class="las la-sms"></span>
                <span class="las la-bell"></span>
                
            </div> 

            
        </header>
        <main>
        <div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
<div class="col-xl-3 col-md-12">
                                                <div class="card user-card-full">
                                                    <div class="row m-l-0 m-r-0">
                                                        <div class="col-sm-4 bg-c-lite-green user-profile">
                                                            <div class="card-block text-center text-white">
                                                                <div id="profile-picture" class="profile-pic">
                                                            </div>
                                                            
                                                                <h6 class="f-w-600">John Doe</h6>
                                                                <p>U/23000</p>
                                                                <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                                            </div>
                                                        </div>  
 <div class="col-sm-8"><br><br><br><br>
   <div class="card-block" style="text-align: center;">
    <h6 class="m-b-20 p-b-5 b-b-default f-w-600" style="text-align: center;">My Profile</h6>
    <form id="update-pupil-form">
      <div class="row">
        <div class="col-sm-6">
          <p class="m-b-10 f-w-600">Pupil ID</p>
          <input type="text" class="form-control" value="12345" disabled>
        </div>
        <div class="col-sm-6">
          <p class="m-b-10 f-w-600">Name</p>
          <input type="text" class="form-control" name="name" value="John Doe">
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <p class="m-b-10 f-w-600">Username</p>
          <input type="text" class="form-control" name="username" value="johndoe">
        </div>
        <div class="col-sm-6">
          <p class="m-b-10 f-w-600">Date of Birth</p>
          <input type="date" class="form-control" name="date_of_birth" value="2000-01-01">
        </div>
      </div>
      <button class="btn btn-primary" id="update-pupil-btn">Update</button>
    </form>
  </div>
</div>


                                                                <ul class="social-link list-unstyled m-t-40 m-b-10">
                                                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                             </div>
                                                </div>
                                            </div>
    </main>
           

    </div>

    <div class="sidebar">
        <div class="sidebar-brand">
            
        </div>
        <div class="sidebar-main">
                 <p style="font-size: 2rem;">Dashboard</p>
               <br>
               <div class="brand-icons">

                  <div class=header-icons>
                  <div class="search-box">
                    <input type="text" placeholder="Search...">
                    <span class="las la-search"></span>
                
            </div>
            </div>
            <div class="sidebar-menu">
                <div class="menu-block">
                    
                    <ul>
                    <li>
                            <a href="{{ route('dashboard.overview') }}" class="list-group-item list-group-item-action bg-light" style="font-size: 1.2rem;">
                                <span class="las la-school"></span> Overview
                            </a>
                        </li>
                        <br>
                        <li>
                            <a href="{{ route('dashboard.manage_schools') }}" class="list-group-item list-group-item-action bg-light" style="font-size: 1.2rem;">
                                <span class="las la-school"></span> Manage Schools
                            </a>
                        </li>
                        <br>
                        <li>
                            <a href="" style="font-size: 1.2rem;">
                                <span class="las la-tasks"></span> Manage challenge
                            </a>
                        </li>
                        <br>
                        <li>
                            <a href="{{ route('dashboard.analytics') }}" class="list-group-item list-group-item-action bg-light" style="font-size: 1.2rem;">
                                <span class="las la-chart-bar"></span>Analytics
                            </a>
                        </li>
                        <br>
                        <li>
                            <a href="{{ route('dashboard.profile') }}" class="list-group-item list-group-item-action bg-light" style="font-size: 1.2rem;">
                                <span class="las la-question"></span> Profile
                            </a>
                        </li>
                        <br>
                        <li>
                            <a href="" style="font-size: 1.2rem;">
                                <span class="las la-question"></span> Help
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('load', function() {
            const surname = localStorage.getItem('surname');
            if (surname) {
                const initials = surname[0].toUpperCase();
                updateProfilePicture(initials);
            }
        });

        function updateProfilePicture(initials) {
            const profilePicture = document.getElementById('profile-picture');
            profilePicture.textContent = initials;
        }
    </script>
</body>
</html>
