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
    <title>Cars | RentaCar</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include('../assets/components/menu.php'); ?>

    <section class="admin-cars-banner">
        <h1>Cars</h1>
        <div class="breadcrumb">Home / Admin / <span>Cars</span></div>
    </section>

    <div class="admin-users-container">
        <!-- Left Sidebar -->
        <?php include('../assets/components/admin-sidebar.php'); ?>

        <!-- Main Content -->
        <div class="admin-users-main-content">

            <?php 

            include('../backend/db.php');
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $email = $_SESSION['user_email'];

            // Escape the email to prevent SQL injection
            $email = mysqli_real_escape_string($conn, $email);

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

            ?>

            <div class="admin-dashboard-profile-section">
                <img src="../assets/images/my-profile-avatar.jpg" alt="Profile Picture">
                <div>
                    <h2><?php echo $name; ?></h2>
                    <p><?php echo $role; ?></p>
                </div>
            </div>

            <?php

                include '../backend/db.php';
                
                $filterConditions = [];
                if (!empty($_GET['filter-car-number'])) {
                    $carNumber = mysqli_real_escape_string($conn, $_GET['filter-car-number']);
                    $filterConditions[] = "car_number LIKE '%$carNumber%'";
                }
                if (!empty($_GET['filter-car-model'])) {
                    $carModel = mysqli_real_escape_string($conn, $_GET['filter-car-model']);
                    $filterConditions[] = "car_model LIKE '%$carModel%'";
                }
                if (!empty($_GET['filter-seats'])) {
                    $seats = intval($_GET['filter-seats']);
                    $filterConditions[] = "seats = $seats";
                }
                if (!empty($_GET['filter-day-rent'])) {
                    $dayRent = floatval($_GET['filter-day-rent']);
                    $filterConditions[] = "day_rent <= $dayRent";
                }
                if (!empty($_GET['filter-status'])) {
                    $status = mysqli_real_escape_string($conn, $_GET['filter-status']);
                    $filterConditions[] = "status = '$status'";
                }

                $sql2 = "SELECT id, car_number, car_modal, seats, day_rent, status FROM cars";
                if (!empty($filterConditions)) {
                    $sql2 .= " WHERE " . implode(" AND ", $filterConditions);
                }

                $result2 = mysqli_query($conn, $sql2);
            
            ?>

            <div class="filter-cars-section">
                <h4>Filter Cars</h4>
                <form method="GET">
                    <!-- Filter by Car Number -->
                    <div class="form-group">
                        <label for="filter-car-number">Car Number:</label>
                        <input type="text" id="filter-car-number" name="filter-car-number" placeholder="Enter car number" value="<?php echo htmlspecialchars($filterCarNumber ?? ''); ?>">
                    </div>

                    <!-- Filter by Car Model -->
                    <div class="form-group">
                        <label for="filter-car-model">Car Model:</label>
                        <input type="text" id="filter-car-model" name="filter-car-model" placeholder="Enter car model" value="<?php echo htmlspecialchars($filterCarModel ?? ''); ?>">
                    </div>

                    <!-- Filter by Seats -->
                    <div class="form-group">
                        <label for="filter-seats">Seats:</label>
                        <input type="number" id="filter-seats" name="filter-seats" placeholder="Enter number of seats" value="<?php echo htmlspecialchars($filterSeats ?? ''); ?>" min="1">
                    </div>

                    <!-- Filter by Day Rent -->
                    <div class="form-group">
                        <label for="filter-day-rent">Day Rent:</label>
                        <input type="number" id="filter-day-rent" name="filter-day-rent" placeholder="Enter day rent amount" value="<?php echo htmlspecialchars($filterDayRent ?? ''); ?>" min="0" step="0.01">
                    </div>

                    <!-- Filter by Status -->
                    <div class="form-group">
                        <label for="filter-status">Status:</label>
                        <select id="filter-status" name="filter-status">
                            <option value="" disabled selected>-Select status-</option>
                            <option value="available" <?php if (($filterStatus ?? '') === 'available') echo 'selected'; ?>>Available</option>
                            <option value="booked" <?php if (($filterStatus ?? '') === 'booked') echo 'selected'; ?>>Booked</option>
                            <option value="maintenance" <?php if (($filterStatus ?? '') === 'maintenance') echo 'selected'; ?>>Maintenance</option>
                        </select>
                    </div>

                    <!-- Apply Filters Button -->
                    <button type="submit">Apply Filters</button>
                    <!-- Reset Filters Button -->
                    <button type="reset">Clear Filters</button>
                </form>
            </div>

           <div class="admin-cars-main-content">
                <h4>Cars</h4>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Car Number</th>
                            <th>Car Model</th>
                            <th>Seats</th>
                            <th>Day Rent</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if ($result2 && mysqli_num_rows($result2) > 0) {
                                while ($car = mysqli_fetch_assoc($result2)) {
                                    echo "<tr>
                                        <td>{$car['id']}</td>
                                        <td>{$car['car_number']}</td>
                                        <td>{$car['car_modal']}</td>
                                        <td>{$car['seats']}</td>
                                        <td>{$car['day_rent']}</td>
                                        <td>
                                            <form method='POST' action='../backend/car/update_car_status.php'>
                                                <input type='hidden' name='car_id' value='{$car['id']}'>
                                                <select name='car-status' onchange='this.form.submit()'>
                                                    <option value='available'" . ($car['status'] == 'available' ? 'selected' : '') . ">Available</option>
                                                    <option value='booked'" . ($car['status'] == 'booked' ? 'selected' : '') . ">Booked</option>
                                                    <option value='maintenance'" . ($car['status'] == 'maintenance' ? 'selected' : '') . ">Maintenance</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            <form method='POST' action='../backend/car/delete_car.php' onsubmit='return confirmDelete();'>
                                                <input type='hidden' name='car_number' value='{$car['car_number']}'>
                                                <button type='submit' class='btn-delete'>Delete</button>
                                            </form>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7' class='text-center'>No cars found</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>


            <div class="admin-cars-add-car-section">
                <h4>Add a New Car</h4>
                <form action="../backend/car/add_car_process.php" method="POST" enctype="multipart/form-data">
                    <!-- Car Number -->
                    <div class="admin-cars-form-group">
                        <label for="car_number">Car Number:</label>
                        <input type="text" id="car_number" name="car_number" required placeholder="Enter car number">
                    </div>

                    <!-- Car Model -->
                    <div class="admin-cars-form-group">
                        <label for="car_model">Car Model:</label>
                        <input type="text" id="car_model" name="car_model" required placeholder="Enter car model">
                    </div>

                    <!-- Speed -->
                    <div class="admin-cars-form-group">
                        <label for="speed">Speed (km/h):</label>
                        <input type="number" id="speed" name="speed" required placeholder="Enter car speed" min="0">
                    </div>

                    <!-- Mileage -->
                    <div class="admin-cars-form-group">
                        <label for="mileage">Mileage (km):</label>
                        <input type="number" id="mileage" name="mileage" required placeholder="Enter car mileage" min="0">
                    </div>

                    <!-- Seats -->
                    <div class="admin-cars-form-group">
                        <label for="seats">Seats:</label>
                        <input type="number" id="seats" name="seats" required placeholder="Enter number of seats" min="1">
                    </div>

                    <!-- Image -->
                    <div class="admin-cars-form-group">
                        <label for="image">Car Image:</label>
                        <input type="file" id="image" name="image" required accept="image/*">
                    </div>

                    <!-- Day Rent -->
                    <div class="admin-cars-form-group">
                        <label for="day_rent">Day Rent (in 0.00):</label>
                        <input type="number" id="day_rent" name="day_rent" required placeholder="Enter daily rent" min="0" step="0.01">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="admin-cars-btn-submit">Add A Car</button>
                </form>
            </div>



            <?php
            // Close the connection
            mysqli_close($conn);
            ?>            

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

    <?php include('../assets/components/footer.php'); ?>

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
                    window.location.href = 'http://localhost/car/admin/cars.php'; <?php
                }
                else{ ?>
                    window.location.href = 'http://localhost/car/admin/cars.php'; <?php
                }
                                
                unset($_SESSION['modal_icon']);
                unset($_SESSION['modal_heading']);
                unset($_SESSION['modal_message']);
            ?>
        }

        // confirm message when delete user
        function confirmDelete() {
            
            var confirmMessage = confirm("Are you sure you want to delete this car?")
            if (confirmMessage) {
                return true;
            }
            else{
                return false;
            } 
        }

    </script>

    <script src="../assets/js/script.js"></script>
</body>
</html>