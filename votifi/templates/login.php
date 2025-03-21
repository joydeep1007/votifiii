<?php
session_start();
include 'connection.php'; // Include the database connection file

// Get voter credentials from form
$voter_id = $_POST['voter_id'];
$password = $_POST['password'];

// Prevent SQL injection
$voter_id = mysqli_real_escape_string($conn, $voter_id);
$password = mysqli_real_escape_string($conn, $password);

// Verify voter credentials
$sql = "SELECT * FROM voters WHERE voter_id = '$voter_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Verify hashed password
    if (password_verify($password, $row['password'])) {
        $_SESSION['voter_id'] = $voter_id;
        header("Location: dashboard.php"); // Redirect to voting dashboard
        exit();
    } else {
        echo "<script>alert('Invalid Password!'); window.location.href='login.html';</script>";
    }
} else {
    echo "<script>alert('Invalid Voter ID!'); window.location.href='login.html';</script>";
}

$conn->close();
?>