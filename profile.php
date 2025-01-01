<?php
// Start the session
session_start();

if (!isset($_SESSION['is_login'])) {
    // User is already logged in, redirect to the home page
    header("Location: index.php");
    exit(); // Stop further execution of the script
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | RentaCar</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <?php include('./assets/components/menu.php'); ?>

    <section class="my-profile-banner">
        <h1>My Profile</h1>
        <div class="breadcrumb">Home / <span>Profile</span></div>
    </section>

    <div class="my-profile-profile-card">
        <!-- Personal Information Section -->
         <div class="my-profile-avatar">
            <img src="./assets/images/my-profile-avatar.svg" alt="">
         </div>
        <form method="post" class="my-profile-section" action="./backend/log-reg/update_profile.php">

            <?php 

            include('./backend/db.php');
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $email = $_SESSION['user_email'];

            // Escape the email to prevent SQL injection
            $email = mysqli_real_escape_string($conn, $email);

            // SQL query to fetch user details
            $sql = "SELECT name, email, phone, nic FROM users WHERE email = '$email'";

            // Execute the query
            $result = mysqli_query($conn, $sql);

            // Check if user exists
            if ($result && mysqli_num_rows($result) > 0) {
                // Fetch user details
                $user = mysqli_fetch_assoc($result);
                $name = $user['name'];
                $email = $user['email'];
                $phone = $user['phone'];
                $nic = $user['nic'];
            } else {
                echo "<p style='text-align: center;'>No user found with the given email.</p>" . $_SESSION['user_email'];
                exit;
            }

            // Close the connection
            mysqli_close($conn);

            ?>
            <h3>Personal Information</h3>
            <div class="my-profile-form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="userName" value="<?php echo htmlspecialchars($name); ?>" placeholder="Enter name">
            </div>
            <div class="my-profile-form-group">
                <label for="email">Email</label>
                <input type="email" readonly disabled id="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="johndoe@example.com">
            </div>
            <div class="my-profile-form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="userPhone" value="<?php echo htmlspecialchars($phone); ?>" placeholder="Enter phone no.">
            </div>
            <div class="my-profile-form-group">
                <label for="nic">NIC No.</label>
                <input type="text" id="nic" name="userNIC" value="<?php echo htmlspecialchars($nic); ?>" placeholder="Enter nic no.">
            </div>
            <div class="my-profile-button-group">
                <button type="submit" id="save-info">Save</button>
            </div>
        </form>

        <!-- Client Orders Section -->
        <div class="my-profile-section">
            <h3>Rental History</h3>
            <div id="orders">
                <div class="my-profile-order-item">
                    <span>Order #12345 - $200</span>
                    <button class="cancel-order">Cancel Order</button>
                </div>
                <div class="my-profile-order-item">
                    <span>Order #12344 - $150</span>
                    <button class="cancel-order">Cancel Order</button>
                </div>
            </div>
        </div>

        <!-- Change Password Section -->
        <div class="my-profile-section">
            <h3>Change Password</h3>
            <form id="change-password-form">
                <div class="my-profile-form-group">
                    <label for="old-password">Old Password</label>
                    <input type="password" id="old-password" placeholder="Enter old password">
                </div>
                <div class="my-profile-form-group">
                    <label for="new-password">New Password</label>
                    <input type="password" id="new-password" placeholder="Enter new password">
                </div>
                <div class="my-profile-form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" placeholder="Confirm new password">
                </div>
                <button type="submit">Change Password</button>
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
                if(isset($_SESSION['modal_message']) && $_SESSION['modal_heading'] == "Successful!"){
                    ?>
                    window.location.href = 'http://localhost/car/profile.php'; <?php
                }
                else{
                    ?>
                    window.location.href = 'http://localhost/car/profile.php'; <?php
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