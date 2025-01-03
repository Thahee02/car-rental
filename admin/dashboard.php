<?php

session_start();

if(!isset($_SESSION['is_login']) && !isset( $_SESSION['user_role']) == 'admin'){
    header("Location: http://localhost/car/index.php");
    exit();
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | RentaCar</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include('../assets/components/menu.php'); ?>

    <section class="admin-dashboard-banner">
        <h1>Dashboard</h1>
        <div class="breadcrumb">Home / Admin / <span>Dashboard</span></div>
    </section>

    <div class="admin-dashboard-container">
        <!-- Left Sidebar -->
        <?php include('../assets/components/admin-sidebar.php'); ?>

        <!-- Main Content -->
        <div class="admin-dashboard-main-content">

            <?php 

            include('../backend/db.php');
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $email = $_SESSION['user_email'];

            // Escape the email to prevent SQL injection
            $email = mysqli_real_escape_string($conn, $email);

            // SQL query to fetch user details
            $sql = "SELECT name, role FROM users WHERE email = '$email'";

            // Execute the query
            $result = mysqli_query($conn, $sql);

            // Check if user exists
            if ($result && mysqli_num_rows($result) > 0) {
                // Fetch user details
                $user = mysqli_fetch_assoc($result);
                $name = $user['name'];
                $role = $user['role'];
            } else {
                echo "<p style='text-align: center;'>No user found with the given email.</p>" . $_SESSION['user_email'];
                exit;
            }

            // find total users count
            $query = "SELECT COUNT(*) AS total_users FROM users";
            $result = mysqli_query($conn, $query);

            if ($result) {
                // Fetch the result
                $row = mysqli_fetch_assoc($result);
                $totalUsers = $row['total_users'];

                // Prepend a 0 if total users count is less than 10
                if ($totalUsers < 10) {
                    $totalUsers = "0" . $totalUsers;
                }
            } 
            else {
                echo "Error: " . mysqli_error($conn);
            }

            // find total cars count
            $query2 = "SELECT COUNT(*) AS total_cars FROM cars";
            $result2 = mysqli_query($conn, $query2);

            if ($result2) {
                // Fetch the result
                $row = mysqli_fetch_assoc($result2);
                $totalCars = $row['total_cars'];

                // Prepend a 0 if total users count is less than 10
                if ($totalCars < 10) {
                    $totalCars = "0" . $totalCars;
                }
            } 
            else {
                echo "Error: " . mysqli_error($conn);
            }

            // Close the connection
            mysqli_close($conn);

            ?>



            <div class="admin-dashboard-profile-section">
                <img src="../assets/images/my-profile-avatar.jpg" alt="Profile Picture">
                <div>
                    <h2><?php echo $name; ?></h2>
                    <p><?php echo $role; ?></p>
                </div>
            </div>

            <div class="admin-dashboard-stats-section">
                <div class="admin-dashboard-total-users">
                    <h3>Total Users:</h3>
                    <h1><?php echo $totalUsers; ?></h1>
                </div>
                <div class="admin-dashboard-total-orders">
                    <h3>Total Orders:</h3>
                    <h1>00</h1>
                </div>
            </div>

            <div class="admin-dashboard-social-and-performance">
                <div class="admin-dashboard-total-cars">
                    <h3>Total Cars:</h3>
                    <h1><?php echo $totalCars; ?></h1>
                </div>
            </div>
        </div>
    </div>

    <?php include('../assets/components/footer.php'); ?>

    <script src="../assets/js/script.js"></script>

</body>
</html>