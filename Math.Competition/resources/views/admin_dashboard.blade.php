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
        <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-20 mt-10">
                  @if (session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                  @endif
                    <div class="card">
                        <div class="card-header">
                        <h4 class="card-title">{{ __('Manage Questions') }}</h4>
                        <p class="card-category">{{ __('upload questions from your desktop ') }}</p>
                        </div>
                         <div class="card-body" >   

                         <form action="{{ route('upload_questions') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                        <div class="form-group">
                    <label for="questions">Upload Questions File:</label>
                    <input type="file" name="import_questions" id="questions" required>
            </div>
        <button class="btn btn-primary" type="submit">Upload</button>
    </form>

    <div class="card-header">
                        <h4 class="card-title">{{ __('Manage Answers') }}</h4>
                        <p class="card-category">{{ __('upload answers from your desktop') }}</p>
                        </div>
                         <div class="card-body" >   

                         <form action="{{ route('upload_answers') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                        <div class="form-group">
                    <label for="questions">Upload Answers File:</label>
                    <input type="file" name="import_answers" id="questions" required>
            </div>
        <button class="btn btn-primary" type="submit">Upload</button>
    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    

    <div class="container">
        <div class="col-ml12 mt8">
            <div class="card">
                <div class="card-header">
            <h1 class="col-ml 5 mt 5">Set Challenge Parameters</h1> </div>
    <div class="card-content">

    <form action="{{ route('manage_challenge') }}" method="POST" class="challenge-card" style="color:green">
        @csrf
        <div class="challenge">
        <div>
            <div class="card-header">
            <h4 class="card-title">Start Date</h4>
            </div>
            <div class="col-lg-10 col-md-15">
            <input type="date" name="startDate" id="startDate" required>
            </div>
        </div>
        <div>
        <div class="card-header">
            <h4 class="card-title">End Date</h4>
            </div>
            <label for="endDate">End Date:</label>
            <input type="date" name="endDate" id="endDate" required>
        </div>
        <div>
        <div class="card-header">
            <h4 class="card-title">Duration</h4>
            </div>
            <label for="duration">Duration (minutes):</label>
            <input type="number" name="duration" id="duration" required>
        </div>
        <div>
        <div class="card-header">
            <h4 class="card-title">Number Of Questions</h4>
            </div>
            <label for="no_of_questions">Number of Questions:</label>
            <input type="number" name="no_of_questions" id="no_of_questions" required>
        </div>
        <div>
        <button type="submit" >Create Challenge</button>
        </div>
        </div>
    </form>
    </div>
    </div>
    </div>
</div>


    <table>
    <thead>
        <tr>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Duration</th>
            <th>Number of Questions</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    
        
    </tbody>
</table>
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
                            <a href="{{ route('upload_schools') }}" class="list-group-item list-group-item-action bg-light" style="font-size: 1.2rem;">
                                <span class="las la-school"></span> Manage Schools
                            </a>
                        </li>
                        <br>
                        <li>
                            <a href="{{ route('manage_challenge') }}" id="managechallenge-link" style="font-size: 1.2rem;">
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

    </script>
</body>
</html>



<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sidebar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .sidebar {
            width: 300px;
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            text-align: center;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s ease;
        }
        .card:hover {
            background-color: #0056b3;
        }
        .card p {
            margin: 0;
        }
        .card i {
            margin-right: 10px;
        }
        .active-card {
            background-color: #003d82;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <a class="card" href="{{ route('manage_challenge') }}" id="managechallenge-link">
                <i class="nc-icon nc-trophy"></i>
                <p>Manage Challenge</p>
            </a>
            
            <a class="card" href="{{ route('upload_schools') }}" id="schools-link">
                <i class="nc-icon nc-settings-gear-65"></i>
                <p>Manage Schools</p>
            </a>
        </div>
    </div>

    <script>
        const links = document.querySelectorAll('.card');

        links.forEach(link => {
            link.addEventListener('click', () => {
                links.forEach(l => l.classList.remove('active-card'));
                link.classList.add('active-card');
            });
        });

        // Add event listener to sidebar links to scroll to top
        links.forEach(link => {
            link.addEventListener('click', () => {
                window.scrollTo(0, 0);
            });
        });

// Add event listener to sidebar links to close sidebar
links.forEach(link => {
            link.addEventListener('click', () => {
                document.querySelector('.sidebar').classList.toggle('closed');
            });
        });
    </script>
</body>
</html> -->