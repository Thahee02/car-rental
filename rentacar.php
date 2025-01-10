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
                <?php

                include './backend/db.php';

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM cars";
                $result = $conn->query($sql);

                $cars = [];
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $cars[] = $row;
                    }
                }
                $conn->close();
                ?>
                <!-- 15 Manual Cards -->
                <?php foreach ($cars as $car): ?>
                <div class="product-card">
                    <img src="./assets/images/cars/<?php echo htmlspecialchars($car['image']); ?>" alt="Car">
                    <h3><?php echo htmlspecialchars($car['car_modal']); ?></h3>
                    <p>Seats: <?php echo $car['seats']; ?></p>
                    <p>Speed: <?php echo $car['speed']; ?> mph</p>
                    <p>Mileage: <?php echo htmlspecialchars($car['mileage']); ?></p>
                    <p>Rent(Day): <?php echo htmlspecialchars($car['day_rent']); ?></p>
                </div>
                <?php endforeach; ?>
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
                                <option value="" disabled selected>-Select a car-</option>
                                <?php
                                include('./backend/db.php');
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }
                                
                                // Fetch available cars
                                $sql = "SELECT car_number, car_modal, mileage, seats, day_rent FROM cars WHERE status = 'available'";
                                $result = $conn->query($sql);

                                // Generate options dynamically
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='{$row['car_number']}' data-day-rent='{$row['day_rent']}'>{$row['car_modal']} - {$row['seats']} Seats - {$row['mileage']} Mileage</option>";
                                    }
                                } else {
                                    echo "<option value='' disabled>No cars available</option>";
                                }

                                $conn->close();
                                
                                ?>
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
                                <option value="cash">Cash</option>
                                <option value="bank-transfer">Bank Transfer</option>
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
                            <label for="total-amount">Total Amount:</label>
                            <input type="text" id="total-amount" name="total-amount" value="0.00" readonly  placeholder="total amount" required>
                        </div>
                        <div class="form-group">
                            <label for="balance-amount">Balance Amount:</label>
                            <input type="text" id="balance-amount" name="balance-amount" value="0.00" readonly  placeholder="balance amount" required>
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Get references to the form fields
            const rentalStartDate = document.getElementById('rental-period-start');
            const rentalEndDate = document.getElementById('rental-period-end');
            const carSelect = document.getElementById('car');
            const totalAmountField = document.getElementById('total-amount');
            const balanceAmountField = document.getElementById('balance-amount');
            const securityDepositField = document.getElementById('security-deposit');
            let dayRent = 0;

            // Function to calculate the difference in days
            function calculateRentalPeriod() {
                const startDate = new Date(rentalStartDate.value);
                const endDate = new Date(rentalEndDate.value);
                const timeDifference = endDate - startDate;
                const dayDifference = timeDifference / (1000 * 3600 * 24); // Convert milliseconds to days

                return dayDifference;
            }

            // Function to update the total and balance amount
            function updateTotalAmount() {
                const rentalDays = calculateRentalPeriod();
                if (rentalDays > 0 && carSelect.value && dayRent) {
                    const totalAmount = rentalDays * dayRent; // Calculate the total rent
                    const balanceAmount = totalAmount - securityDepositField.value; // Subtract security deposit
                    totalAmountField.value = totalAmount.toFixed(2);
                    balanceAmountField.value = balanceAmount.toFixed(2);
                }
            }

            // Event listeners for changes in rental dates or car selection
            rentalStartDate.addEventListener('change', updateTotalAmount);
            rentalEndDate.addEventListener('change', updateTotalAmount);
            carSelect.addEventListener('change', function() {
                // When car is selected, retrieve its day rent from the database
                const selectedCar = carSelect.options[carSelect.selectedIndex];
                dayRent = parseFloat(selectedCar.getAttribute('data-day-rent')); // Fetch day rent from selected car's data attribute
                updateTotalAmount();
            });
        });

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
