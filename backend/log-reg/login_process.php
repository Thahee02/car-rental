<?php

session_start(); // Start the session to store messages

include "../db.php";

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["reg-log-user-email"])) {
    // Retrieve and sanitize user inputs
    $email = trim($_POST["reg-log-user-email"]);
    $password = $_POST["reg-log-user-password"];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['modal_icon'] = "<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 24 24'><g fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'><path stroke-dasharray='64' stroke-dashoffset='64' d='M12 3c4.97 0 9 4.03 9 9c0 4.97 -4.03 9 -9 9c-4.97 0 -9 -4.03 -9 -9c0 -4.97 4.03 -9 9 -9Z'><animate fill='freeze' attributeName='stroke-dashoffset' dur='0.6s' values='64;0'/></path><path stroke-dasharray='8' stroke-dashoffset='8' d='M12 12l4 4M12 12l-4 -4M12 12l-4 4M12 12l4 -4'><animate fill='freeze' attributeName='stroke-dashoffset' begin='0.6s' dur='0.2s' values='8;0'/></path></g></svg>";
        $_SESSION['modal_heading'] = "Error!";
        $_SESSION['modal_message'] = "Invalid email format.";
        header("Location: http://localhost/car/login.php");
        exit();
    }

    // Check if the email exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $_SESSION['modal_icon'] = "<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 24 24'><g fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'><path stroke-dasharray='64' stroke-dashoffset='64' d='M12 3c4.97 0 9 4.03 9 9c0 4.97 -4.03 9 -9 9c-4.97 0 -9 -4.03 -9 -9c0 -4.97 4.03 -9 9 -9Z'><animate fill='freeze' attributeName='stroke-dashoffset' dur='0.6s' values='64;0'/></path><path stroke-dasharray='8' stroke-dashoffset='8' d='M12 12l4 4M12 12l-4 -4M12 12l-4 4M12 12l4 -4'><animate fill='freeze' attributeName='stroke-dashoffset' begin='0.6s' dur='0.2s' values='8;0'/></path></g></svg>";
        $_SESSION['modal_heading'] = "Error!";
        $_SESSION['modal_message'] = "Incorrect email.";
        header("Location: http://localhost/car/login.php");
        exit();
    }

    // Fetch the user data from the database
    $user = $result->fetch_assoc();

    // Verify password
    if ($password != $user['password']) {
        $_SESSION['modal_icon'] = "<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 24 24'><g fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'><path stroke-dasharray='64' stroke-dashoffset='64' d='M12 3c4.97 0 9 4.03 9 9c0 4.97 -4.03 9 -9 9c-4.97 0 -9 -4.03 -9 -9c0 -4.97 4.03 -9 9 -9Z'><animate fill='freeze' attributeName='stroke-dashoffset' dur='0.6s' values='64;0'/></path><path stroke-dasharray='8' stroke-dashoffset='8' d='M12 12l4 4M12 12l-4 -4M12 12l-4 4M12 12l4 -4'><animate fill='freeze' attributeName='stroke-dashoffset' begin='0.6s' dur='0.2s' values='8;0'/></path></g></svg>";
        $_SESSION['modal_heading'] = "Error!";
        $_SESSION['modal_message'] = "Incorrect password.";
        header("Location: http://localhost/car/login.php");
        exit();
    }

    // Successful login, store user session
    $_SESSION["is_login"] = true;
    $_SESSION["user_email"] = $user['email']; // Store email in session (for use in the logged-in page)

    $_SESSION['modal_icon'] = "<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 16 16'><g fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5'><path d='M14.25 8.75c-.5 2.5-2.385 4.854-5.03 5.38A6.25 6.25 0 0 1 3.373 3.798C5.187 1.8 8.25 1.25 10.75 2.25'/><path d='m5.75 7.75l2.5 2.5l6-6.5'/></g></svg>";
    $_SESSION['modal_heading'] = "Successful!";
    $_SESSION['modal_message'] = "Login successful. Welcome back!";
    header("Location: http://localhost/car/login.php"); // Redirect to the dashboard or home page
    exit();
} else {
    $_SESSION['modal_icon'] = "<svg id='modal-error' xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 24 24'><g fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'><path stroke-dasharray='64' stroke-dashoffset='64' d='M12 3c4.97 0 9 4.03 9 9c0 4.97 -4.03 9 -9 9c-4.97 0 -9 -4.03 -9 -9c0 -4.97 4.03 -9 9 -9Z'><animate fill='freeze' attributeName='stroke-dashoffset' dur='0.6s' values='64;0'/></path><path stroke-dasharray='8' stroke-dashoffset='8' d='M12 12l4 4M12 12l-4 -4M12 12l-4 4M12 12l4 -4'><animate fill='freeze' attributeName='stroke-dashoffset' begin='0.6s' dur='0.2s' values='8;0'/></path></g></svg>";
    $_SESSION['modal_heading'] = "Error!";
    $_SESSION['modal_message'] = "Invalid request.";
    header("Location: http://localhost/car/login.php");
}

// Close the database connection
$conn->close();

?>
