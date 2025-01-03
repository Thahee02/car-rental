<?php
// Start the session
session_start();

// Check if the user is logged in, if not, redirect to login.php
if (!isset($_SESSION['is_login'])) {
    setModalData("<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 24 24'><g fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'><path stroke-dasharray='64' stroke-dashoffset='64' d='M12 3c4.97 0 9 4.03 9 9c0 4.97 -4.03 9 -9 9c-4.97 0 -9 -4.03 -9 -9c0 -4.97 4.03 -9 9 -9Z'><animate fill='freeze' attributeName='stroke-dashoffset' dur='0.6s' values='64;0'/></path><path stroke-dasharray='8' stroke-dashoffset='8' d='M12 12l4 4M12 12l-4 -4M12 12l-4 4M12 12l4 -4'><animate fill='freeze' attributeName='stroke-dashoffset' begin='0.6s' dur='0.2s' values='8;0'/></path></g></svg>", "Error!", "Please login before the rent a car.");
    header("Location: http://localhost/car/login.php");
    exit();
}

// Function to set modal data
function setModalData($icon, $heading, $message) {
    $_SESSION['modal_icon'] = $icon;
    $_SESSION['modal_heading'] = $heading;
    $_SESSION['modal_message'] = $message;
    header("Location: http://localhost/car/rentacar.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate form data
    $userEmail = htmlspecialchars(trim($_SESSION['user_email']));
    $bookedDate = date('Y-m-d H:i:s'); // Current timestamp
    $cName = htmlspecialchars(trim($_POST['full-name']));
    $cPhone = htmlspecialchars(trim($_POST['phone']));
    $cEmail = htmlspecialchars(trim($_POST['email']));
    $cAddress = htmlspecialchars(trim($_POST['address']));
    $cNic = htmlspecialchars(trim($_POST['id']));
    $carName = htmlspecialchars(trim($_POST['car']));
    $startDate = htmlspecialchars(trim($_POST['rental-period-start']));
    $endDate = htmlspecialchars(trim($_POST['rental-period-end']));
    $pLocation = htmlspecialchars(trim($_POST['pickup-location']));
    $dLocation = htmlspecialchars(trim($_POST['dropoff-location']));
    $licenseNo = htmlspecialchars(trim($_POST['license-number']));
    $country = htmlspecialchars(trim($_POST['issuing-authority']));
    $expDate = htmlspecialchars(trim($_POST['expiration-date']));
    $payMethod = htmlspecialchars(trim($_POST['payment-method']));
    $card = isset($_POST['card-type']) ? htmlspecialchars(trim($_POST['card-type'])) : '';
    $cardNo = isset($_POST['card-number']) ? htmlspecialchars(trim($_POST['card-number'])) : '';
    $cvv = isset($_POST['cvv-number']) ? htmlspecialchars(trim($_POST['cvv-number'])) : '';
    $amount = htmlspecialchars(trim($_POST['security-deposit'])); // Example: Security deposit
    $billAddress = htmlspecialchars(trim($_POST['billing-address']));
    
    // Validate required fields
    if (empty($cName) || empty($cPhone) || empty($cEmail) || empty($cAddress) || empty($cNic) || empty($carName) ||
        empty($startDate) || empty($endDate) || empty($pLocation) || empty($dLocation) || empty($licenseNo) || empty($country) || 
        empty($expDate) || empty($payMethod) || empty($amount) || empty($billAddress)) {
        echo "<p>All fields are required. Please fill in all the information.</p>";
        exit;
    }

    // Check if rental start date is before end date
    if (strtotime($startDate) > strtotime($endDate)) {
        setModalData("<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 24 24'><g fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'><path stroke-dasharray='64' stroke-dashoffset='64' d='M12 3c4.97 0 9 4.03 9 9c0 4.97 -4.03 9 -9 9c-4.97 0 -9 -4.03 -9 -9c0 -4.97 4.03 -9 9 -9Z'><animate fill='freeze' attributeName='stroke-dashoffset' dur='0.6s' values='64;0'/></path><path stroke-dasharray='8' stroke-dashoffset='8' d='M12 12l4 4M12 12l-4 -4M12 12l-4 4M12 12l4 -4'><animate fill='freeze' attributeName='stroke-dashoffset' begin='0.6s' dur='0.2s' values='8;0'/></path></g></svg>", "Error!", "Rental start date cannot be later than end date.");
        exit;
    }

    // Optional: Add additional validation for card payment (if selected)
    if (($payMethod == 'credit-card' || $payMethod == 'debit-card') && empty($cardNo)) {
        setModalData("<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 24 24'><g fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'><path stroke-dasharray='64' stroke-dashoffset='64' d='M12 3c4.97 0 9 4.03 9 9c0 4.97 -4.03 9 -9 9c-4.97 0 -9 -4.03 -9 -9c0 -4.97 4.03 -9 9 -9Z'><animate fill='freeze' attributeName='stroke-dashoffset' dur='0.6s' values='64;0'/></path><path stroke-dasharray='8' stroke-dashoffset='8' d='M12 12l4 4M12 12l-4 -4M12 12l-4 4M12 12l4 -4'><animate fill='freeze' attributeName='stroke-dashoffset' begin='0.6s' dur='0.2s' values='8;0'/></path></g></svg>", "Error!", "Card number is required for credit or debit card payments.");
        exit;
    }

    if (($payMethod == 'credit-card' || $payMethod == 'debit-card') && empty($cvv)) {
        setModalData("<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 24 24'><g fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'><path stroke-dasharray='64' stroke-dashoffset='64' d='M12 3c4.97 0 9 4.03 9 9c0 4.97 -4.03 9 -9 9c-4.97 0 -9 -4.03 -9 -9c0 -4.97 4.03 -9 9 -9Z'><animate fill='freeze' attributeName='stroke-dashoffset' dur='0.6s' values='64;0'/></path><path stroke-dasharray='8' stroke-dashoffset='8' d='M12 12l4 4M12 12l-4 -4M12 12l-4 4M12 12l4 -4'><animate fill='freeze' attributeName='stroke-dashoffset' begin='0.6s' dur='0.2s' values='8;0'/></path></g></svg>", "Error!", "CVV number is required for card payments.");
        exit;
    }

    include "../db.php"; // Include database connection file

    // Connect to the database
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL query using mysqli_query
    $sql = "INSERT INTO rents (user_email, booked_date, c_name, c_phone, c_email, c_address, c_nic, car_name, start_date, end_date, 
    p_location, d_location, license_no, country, exp_date, pay_method, card, card_no, cvv, amount, bill_address) 
    VALUES ('$userEmail', '$bookedDate', '$cName', '$cPhone', '$cEmail', '$cAddress', '$cNic', '$carName', '$startDate', '$endDate', 
    '$pLocation', '$dLocation', '$licenseNo', '$country', '$expDate', '$payMethod', '$card', '$cardNo', '$cvv', '$amount', '$billAddress')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        setModalData("<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 16 16'><g fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5'><path d='M14.25 8.75c-.5 2.5-2.385 4.854-5.03 5.38A6.25 6.25 0 0 1 3.373 3.798C5.187 1.8 8.25 1.25 10.75 2.25'/><path d='m5.75 7.75l2.5 2.5l6-6.5'/></g></svg>", "Successful!", "Thank you for booking with us!");
    } else {
        setModalData("<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 24 24'><g fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'><path stroke-dasharray='64' stroke-dashoffset='64' d='M12 3c4.97 0 9 4.03 9 9c0 4.97 -4.03 9 -9 9c-4.97 0 -9 -4.03 -9 -9c0 -4.97 4.03 -9 9 -9Z'><animate fill='freeze' attributeName='stroke-dashoffset' dur='0.6s' values='64;0'/></path><path stroke-dasharray='8' stroke-dashoffset='8' d='M12 12l4 4M12 12l-4 -4M12 12l-4 4M12 12l4 -4'><animate fill='freeze' attributeName='stroke-dashoffset' begin='0.6s' dur='0.2s' values='8;0'/></path></g></svg>", "Error!", mysqli_error($conn));
    }

    // Close the connection
    mysqli_close($conn);
} else {
    setModalData("<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 24 24'><g fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'><path stroke-dasharray='64' stroke-dashoffset='64' d='M12 3c4.97 0 9 4.03 9 9c0 4.97 -4.03 9 -9 9c-4.97 0 -9 -4.03 -9 -9c0 -4.97 4.03 -9 9 -9Z'><animate fill='freeze' attributeName='stroke-dashoffset' dur='0.6s' values='64;0'/></path><path stroke-dasharray='8' stroke-dashoffset='8' d='M12 12l4 4M12 12l-4 -4M12 12l-4 4M12 12l4 -4'><animate fill='freeze' attributeName='stroke-dashoffset' begin='0.6s' dur='0.2s' values='8;0'/></path></g></svg>", "Error!", "Invalid request method. Please submit the form.");
}
?>
