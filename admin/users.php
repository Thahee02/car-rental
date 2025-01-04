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
    <title>Users | RentaCar</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include('../assets/components/menu.php'); ?>

    <section class="admin-users-banner">
        <h1>Users</h1>
        <div class="breadcrumb">Home / Admin / <span>Users</span></div>
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
            $filterName = $_GET['filter-name'] ?? '';
            $filterEmail = $_GET['filter-email'] ?? '';
            $filterNIC = $_GET['filter-nic'] ?? '';
            $filterPhone = $_GET['filter-phone'] ?? '';
            $filterRole = $_GET['filter-role'] ?? '';

            // SQL Query with filters
            $sql = "SELECT id, name, email, nic, phone, role FROM users WHERE 1=1";

            // Add filters to the SQL query
            if (!empty($filterName)) {
                $sql .= " AND name LIKE '%" . mysqli_real_escape_string($conn, $filterName) . "%'";
            }
            if (!empty($filterEmail)) {
                $sql .= " AND email LIKE '%" . mysqli_real_escape_string($conn, $filterEmail) . "%'";
            }
            if (!empty($filterNIC)) {
                $sql .= " AND nic LIKE '%" . mysqli_real_escape_string($conn, $filterNIC) . "%'";
            }
            if (!empty($filterPhone)) {
                $sql .= " AND phone LIKE '%" . mysqli_real_escape_string($conn, $filterPhone) . "%'";
            }
            if (!empty($filterRole)) {
                $sql .= " AND role = '" . mysqli_real_escape_string($conn, $filterRole) . "'";
            }

            // Execute the query
            $result = mysqli_query($conn, $sql);
            ?>

            <div class="admin-users-filter-section">
                <h4>Filter Users</h4>
                <form method="GET" action="">
                    <!-- Filter by Name -->
                    <div>
                        <label for="filter-name">Name:</label>
                        <input type="text" id="filter-name" name="filter-name" placeholder="Enter name" value="<?php echo htmlspecialchars($filterName); ?>">
                    </div>
                    
                    <!-- Filter by Email -->
                    <div>
                        <label for="filter-email">Email:</label>
                        <input type="email" id="filter-email" name="filter-email" placeholder="Enter email address" value="<?php echo htmlspecialchars($filterEmail); ?>">
                    </div>
                    
                    <!-- Filter by NIC -->
                    <div>
                        <label for="filter-nic">NIC:</label>
                        <input type="text" id="filter-nic" name="filter-nic" placeholder="Enter NIC number" value="<?php echo htmlspecialchars($filterNIC); ?>">
                    </div>
                    
                    <!-- Filter by Phone -->
                    <div>
                        <label for="filter-phone">Phone:</label>
                        <input type="tel" id="filter-phone" name="filter-phone" placeholder="Enter phone number" value="<?php echo htmlspecialchars($filterPhone); ?>">
                    </div>
                    
                    <!-- Filter by Role -->
                    <div>
                        <label for="filter-role">Role:</label>
                        <select id="filter-role" name="filter-role">
                            <option value="" disabled selected>-Select role-</option>
                            <option value="admin" <?php if ($filterRole === 'admin') echo 'selected'; ?>>Admin</option>
                            <option value="user" <?php if ($filterRole === 'user') echo 'selected'; ?>>User</option>
                        </select>
                    </div>
                    
                    <!-- Apply Filters Button -->
                    <button type="submit">Apply Filters</button>
                </form>
            </div>

            <div class="admin-users-display-section">
                <h4>Users</h4>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>NIC</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($user = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                        <td>{$user['id']}</td>
                                        <td>{$user['name']}</td>
                                        <td>{$user['email']}</td>
                                        <td>{$user['nic']}</td>
                                        <td>{$user['phone']}</td>
                                        <td>
                                            <!-- Role Update Form -->
                                            <form method='POST' action='../backend/log-reg/update_role.php' class='user-role-update-form' style='display:inline;'>
                                                <input type='hidden' name='user_id' value='{$user['id']}'>
                                                <select name='user_role' onchange='this.form.submit()'>
                                                    <option value='admin'" . ($user['role'] === 'admin' ? ' selected' : '') . ">Admin</option>
                                                    <option value='user'" . ($user['role'] === 'user' ? ' selected' : '') . ">User</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            <!-- Delete Button -->
                                            <form method='POST' action='../backend/log-reg/delete_user.php' class='delete-user-form' style='display:inline;' onsubmit='return confirmDelete();'>
                                                <input type='hidden' name='user_id' value='{$user['id']}'>
                                                <button type='submit' style='color:red;'>Delete</button>
                                            </form>
                                        </td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' style='text-align:center;'>No users found</td></tr>";
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
                    window.location.href = 'http://localhost/car/admin/users.php'; <?php
                }
                else{ ?>
                    window.location.href = 'http://localhost/car/admin/users.php'; <?php
                }
                                
                unset($_SESSION['modal_icon']);
                unset($_SESSION['modal_heading']);
                unset($_SESSION['modal_message']);

            ?>
        }

        // confirm message when delete user
        function confirmDelete() {
            var confirm = confirm("Are you sure you want to delete this user?")
            if (confirm) {
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