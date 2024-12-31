<?php
// Start the session to store login information (if needed)
session_start();

if (isset($_SESSION['is_login'])) {
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
    <title>Login & Registration</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>

    <?php include('./assets/components/menu.php'); ?>
    <!-- Container for registration and login sections -->
    <div class="reg-log-container">

        <!-- User Login Section (Left Side) with Background -->
        <div class="reg-log-form-section login-form">
            <h2>User Login</h2>
            <form action="./backend/log-reg/login_process.php" method="POST">
                <label for="reg-log-user-email">Email:</label>
                <input type="email" id="reg-log-user-email" name="reg-log-user-email" required placeholder="Enter your email">

                <label for="reg-log-user-password">Password:</label>
                <input type="password" id="reg-log-user-password" name="reg-log-user-password" required placeholder="Enter your password">

                <button type="submit" name="reg-log-user-login">Login</button>
            </form>
        </div>

        <!-- User Registration Section (Right Side) -->
        <div class="reg-log-form-section registration-form">
            <h2>User Registration</h2>
            <form action="./backend/log-reg/register_process.php" method="POST">
                <label for="reg-log-reg-email">Email:</label>
                <input type="email" id="reg-log-reg-email" name="reg-log-reg-email" required placeholder="Enter your email...">

                <label for="reg-log-reg-password">Password:</label>
                <input type="password" id="reg-log-reg-password" name="reg-log-reg-password" required placeholder="Enter your password...">

                <label for="reg-log-reg-confirm-password">Confirm Password:</label>
                <input type="password" id="reg-log-reg-confirm-password" name="reg-log-reg-confirm-password" required placeholder="Confirm your password...">

                <button type="submit" name="reg-log-user-register">Register</button>
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
