<?php
// Start the session
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent A Car - RentaCar</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>

    <?php include('./assets/components/menu.php'); ?>

    <div class="rentCar-banner">
        <h1>Rent A Car</h1>
        <div class="breadcrumb">Home / <span>Rent A Car</span></div>
    </div>

    <div class="product-slider">
        <h2>Our Cars</h2>
        <div class="slider-container">
            <div class="slider-track" id="slider-track">
                <!-- 15 Manual Cards -->
                <div class="product-card"><img src="./assets/images/Ford Escape.avif" alt="Car 1"><h3>Car Model 1</h3><p>Seats: 5</p><p>Speed: 120 mph</p><p>Mileage: 30 MPG</p></div>
                <div class="product-card"><img src="car2.jpg" alt="Car 2"><h3>Car Model 2</h3><p>Seats: 7</p><p>Speed: 130 mph</p><p>Mileage: 25 MPG</p></div>
                <div class="product-card"><img src="car3.jpg" alt="Car 3"><h3>Car Model 3</h3><p>Seats: 5</p><p>Speed: 110 mph</p><p>Mileage: 35 MPG</p></div>
                <div class="product-card"><img src="car4.jpg" alt="Car 4"><h3>Car Model 4</h3><p>Seats: 5</p><p>Speed: 140 mph</p><p>Mileage: Electric</p></div>
                <div class="product-card"><img src="car5.jpg" alt="Car 5"><h3>Car Model 5</h3><p>Seats: 7</p><p>Speed: 125 mph</p><p>Mileage: 28 MPG</p></div>
                <div class="product-card"><img src="car6.jpg" alt="Car 6"><h3>Car Model 6</h3><p>Seats: 5</p><p>Speed: 115 mph</p><p>Mileage: 32 MPG</p></div>
                <div class="product-card"><img src="car7.jpg" alt="Car 7"><h3>Car Model 7</h3><p>Seats: 5</p><p>Speed: 120 mph</p><p>Mileage: 30 MPG</p></div>
                <div class="product-card"><img src="car8.jpg" alt="Car 8"><h3>Car Model 8</h3><p>Seats: 5</p><p>Speed: 135 mph</p><p>Mileage: Electric</p></div>
                <div class="product-card"><img src="car9.jpg" alt="Car 9"><h3>Car Model 9</h3><p>Seats: 7</p><p>Speed: 100 mph</p><p>Mileage: 29 MPG</p></div>
                <div class="product-card"><img src="car10.jpg" alt="Car 10"><h3>Car Model 10</h3><p>Seats: 5</p><p>Speed: 140 mph</p><p>Mileage: 26 MPG</p></div>
                <div class="product-card"><img src="car11.jpg" alt="Car 11"><h3>Car Model 11</h3><p>Seats: 7</p><p>Speed: 115 mph</p><p>Mileage: 33 MPG</p></div>
                <div class="product-card"><img src="car12.jpg" alt="Car 12"><h3>Car Model 12</h3><p>Seats: 5</p><p>Speed: 120 mph</p><p>Mileage: 34 MPG</p></div>
                <div class="product-card"><img src="car13.jpg" alt="Car 13"><h3>Car Model 13</h3><p>Seats: 5</p><p>Speed: 130 mph</p><p>Mileage: 28 MPG</p></div>
                <div class="product-card"><img src="car14.jpg" alt="Car 14"><h3>Car Model 14</h3><p>Seats: 7</p><p>Speed: 110 mph</p><p>Mileage: Electric</p></div>
                <div class="product-card"><img src="car15.jpg" alt="Car 15"><h3>Car Model 15</h3><p>Seats: 5</p><p>Speed: 125 mph</p><p>Mileage: 27 MPG</p></div>
            </div>
        </div>
        <div class="slider-controls">
            <button class="slider-control" id="prev-btn">❮</button>
            <button class="slider-control" id="next-btn">❯</button>
        </div>
    </div>

    <div class="container full-width">
        <div class="form-container">
            <h2>Rent A Car Now</h2>
            <form action="./backend/rent/rent_process.php" method="POST">
                <!-- First Row: Personal Information and Rental Details -->
                <div class="form-row">
                    <!-- Personal Information -->
                    <div class="form-column">
                        <h3>01. Personal Information</h3>
                        <div class="form-group">
                            <label for="full-name">Full Name:</label>
                            <input type="text" id="full-name" name="full-name" placeholder="Enter your full name" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number:</label>
                            <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address:</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Residential Address:</label>
                            <input type="text" id="address" name="address" placeholder="Enter your address" required>
                        </div>
                        <div class="form-group">
                            <label for="id">Government-Issued ID:</label>
                            <input type="text" id="id" name="id" placeholder="Enter your ID number" required>
                        </div>
                    </div>

                    <!-- Rental Details -->
                    <div class="form-column">
                        <h3>02. Rental Details</h3>
                        <div class="form-group">
                            <label for="car">Car Selected:</label>
                            <select id="car" name="car" required>
                                <option value="" disabled selected>Select a car</option>
                                <option value="car1">Toyota Corolla - 5 Seats - 30 MPG</option>
                                <option value="car2">Honda Civic - 5 Seats - 32 MPG</option>
                                <option value="car3">Ford Escape - 7 Seats - 28 MPG</option>
                                <option value="car4">Chevrolet Suburban - 8 Seats - 20 MPG</option>
                                <option value="car5">Nissan Altima - 5 Seats - 27 MPG</option>
                                <option value="car6">Hyundai Sonata - 5 Seats - 29 MPG</option>
                                <option value="car7">Jeep Wrangler - 4 Seats - 25 MPG</option>
                                <option value="car8">Tesla Model 3 - 5 Seats - Electric</option>
                                <option value="car9">BMW X5 - 5 Seats - 26 MPG</option>
                                <option value="car10">Mercedes-Benz Sprinter - 12 Seats - 18 MPG</option>
                                <option value="car11">Kia Sorento - 7 Seats - 26 MPG</option>
                                <option value="car12">Volkswagen Passat - 5 Seats - 28 MPG</option>
                                <option value="car13">Mazda CX-5 - 5 Seats - 25 MPG</option>
                                <option value="car14">Audi Q7 - 7 Seats - 22 MPG</option>
                                <option value="car15">Subaru Outback - 5 Seats - 29 MPG</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="rental-period-start">Rental Start Date:</label>
                            <input type="date" id="rental-period-start" name="rental-period-start" required>
                        </div>
                        <div class="form-group">
                            <label for="rental-period-end">Rental End Date:</label>
                            <input type="date" id="rental-period-end" name="rental-period-end" required>
                        </div>
                        <div class="form-group">
                            <label for="pickup-location">Pick-Up Location:</label>
                            <input type="text" id="pickup-location" name="pickup-location" placeholder="Enter pick-up address" required>
                        </div>
                        <div class="form-group">
                            <label for="dropoff-location">Drop-Off Location:</label>
                            <input type="text" id="dropoff-location" name="dropoff-location" placeholder="Enter drop-off address" required>
                        </div>
                    </div>
                </div>

                <!-- Second Row: Driver's License Details, Payment Information, and Terms -->
                <div class="form-row">
                    <!-- Driver's License Details -->
                    <div class="form-column">
                        <h3>03. Driver's License Details</h3>
                        <div class="form-group">
                            <label for="license-number">Driver’s License Number:</label>
                            <input type="text" id="license-number" name="license-number" placeholder="Enter your license number" required>
                        </div>
                        <div class="form-group">
                            <label for="issuing-authority">Issuing Country:</label>
                            <input type="text" id="issuing-authority" name="issuing-authority" placeholder="Enter issuing authority" required>
                        </div>
                        <div class="form-group">
                            <label for="expiration-date">Expiration Date:</label>
                            <input type="date" id="expiration-date" name="expiration-date" required>
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="form-column">
                        <h3>04. Payment Information</h3>
                        
                        <!-- Payment Method -->
                        <div class="form-group">
                            <label for="payment-method">Payment Method:</label>
                            <select id="payment-method" name="payment-method" required onchange="showCardFields()">
                                <option value="" disabled selected>-- Choose a payment method --</option>
                                <option value="credit-card">Credit Card</option>
                                <option value="debit-card">Debit Card</option>
                                <option value="cash">Cash</option>
                            </select>
                        </div>
                        
                        <!-- Visa or MasterCard Radio Buttons -->
                        <div class="form-group" id="payment-icons" style="display:none;">
                            <label>Choose Card:</label>
                            <label class="card-option">
                                <input type="radio" name="card-type" value="visa" id="visa-card" class="card-radio">
                                <img src="./assets/images/visa-icon.png" alt="Visa" class="card-icon">
                            </label>
                            <label class="card-option">
                                <input type="radio" name="card-type" value="mastercard" id="mastercard" class="card-radio">
                                <img src="./assets/images/master-icon.png" alt="MasterCard" class="card-icon">
                            </label>
                        </div>
                        
                        <!-- Card Number and CVV Fields -->
                        <div class="form-group" id="card-details" style="display:none;">
                            <label for="card-number">Card Number:</label>
                            <input type="text" id="card-number" name="card-number" placeholder="Enter card number" minlength="16" maxlength="16">
                        </div>
                        
                        <div class="form-group" id="cvv-details" style="display:none;">
                            <label for="cvv-number">CVV Number:</label>
                            <input type="text" id="cvv-number" name="cvv-number" placeholder="Enter CVV number" minlength="3" maxlength="3">
                        </div>
                        
                        <!-- Other fields -->
                        <div class="form-group">
                            <label for="security-deposit">Security Deposit:</label>
                            <input type="text" id="security-deposit" name="security-deposit" value="20000.00" readonly  placeholder="Enter deposit amount" required>
                        </div>
                        <div class="form-group">
                            <label for="billing-address">Billing Information:</label>
                            <input type="text" id="billing-address" name="billing-address" placeholder="Enter billing address" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit">Book Now</button>
                </div>
            </form>
        </div>
    </div>

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
                if(isset($_SESSION['modal_message']) && $_SESSION['modal_heading'] == "Successful!"){ ?>
                        window.location.href = 'http://localhost/car/rentacar.php'; <?php
                }
                else{
                    ?>
                    window.location.href = 'http://localhost/car/rentacar.php'; <?php
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
