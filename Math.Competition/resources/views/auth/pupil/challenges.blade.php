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
padding:200px;
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
    width: 500px;
}

th, td {
	border: 1px solid #ddd;
}
*{
    margin:0;
    padding:0;
    box-sizing: border-box;
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



<a href="{{ route('pupil.settings') }}" class="list-group-item list-group-item-action bg-light">Settings</a><br><br>

</div>
</div>
<!-- /#sidebar-wrapper -->
<!-- Page Content -->

<!-- Challenge View -->
<div class="challenge-view">
    <h2>Challenge</h2>
    <table border="1">
	<thead>
		<tr>
			<th>Challenge Instruction</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>From the list of available challenges, a participant is expected to<br>
                choose a challenge and complete it within the stipulated time.<br>
                One can participate in more than one challnge if he/she wants</td>
		</tr>
	</tbody>
</table>

    <p><strong>Submission Guidelines:</strong></p>
    <ul>
        <li>Submit your answer in the form below</li>
        <li>Ensure your answer is in the correct format (e.g., PDF, ZIP, etc.)</li>
        <li>Upload your answer before the deadline:</li>
    </ul>
    
        
        
    <p><strong>Links and Resources:</strong></p>
    
    <ul>
        <li><a href="(https://artofproblemsolving.com/community/c89)" target="_blank">Art of Solving Problems</a></li>
        <li><a href="(https://artofproblemsolving.com/community/c89)" target="_blank">math Links</a></li>
        
    </ul>
    <form action="{{ route('pupil.challenges') }}" method="post">
        
        <input type="file" name="answer" required>
        <button type="submit">Submit Answer</button>
    </form>
</div>

<!-- /#wrapper -->
 
</body>
</html>

