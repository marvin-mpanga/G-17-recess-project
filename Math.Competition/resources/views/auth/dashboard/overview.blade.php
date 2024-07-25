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
            width: 400px;
        }
        .analytics-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        .card {
    width: 600px;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    padding: 20px;
    margin: 20px;
}

.card-header {
    background-color: #f0f0f0;
    padding: 10px;
    border-bottom: 1px solid #ddd;
    font-weight: bold;
}

.card-body {
    padding: 10px;
}


.card-body ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.card-body li {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.card-body li:last-child {
    border-bottom: none;
}

.card-body li span {
    font-size: 12px;
    color: #666;
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
        .leaderboard {
  width: 300px;
  margin: 20px;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.leaderboard h2 {
  text-align: center;
  margin-bottom: 20px;
}

.leaderboard ol {
  list-style: none;
  padding: 0;
  margin: 0;
}
.leaderboard li {
  padding: 10px;
  border-bottom: 1px solid #ddd;
}

.leaderboard li:last-child {
  border-bottom: none;
}
.hero{
    width: 100%;
    min-height: 100vh;
    background: #eceaff;
    color: #525252;
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
                    <h1>Dashboard </h1>
                    <small>Welcome!</small>
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
                <span>Number of participants</span>
                <small></small>
            </div>
            <h2 id="pupil-count">{{ App\Models\Pupil::count() }}</h2> 
            <small></small>
        </div>
        <div class="card-chart success">
            <span class="las la-users"></span>
        </div>
    </div>
</div>


                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-info">
                            <div class="card-head">
                                <span>Number of schools</span>
                                <small></small>
                            </div>
                            <h2 id="school-count">{{ App\Models\Schools::count() }}</h2>
                            <small></small>
                        </div>
                        <div class="card-chart danger">
                            <span class="las la-school" ></span>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-info">
                            <div class="card-head">
                                <span>number of challenges</span>
                                <small></small>
                            </div>
                            <h2 id="challenge-count">{{ App\Models\Challenge::count() }}</h2>

                            <small></small>
                        </div>
                        <div class="card-chart yellow">
                            <span class="las la-angle-double-right"></span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="jobs-grid">
            <div class="leaderboard">
  <h2><i class="las la-trophy"></i>Top Pupils</h2>
  <ol>
    <li>John Doe (92)</li>
    <li>Jane Smith (89)</li>
    <li>Bob Johnson (88)</li>
  </ol>
</div>



               <div class="analytics-card">
               <div class="card-header">Recent Activities</div>
    <div class="card-body">
        <ul>
            <li>
                <div>John Doe logged in</div>
                <span>2 hours ago</span>
            </li>
            <li>
                <div>Jane Smith created a new question</div>
                <span>1 hour ago</span>
            </li>
            <li>
                <div>Bob Johnson answered a question</div>
                <span>30 minutes ago</span>
            </li>
            <li>
                <div>Alice Brown commented on a question</div>
                <span>15 minutes ago</span>
            </li>
            <li>
                <div>Mike Davis logged out</div>
                <span>5 minutes ago</span>
            </li>
        </ul>
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
                            <a href="{{ route('manage_schools') }}" class="list-group-item list-group-item-action bg-light" style="font-size: 1.2rem;">
                                <span class="las la-school"></span> Manage Schools
                            </a>
                        </li>
                        <br>
                        <li>
                            <a href="{{ route('manage_challenge') }}" style="font-size: 1.2rem;">
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', '%perfomance', ],
          ['2019',  80,      ],
          ['2021',  76,      ],
          ['2022',  93,       ],
          ['2023',  79,      ]
        ]);

        var options = {
          title: 'School perfomance over years',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }

      const searchInput = document.getElementById('search-input');

searchInput.addEventListener('keyup', function(e) {
  const searchTerm = e.target.value.toLowerCase();
  const dashboardItems = document.querySelectorAll('.dashboard-item'); // adjust the selector as needed

  dashboardItems.forEach(function(item) {
    const itemName = item.textContent.toLowerCase();

    if (itemName.includes(searchTerm)) {
      item.style.display = 'block';
    } else {
      item.style.display = 'none';
    }
  });
});
setInterval(function() {
        $.ajax({
            type: 'GET',
            url: '/pupil-count',
            success: function(data) {
                $('#pupil-count').text(data.count);
            }
        });
    }, 10000); // update every 10 seconds

//     setInterval(function() {
//     $.ajax({
//         url: '/get-school-count', // URL to fetch the updated count
//         type: 'GET',
//         success: function(data) {
//             $('#school-count').text(data.count);
//         }
//     });
// }, 10000);


    </script>
</body>
</html>
