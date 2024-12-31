<?php
// Start the session to store login information (if needed)
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentaCar - Vehicle Rental System</title>
    <!-- link stylesheet -->
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>

    <?php include('./assets/components/menu.php'); ?>
    <div class="banner">
        <div class="banner-content">
            <h1>Welcome to Our Car Rental System</h1>
            <p>Rent a car effortlessly for any occasion. Choose from a variety of well-maintained vehicles. Book now for a smooth, hassle-free experience.</p>
            <button>Book A Rental</button>
        </div>
    </div>

    <section class="about-us" id="about-us">
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

    <!-- our services section -->
    <section class="our-services">
        <h5>Our Car Rental Services</h5>
        <h2>Explore our wide range of car rental options</h2>
        <p>We offer a variety of car rental options to suit your needs, from affordable standard cars to luxury vehicles. Whether you're planning a road trip or need a reliable car for business, we have you covered.</p>
        
        <div class="services-list">
            <div class="service">
                <img src="./assets/images/our-services-icon1.png" alt="Standard Car Rentals Icon">
                <h3>Standard Car Rentals</h3>
                <p>Affordable cars for everyday use and long drives.</p>
            </div>
            <div class="service">
                <img src="./assets/images/our-services-icon2.png" alt="Luxury Car Rentals Icon">
                <h3>Luxury Car Rentals</h3>
                <p>Experience style and comfort with our luxury car options.</p>
            </div>
            <div class="service">
                <img src="./assets/images/our-services-icon3.png" alt="Car Rental Packages Icon">
                <h3>Car Rental Packages</h3>
                <p>Choose from a range of rental packages that suit your journey.</p>
            </div>
        </div>
        
        <a href="car-rentals.html" class="btn-view-all-services">View All Services</a>
    </section>

    <section class="how-it-works">
        <h2>How It Works ?</h2>
        <div class="steps">
            <div class="step">
                <img src="./assets/images/how-it-work-step1.jpg" alt="Step 1 Image">
                <h3>Step 1</h3>
                <p>Select the vehicle that suits your needs.</p>
            </div>
            <div class="step">
                <img src="./assets/images/how-it-work-step2.jpg" alt="Step 2 Image">
                <h3>Step 2</h3>
                <p>Complete your booking in a few simple steps.</p>
            </div>
            <div class="step">
                <img src="./assets/images/how-it-work-step3.jpg" alt="Step 3 Image">
                <h3>Step 3</h3>
                <p>Pick up your vehicle and enjoy your ride.</p>
            </div>
        </div>
        <div class="line-connection"></div>
    </section>

    <!-- Modal HTML -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <div id="modal-icon"></div>
            <h2 id="modal-heading"></h2>
            <hr>
            <p id="modal-message"></p>
            <button onclick="closeModal()">Close</button>
        </div>
    </div>

    <?php include('./assets/components/footer.php'); ?>

    <script>
        // Check if there is a message in the session (passed via PHP)
        <?php if (isset($_SESSION['modal_message'])): ?>
            var icon = "<?php echo $_SESSION['modal_icon']; ?>";
            var heading = "<?php echo $_SESSION['modal_heading']; ?>";
            var message = "<?php echo $_SESSION['modal_message']; ?>";
            var modalIcon = document.getElementById('modal-icon');
            var modalHeading = document.getElementById('modal-heading');
            var modalMessage = document.getElementById('modal-message');
            var modalError = document.getElementById('modal-error');
            showModal(message);
            
        <?php endif; ?>

        // Function to display the modal
        function showModal(message) {
            modalIcon.innerHTML = icon;
            modalHeading.innerText = heading;
            modalMessage.innerHTML = message;
            document.getElementById('modal').style.display = "flex";
            
            <?php
                if(isset($_SESSION['modal_message']) && $_SESSION['modal_heading'] == "Error!"){
                    ?>
                    modalHeading.style.color = "#ff3333"; 
                    modalError.style.color = "#ff3333";
                    <?php
                }
                else{
                    ?>
                    modalHeading.style.color = "#4CAF50"; <?php
                } 
            ?>
        }

        // Function to close the modal
        function closeModal() {
             <?php
                if(isset($_SESSION['modal_message']) && $_SESSION['modal_heading'] == "Successful!"){
                    ?>
                    window.location.href = 'http://localhost/car/index.php'; <?php
                }
                else{
                    ?>
                    window.location.href = 'http://localhost/car/login.php'; <?php
                }
                                
                unset($_SESSION['modal_icon']); 
                unset($_SESSION['modal_heading']); 
                unset($_SESSION['modal_message']); 
            
             ?>
        }
    </script>

    <script src="./assets/js/script.js"></script>
</body>
</html>
