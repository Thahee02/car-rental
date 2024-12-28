<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Rental System</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>

    <?php include('./assets/components/menu.php'); ?>
    <div class="banner">
        <div class="banner-content">
            <h1>Welcome to Our Vehicle Rental System</h1>
            <p>Rent a car effortlessly for any occasion. Choose from a variety of well-maintained vehicles. Book now for a smooth, hassle-free experience.</p>
            <button>Book A Rental</button>
        </div>
    </div>

    <section class="about-us">
        <!-- Left Side: Image -->
        <div class="about-us-image">
            <img src="./assets/images/about-us.jpg" alt="">
        </div>

        <!-- Right Side: Content -->
        <div class="about-us-content">
            <h5>About Us</h5>
            <h2>Your trusted partner in reliable car rental</h2>
            <p>We provide a hassle-free vehicle rental experience tailored to your needs. Choose from a wide range of vehicles and enjoy your ride with confidence.</p>
            <div class="facility-cards">
            <!-- Facility Card 1 -->
            <div class="facility-card">
                <img src="./assets/images/facility-icon1.png" alt="Wide Range of Vehicles">
                <p>Wide range of vehicles</p>
            </div>
            <!-- Facility Card 2 -->
            <div class="facility-card">
                <img src="./assets/images/facility-icon2.png" alt="24/7 Customer Support">
                <p>24/7 customer support</p>
            </div>
        </div>
            <a href="contact.html" class="btn-contact-us">Contact Us</a>
        </div>
    </section>

    <section class="our-services">
        <h2>Our Services</h2>
        <div class="services-list">
            <div class="service">
                <h3>Car Rentals</h3>
                <p>Affordable car rentals for your everyday travel needs.</p>
            </div>
            <div class="service">
                <h3>Bike Rentals</h3>
                <p>Convenient and quick bike rentals for solo travelers.</p>
            </div>
            <div class="service">
                <h3>Luxury Vehicles</h3>
                <p>Exclusive luxury vehicles for special occasions.</p>
            </div>
        </div>
    </section>

    <section class="how-it-works">
        <h2>How It Works</h2>
        <div class="steps">
            <div class="step">
                <h3>Step 1</h3>
                <p>Select the vehicle that suits your needs.</p>
            </div>
            <div class="step">
                <h3>Step 2</h3>
                <p>Complete your booking in a few simple steps.</p>
            </div>
            <div class="step">
                <h3>Step 3</h3>
                <p>Pick up your vehicle and enjoy your ride.</p>
            </div>
        </div>
    </section>
</body>
</html>
