<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: front/login.html");
    exit();
}

// Assuming you have the user's name stored in the session or database
$userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Username';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .sidebar {
            height: 100vh;
            transition: all 0.3s;
        }
        .collapsed {
            width: 60px;
        }
        .collapsed .nav-link span {
            display: none;
        }
        .collapsed .nav-link i {
            margin-right: 0;
        }
        .profile-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="bg-dark text-white sidebar col-md-2 col-sm-3" id="sidebar">
                <div class="p-3 text-center">
                    <div class="profile-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <p class="mb-0"><?php echo htmlspecialchars($userName); ?></p>
                </div>
                <ul class="flex-column nav">
                    <li class="nav-item">
                        <a class="text-white nav-link" href="index.php"><i class="me-2 fas fa-home"></i><span>Home</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="text-white nav-link" href="#"><i class="me-2 fas fa-chart-bar"></i><span>Analytics</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="text-white nav-link" href="#"><i class="me-2 fas fa-cog"></i><span>Settings</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="text-white nav-link" href="php/logout.php"><i class="me-2 fas fa-sign-out-alt"></i><span>Logout</span></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 col-sm-9" id="main">
                <button class="btn btn-dark d-md-none" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="p-4">
                    <h2>Welcome to your Dashboard</h2>
                    <p>This is a simple dashboard layout with a collapsible sidebar.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
        }
    </script>
</body>
</html>
