<?php

session_start(); // Start the session to store messages
include "../db.php"; // Include database connection file

// Function to set modal data
function setModalData($icon, $heading, $message) {
    $_SESSION['modal_icon'] = $icon;
    $_SESSION['modal_heading'] = $heading;
    $_SESSION['modal_message'] = $message;
    header("Location: http://localhost/car/profile.php");
    exit();
}

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve and sanitize user inputs
    $name = mysqli_real_escape_string($conn, trim($_POST["userName"]));
    $phone = mysqli_real_escape_string($conn, trim($_POST["userPhone"]));
    $nic = mysqli_real_escape_string($conn, trim($_POST["userNIC"]));

    // Assuming `user_email` is stored in session after login
    $userEmail = mysqli_real_escape_string($conn, $_SESSION['user_email']);

    // Update user data in the database
    $sql = "UPDATE users SET name = '$name', phone = '$phone', nic = '$nic' WHERE email = '$userEmail'";
    
    if (mysqli_query($conn, $sql)) {
        setModalData("<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 16 16'><g fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5'><path d='M14.25 8.75c-.5 2.5-2.385 4.854-5.03 5.38A6.25 6.25 0 0 1 3.373 3.798C5.187 1.8 8.25 1.25 10.75 2.25'/><path d='m5.75 7.75l2.5 2.5l6-6.5'/></g></svg>", "Successful!", "Profile updated successfully.");
        header("Location: http://localhost/car/profile.php");
    } else {
        error_log("Database error: " . mysqli_error($conn));
        setModalData("<svg>Your error SVG</svg>", "Error!", "An error occurred while updating the profile.");
    }
} else {
    setModalData("<svg>Your error SVG</svg>", "Error!", "Invalid request.");
}

// Close the database connection
mysqli_close($conn);

?>