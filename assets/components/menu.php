<!-- Fixed Header -->
<header class="header">
    <div class="logo">
        <a href="index.php">Renta<span>Car</span></a>
    </div>

    <nav class="nav">
        <!-- Menu Items for Desktop and Larger Devices -->
        <ul class="menu">
            <li><a href="index.php" class="menu-item">Home</a></li>
            <li><a href="rentacar.php" class="menu-item">Rent a Car</a></li>
            <li><a href="index.php#about-us" class="menu-item">About</a></li>
            <li><a href="contact.php" class="menu-item">Contact Us</a></li>
            
            <?php 
            
            if(isset($_SESSION['is_login'])){ 
                ?>
                <!-- User Avatar -->
                <li class="user-profile" onclick="toggleSubmenu()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"><path fill="currentColor" d="M5.85 17.1q1.275-.975 2.85-1.537T12 15t3.3.563t2.85 1.537q.875-1.025 1.363-2.325T20 12q0-3.325-2.337-5.663T12 4T6.337 6.338T4 12q0 1.475.488 2.775T5.85 17.1M12 13q-1.475 0-2.488-1.012T8.5 9.5t1.013-2.488T12 6t2.488 1.013T15.5 9.5t-1.012 2.488T12 13m0 9q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22"/></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="m12 15.4l-6-6L7.4 8l4.6 4.6L16.6 8L18 9.4z"/></svg>
                    
                </li>
            <?php } 
                else{ ?>
                <!-- Login Button -->
                <li><a href="login.php" class="menu-item menu-login-button">Login</a></li>
            <?php } ?>
        </ul>

        <!-- Menu Icon for Small Devices -->
        <div class="menu-icon" onclick="toggleMenu()">
            &#9776; <!-- Hamburger Icon -->
        </div>
    </nav>

    <!-- Submenu -->
    <ul class="submenu hidden" id="submenu">
        <li><a href="profile.php">Profile</a></li>
        <li><a href="orders.php">Orders</a></li>
        <li><a href="settings.php">Settings</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</header>


<!-- Side Menu for Mobile Devices -->
<div class="side-menu" id="sideMenu">
    <ul>
        <li><a href="index.php" class="side-menu-item">Home</a></li>
        <li><a href="rentacar.php" class="side-menu-item">Rent a Car</a></li>
        <li><a href="#about-us" class="side-menu-item">About</a></li>
        <li><a href="contact.php" class="side-menu-item">Contact Us</a></li>
        <li><a href="login.php" class="side-menu-item menu-login-button">Login</a></li>
    </ul>
</div>