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
        <div class="my-profile-section">
            <h3>Personal Information</h3>
            <div class="my-profile-form-group">
                <label for="name">Name</label>
                <input type="text" id="name" placeholder="John Doe">
            </div>
            <div class="my-profile-form-group">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="johndoe@example.com">
            </div>
            <div class="my-profile-form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" placeholder="123-456-7890">
            </div>
            <div class="my-profile-button-group">
                <button id="save-info">Save</button>
                <button id="cancel-info">Cancel</button>
            </div>
        </div>

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

    <?php include('./assets/components/footer.php'); ?>
    <script src="./assets/js/script.js"></script>
</body>
</html>