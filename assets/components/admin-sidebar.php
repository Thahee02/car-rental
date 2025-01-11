<?php 
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="admin-dashboard-sidebar">
    <ul>
        <li><a href="http://localhost/car/admin/dashboard.php" class="menu-item <?php if($current_page == 'dashboard.php') echo 'highlight'; ?>">Dashboard</a></li>
        <li><a href="http://localhost/car/admin/users.php" class="menu-item <?php if($current_page == 'users.php') echo 'highlight'; ?>">Users</a></li>
        <li><a href="http://localhost/car/admin/rents.php" class="menu-item <?php if($current_page == 'rents.php') echo 'highlight'; ?>">Orders</a></li>
        <li><a href="http://localhost/car/admin/cars.php" class="menu-item <?php if($current_page == 'cars.php') echo 'highlight'; ?>">Cars</a></li>
    </ul>
</div>
