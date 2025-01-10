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
    <title>Rents | RentaCar</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include('../assets/components/menu.php'); ?>

    <section class="admin-rents-banner">
        <h1>Rents</h1>
        <div class="breadcrumb">Home / Admin / <span>Rents</span></div>
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

            <?php
            include('../backend/db.php');

            // Initialize variables for filters
            $filterUserEmail = $_GET['filter-user-email'] ?? '';
            $filterBookedDate = $_GET['filter-booked-date'] ?? '';
            $filterCustomerName = $_GET['filter-customer-name'] ?? '';
            $filterCustomerEmail = $_GET['filter-customer-email'] ?? '';
            $filterCustomerPhone = $_GET['filter-customer-phone'] ?? '';
            $filterCustomerNIC = $_GET['filter-customer-nic'] ?? '';
            $filterCarName = $_GET['filter-car-name'] ?? '';
            $filterPaymentMethod = $_GET['filter-payment-method'] ?? '';
            $filterStatus = $_GET['filter-status'] ?? '';

            // SQL Query with filters
            $sql = "SELECT id, user_email, booked_date, c_name, c_email, c_phone, c_nic, car_name, pay_method, total_amount, security_deposit, balance_amount, status FROM rents WHERE 1=1";

            // Add filters to the SQL query
            if (!empty($filterUserEmail)) {
                $sql .= " AND user_email LIKE '%" . mysqli_real_escape_string($conn, $filterUserEmail) . "%'";
            }
            if (!empty($filterBookedDate)) {
                $sql .= " AND booked_date = '" . mysqli_real_escape_string($conn, $filterBookedDate) . "'";
            }
            if (!empty($filterCustomerName)) {
                $sql .= " AND c_name LIKE '%" . mysqli_real_escape_string($conn, $filterCustomerName) . "%'";
            }
            if (!empty($filterCustomerEmail)) {
                $sql .= " AND c_email LIKE '%" . mysqli_real_escape_string($conn, $filterCustomerEmail) . "%'";
            }
            if (!empty($filterCustomerPhone)) {
                $sql .= " AND c_phone LIKE '%" . mysqli_real_escape_string($conn, $filterCustomerPhone) . "%'";
            }
            if (!empty($filterCustomerNIC)) {
                $sql .= " AND c_nic LIKE '%" . mysqli_real_escape_string($conn, $filterCustomerNIC) . "%'";
            }
            if (!empty($filterCarName)) {
                $sql .= " AND car_name LIKE '%" . mysqli_real_escape_string($conn, $filterCarName) . "%'";
            }
            if (!empty($filterPaymentMethod)) {
                $sql .= " AND pay_method = '" . mysqli_real_escape_string($conn, $filterPaymentMethod) . "'";
            }
            if (!empty($filterStatus)) {
                $sql .= " AND status = '" . mysqli_real_escape_string($conn, $filterStatus) . "'";
            }

            // Execute the query
            $result = mysqli_query($conn, $sql);
            ?>

            <div class="filter-rents-section">
                <h4>Filter Rents</h4>
                <form method="GET">
                    <!-- Filter by User Email -->
                    <div class="form-group">
                        <label for="filter-user-email">User Email:</label>
                        <input type="email" id="filter-user-email" name="filter-user-email" placeholder="Enter user email" value="<?php echo htmlspecialchars($filterUserEmail); ?>">
                    </div>

                    <!-- Filter by Booked Date -->
                    <div class="form-group">
                        <label for="filter-booked-date">Booked Date:</label>
                        <input type="date" id="filter-booked-date" name="filter-booked-date" value="<?php echo htmlspecialchars($filterBookedDate); ?>">
                    </div>

                    <!-- Filter by Customer Name -->
                    <div class="form-group">
                        <label for="filter-customer-name">Customer Name:</label>
                        <input type="text" id="filter-customer-name" name="filter-customer-name" placeholder="Enter customer name" value="<?php echo htmlspecialchars($filterCustomerName); ?>">
                    </div>

                    <!-- Filter by Customer Email -->
                    <div class="form-group">
                        <label for="filter-customer-email">Customer Email:</label>
                        <input type="email" id="filter-customer-email" name="filter-customer-email" placeholder="Enter customer email" value="<?php echo htmlspecialchars($filterCustomerEmail); ?>">
                    </div>

                    <!-- Filter by Customer Phone -->
                    <div class="form-group">
                        <label for="filter-customer-phone">Customer Phone:</label>
                        <input type="tel" id="filter-customer-phone" name="filter-customer-phone" placeholder="Enter customer phone" value="<?php echo htmlspecialchars($filterCustomerPhone); ?>">
                    </div>

                    <!-- Filter by Customer NIC -->
                    <div class="form-group">
                        <label for="filter-customer-nic">Customer NIC:</label>
                        <input type="text" id="filter-customer-nic" name="filter-customer-nic" placeholder="Enter customer NIC" value="<?php echo htmlspecialchars($filterCustomerNIC); ?>">
                    </div>

                    <!-- Filter by Car Name -->
                    <div class="form-group">
                        <label for="filter-car-name">Car Name:</label>
                        <input type="text" id="filter-car-name" name="filter-car-name" placeholder="Enter car name" value="<?php echo htmlspecialchars($filterCarName); ?>">
                    </div>

                    <!-- Filter by Payment Method -->
                    <div class="form-group">
                        <label for="filter-payment-method">Payment Method:</label>
                        <select id="filter-payment-method" name="filter-payment-method">
                            <option value="" disabled selected>-Select payment method-</option>
                            <option value="credit-card" <?php if ($filterPaymentMethod === 'credit-card') echo 'selected'; ?>>Credit Card</option>
                            <option value="cash" <?php if ($filterPaymentMethod === 'cash') echo 'selected'; ?>>Cash</option>
                            <option value="bank-transfer" <?php if ($filterPaymentMethod === 'bank-transfer') echo 'selected'; ?>>Bank Transfer</option>
                        </select>
                    </div>

                    <!-- Filter by Status -->
                    <div class="form-group">
                        <label for="filter-status">Status:</label>
                        <select id="filter-status" name="filter-status">
                            <option value="" disabled selected>-Select status-</option>
                            <option value="pending" <?php if ($filterStatus === 'pending') echo 'selected'; ?>>Pending</option>
                            <option value="completed" <?php if ($filterStatus === 'completed') echo 'selected'; ?>>Completed</option>
                            <option value="canceled" <?php if ($filterStatus === 'canceled') echo 'selected'; ?>>Canceled</option>
                        </select>
                    </div>

                    <!-- Apply Filters Button -->
                    <button type="submit">Apply Filters</button>
                </form>
            </div>

            <div class="admin-rents-display-section">
                <h4>Rents</h4>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Email</th>
                            <th>Booked Date</th>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Customer Phone</th>
                            <th>Car Name</th>
                            <th>Payment Method</th>
                            <th>Total Amount</th>
                            <th>Security Deposite</th>
                            <th>Balance Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($rent = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                        <td>{$rent['id']}</td>
                                        <td>{$rent['user_email']}</td>
                                        <td>{$rent['booked_date']}</td>
                                        <td>{$rent['c_name']}</td>
                                        <td>{$rent['c_email']}</td>
                                        <td>{$rent['c_phone']}</td>
                                        <td>{$rent['car_name']}</td>
                                        <td>{$rent['pay_method']}</td>
                                        <td>{$rent['total_amount']}</td>
                                        <td>{$rent['security_deposit']}</td>
                                        <td>{$rent['balance_amount']}</td>
                                        <td>
                                            <!-- Status Update Form -->
                                            <form method='POST' action='../backend/rent/update_rent_status.php' class='rent-status-update-form' style='display:inline;'>
                                                <input type='hidden' name='rent_id' value='{$rent['id']}'>
                                                <select name='rent_status' onchange='this.form.submit()'>
                                                    <option value='pending'" . ($rent['status'] === 'pending' ? ' selected' : '') . ">Pending</option>
                                                    <option value='completed'" . ($rent['status'] === 'completed' ? ' selected' : '') . ">Completed</option>
                                                    <option value='canceled'" . ($rent['status'] === 'canceled' ? ' selected' : '') . ">Canceled</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            <!-- Delete Button -->
                                            <form method='POST' action='../backend/rent/delete_rent.php' class='delete-rent-form' style='display:inline;' onsubmit='return confirmDelete();'>
                                                <input type='hidden' name='rent_id' value='{$rent['id']}'>
                                                <button type='submit' style='color:red;'>Delete</button>
                                            </form>
                                        </td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='13' style='text-align:center;'>No rents found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
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
                    window.location.href = 'http://localhost/car/admin/rents.php'; <?php
                }
                else{ ?>
                    window.location.href = 'http://localhost/car/admin/rents.php'; <?php
                }
                                
                unset($_SESSION['modal_icon']);
                unset($_SESSION['modal_heading']);
                unset($_SESSION['modal_message']);
            ?>
        }

        // confirm message when delete user
        function confirmDelete() {
            
            var confirmMessage = confirm("Are you sure you want to delete this user?")
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