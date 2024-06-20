<?php
session_start();

require '../koneksi_db.php';

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare and bind
$stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);

// Execute the statement
$stmt->execute();

// Store the result
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Bind result variables
    $stmt->bind_result($user_id, $hashed_password);
    $stmt->fetch();

    // Verify the password
    if (password_verify($password, $hashed_password)) {
        // Password is correct, start a new session
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        // Redirect to a protected page (change to your protected page)
        header("Location: ../admin/index.php");
        exit();
    } else {
        // Invalid password
        header("Location: ../login.php?error=1");
        exit();
    }
} else {
    // Invalid username
    header("Location: ../login.php?error=1");
    exit();
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
