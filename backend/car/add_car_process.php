<?php

session_start();

if (!isset($_SESSION['is_login']) || $_SESSION['user_role'] != 'admin') {
    header("Location: http://localhost/car/index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    include('../db.php');

    $car_number = mysqli_real_escape_string($conn, $_POST['car_number']);
    $car_model = mysqli_real_escape_string($conn, $_POST['car_model']);
    $speed = mysqli_real_escape_string($conn, $_POST['speed']);
    $mileage = mysqli_real_escape_string($conn, $_POST['mileage']);
    $seats = intval($_POST['seats']);
    $day_rent = floatval($_POST['day_rent']);
    $status = 'available';
    
    // Handle the image upload
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_folder = "../../assets/images/cars/" . $image;

    // Check if image file is uploaded and move it to the destination folder
    if (!empty($image)) {
        if (move_uploaded_file($image_tmp, $image_folder)) {
            // Insert car data into the database
            $sql = "INSERT INTO cars (car_number, car_modal, speed, mileage, seats, day_rent, status, image)
                    VALUES ('$car_number', '$car_model', '$speed', '$mileage', '$seats', '$day_rent', '$status', '$image')";
            
            if (mysqli_query($conn, $sql)) {
                $_SESSION['modal_message'] = "Car added successfully!";
                $_SESSION['modal_icon'] = "<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 16 16'><g fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5'><path d='M14.25 8.75c-.5 2.5-2.385 4.854-5.03 5.38A6.25 6.25 0 0 1 3.373 3.798C5.187 1.8 8.25 1.25 10.75 2.25'/><path d='m5.75 7.75l2.5 2.5l6-6.5'/></g></svg>!";
                $_SESSION['modal_heading'] = "Successful!";
            } else {
                $_SESSION['modal_icon'] = "<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 24 24'><g fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'><path stroke-dasharray='64' stroke-dashoffset='64' d='M12 3c4.97 0 9 4.03 9 9c0 4.97 -4.03 9 -9 9c-4.97 0 -9 -4.03 -9 -9c0 -4.97 4.03 -9 9 -9Z'><animate fill='freeze' attributeName='stroke-dashoffset' dur='0.6s' values='64;0'/></path><path stroke-dasharray='8' stroke-dashoffset='8' d='M12 12l4 4M12 12l-4 -4M12 12l-4 4M12 12l4 -4'><animate fill='freeze' attributeName='stroke-dashoffset' begin='0.6s' dur='0.2s' values='8;0'/></path></g></svg>";
                $_SESSION['modal_heading'] = "Error!";
                $_SESSION['modal_message'] = "Error: " . mysqli_error($conn);
            }
        } else {
            $_SESSION['modal_message'] = "Failed to upload image.";
            $_SESSION['modal_icon'] = "<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 24 24'><g fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'><path stroke-dasharray='64' stroke-dashoffset='64' d='M12 3c4.97 0 9 4.03 9 9c0 4.97 -4.03 9 -9 9c-4.97 0 -9 -4.03 -9 -9c0 -4.97 4.03 -9 9 -9Z'><animate fill='freeze' attributeName='stroke-dashoffset' dur='0.6s' values='64;0'/></path><path stroke-dasharray='8' stroke-dashoffset='8' d='M12 12l4 4M12 12l-4 -4M12 12l-4 4M12 12l4 -4'><animate fill='freeze' attributeName='stroke-dashoffset' begin='0.6s' dur='0.2s' values='8;0'/></path></g></svg>";
            $_SESSION['modal_heading'] = "Error!";
        }
    } else {
        $_SESSION['modal_message'] = "Please upload a car image.";
        $_SESSION['modal_icon'] = "<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 24 24'><g fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'><path stroke-dasharray='64' stroke-dashoffset='64' d='M12 3c4.97 0 9 4.03 9 9c0 4.97 -4.03 9 -9 9c-4.97 0 -9 -4.03 -9 -9c0 -4.97 4.03 -9 9 -9Z'><animate fill='freeze' attributeName='stroke-dashoffset' dur='0.6s' values='64;0'/></path><path stroke-dasharray='8' stroke-dashoffset='8' d='M12 12l4 4M12 12l-4 -4M12 12l-4 4M12 12l4 -4'><animate fill='freeze' attributeName='stroke-dashoffset' begin='0.6s' dur='0.2s' values='8;0'/></path></g></svg>";
        $_SESSION['modal_heading'] = "Error!";
    }

    // Redirect back to the form after submission
    header("Location: http://localhost/car/admin/cars.php");
    exit();
}
