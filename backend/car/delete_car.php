<?php
// Start the session
session_start();

// Include database connection
include('../db.php');

// Check if the user is logged in and has the role of 'admin'
if (!isset($_SESSION['is_login']) || $_SESSION['user_role'] != 'admin') {
    header("Location: http://localhost/car/index.php");
    exit();
}

// Check if the car_number is set in the request
if (isset($_POST['car_number'])) {
    // Escape the car_number to prevent SQL injection
    $car_number = mysqli_real_escape_string($conn, $_POST['car_number']);

    // Delete the car from the database
    $sql = "DELETE FROM cars WHERE car_number = '$car_number'";

    if (mysqli_query($conn, $sql)) {
        // Set success message in session
        $_SESSION['modal_icon'] = "<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 16 16'><g fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5'><path d='M14.25 8.75c-.5 2.5-2.385 4.854-5.03 5.38A6.25 6.25 0 0 1 3.373 3.798C5.187 1.8 8.25 1.25 10.75 2.25'/><path d='m5.75 7.75l2.5 2.5l6-6.5'/></g></svg>!";
        $_SESSION['modal_heading'] = "Successful!";
        $_SESSION['modal_message'] = "Car with car number $car_number has been deleted successfully.";
        
        // Redirect back to the cars page
        header("Location: http://localhost/car/admin/cars.php");
    } else {
        // Set error message in session
        $_SESSION['modal_icon'] = "<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 24 24'><g fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'><path stroke-dasharray='64' stroke-dashoffset='64' d='M12 3c4.97 0 9 4.03 9 9c0 4.97 -4.03 9 -9 9c-4.97 0 -9 -4.03 -9 -9c0 -4.97 4.03 -9 9 -9Z'><animate fill='freeze' attributeName='stroke-dashoffset' dur='0.6s' values='64;0'/></path><path stroke-dasharray='8' stroke-dashoffset='8' d='M12 12l4 4M12 12l-4 -4M12 12l-4 4M12 12l4 -4'><animate fill='freeze' attributeName='stroke-dashoffset' begin='0.6s' dur='0.2s' values='8;0'/></path></g></svg>";
        $_SESSION['modal_heading'] = "Error!";
        $_SESSION['modal_message'] = "An error occurred while deleting the car. Please try again.";
        
        // Redirect back to the cars page
        header("Location: http://localhost/car/admin/cars.php");
    }

} else {
    // If car_number is not set, redirect to the cars page
    header("Location: http://localhost/car/admin/cars.php");
}

// Close the database connection
mysqli_close($conn);
?>
