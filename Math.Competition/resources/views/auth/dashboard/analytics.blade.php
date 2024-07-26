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
        .header-icons span{
            display: inline-block;
            margin-left: .7rem;
            font-size: 1.4rem;
        }
        .main-content {
            margin-left: 280px;
            transition: margin-left 300ms;
        }
        .menu-toggle label:hover {
            background: #efefef;
        }
        main{
            padding: 1.5rem;
            background: #f1f5f9;
            min-height: calc(100vh - 70px);
            margin-top: 70px;

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
        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 3rem;
            margin-top: 2rem;
        }
        .card-single {
            background: #fff;
            padding: 1rem;
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 2px;
        }
        .card-flex{
            display: grid;
            grid-template-columns: 70% auto;
            align-items: center;
        }
        .card-head span{
            display: block;
            text-transform: uppercase;
            color: #555;
            font-size: .9rem;
        }
        .card-head small {
            font-weight: 600;
            color: #555;
        }
        .card-head h2{
            font-size: 2.2rem;
            color: #333;
        }
        .card-chart span {
            font-size: 5rem;
        }
        .card-chart.success span{
            color: seagreen;
        }
        .card-chart.danger span{
            color: tomato;
        }
        .card-chart.yellow span{
            color: orangered;
        }
        .jobs-grid {
            margin-top: 4rem; 
            display: grid;
            grid-template-columns: auto 66%;
            grid-gap: 3rem;
        }
        .analytics-card {
            background: #fff;
            padding: 1.5rem;
            width: 700px;
        }
        .analytics-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        .analytics-head span{
            font-size: 1.5rem;
        }
        .analytics-chart {
            font-weight: 600;
            color: #555;
            margin-bottom:1rem;
            display: block;
        }
        .chart-circle{
            width: 150px;
            height: 150px;
            border-left: 4px solid transparent;
            border-right: 4px solid #5850ec;
            border-bottom: 4px solid #5850ec;
            border-top: 4px solid #5850ec;
            display: grid;
            place-items: center;
            margin: auto;
            border-radius: 50%;
            margin-bottom: 3rem;
        } 
        .analytics-card button {
            display: block;
            padding: .6rem 1rem;
            width: 100%;
            background: #5850ec;
            color: #fff;
            border: 1px solid #5550ec;
            border-radius: 3px;
        } 
        .jobs h2 small{
            color: #5850ec;
            font-weight: 600;
            display: inline-block;
            margin-left: 1rem;
            font-size: 0.9rem;
        }
        .jobs table {
            border-collapse: collapse;
            margin-top: 1rem;
            overflow-x: auto;
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
        .jobs table td div {
            background: #fff;
            margin-bottom: 1rem;
            height: 60px;
            display: flex;
            align-items: center;
            padding: .5rem;
            font-size: .85rem;
            color: #444;
            font-weight: 500;

        }
        table button {
            background: #8da2fb;
            color: midnightblue;
            border: 1px solid #8da2fb;
            padding: .5rem;
            border-radius: 3px;
        }
        table button.even {
            background: 
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
        #worst-schools-list {
    position: absolute;
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 10px;
    width: 200px;
    z-index: 1;
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
            <div class="page-header">
                <div>
                    <h1>Analytics</h1>
                    <small>Monitor key metrics</small>
                </div>
            
                <div class="header-actions">
                    
                    <button>
                        <span class="las la-tools"></span> 
                        Settings
                    </button>
                </div>
            </div>

            <div class="cards">
                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-info">
                            <div class="card-head">
                                <span>List of best perfomming schools</span>
                                <small></small>
                            </div>
                            <h2> </h2>

                            <small></small>
                        </div>
                        <div class="card-chart success">
                            <span class="las la-angle-double-right"></span>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-info">
                            <div class="card-head">
                                <span>List of worst perfoming schools</span>
</small>
                            </div>
                            <h2> </h2>

                            <small></small>
                        </div>
                        <div class="card-chart danger">
                            <span class="las la-angle-double-right" ></span>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-info">
                            <div class="card-head">
                                <span>list of highly passed challenges</span>
                                <small></small>
                            </div>
                            <h2> </h2>

                            <small></small>
                        </div>
                        <div class="card-chart yellow">
                            <span class="las la-angle-double-right"></span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="jobs-grid">
               <div class="analytics-card">
                    <div id="curve_chart" style="width: 300px; height: 300px">

                    </div>
                    <div class="analytics-note">
                       <small>Trend alert: Passing rate has been declining since 2022, with a 14% drop in 2023.</small>
                    </div>
                    <div class="analytics-btn">
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
                            <a href="{{ route('dashboard.overview') }}" class="list-group-item list-group-item-action bg-light" style="font-size: 1.5rem;">
                                <span class="las la-school"></span> Overview
                            </a>
                        </li>
                        <br>
                        <li>
                            <a href="{{ route('upload_schools') }}" class="list-group-item list-group-item-action bg-light" style="font-size: 1.5rem;">
                                <span class="las la-school"></span> Manage Schools
                            </a>
                        </li>
                        <br>
                        <li>
                            <a href="{{ route('manage_challenge') }}" style="font-size: 1.5rem;">
                                <span class="las la-tasks"></span> Manage challenge
                            </a>
                        </li>
                        <br>
                        <li>
                            <a href="{{ route('dashboard.analytics') }}" style="font-size: 1.5rem;">
                                <span class="las la-chart-bar"></span>Analytics
                            </a>
                        </li>
                        <br>
                        <li>
                            <a href="" style="font-size: 1.5rem;">
                                <span class="las la-question"></span> Help
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    </script>
</body>
</html>
