
<!DOCTYPE html>
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
            <a class="card" href="{{ route('admin_overview') }}" id="overview-link">
                <i class="nc-icon nc-trophy"></i>
                <p>Admin Overview</p>
            </a>
            <a class="card" href="{{ route('admin_profile') }}" id="profile-link">
                <i class="nc-icon nc-chart-bar-32"></i>
                <p>Admin Profile</p>
            </a>
            <a class="card" href="{{ route('upload_questions') }}" id="questions-link">
                <i class="nc-icon nc-paper"></i>
                <p>Manage Questions</p>
            </a>
            <a class="card" href="{{ route('upload_answers') }}" id="answers-link">
                <i class="nc-icon nc-single-02"></i>
                <p>Manage Answers</p>
            </a>
            <a class="card" href="{{ route('upload_schools') }}" id="schools-link">
                <i class="nc-icon nc-settings-gear-65"></i>
                <p>Manage Schools</p>
            </a>
            <a class="card" href="{{ route('upload_docs') }}" id="docs-link">
                <i class="nc-icon nc-support-17"></i>
                <p>Upload Files</p>
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
</html>
