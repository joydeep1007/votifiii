<?php
session_start();
include 'connection.php';

// Get form data
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$fathername = $_POST['fathername'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$pincode1 = $_POST['pincode1'];
$pincode2 = $_POST['pincode2'];
$aadhaar = $_POST['aadhaar'];
$pan = $_POST['pan'];
$voter_id = $_POST['voter'];
$number1 = $_POST['number1'];
$number2 = $_POST['number2'];
$email = $_POST['email'];
$password = $_POST['password'];

// Prevent SQL injection
$fname = mysqli_real_escape_string($conn, $fname);
$mname = mysqli_real_escape_string($conn, $mname);
$lname = mysqli_real_escape_string($conn, $lname);
$fathername = mysqli_real_escape_string($conn, $fathername);
$address1 = mysqli_real_escape_string($conn, $address1);
$address2 = mysqli_real_escape_string($conn, $address2);
$pincode1 = mysqli_real_escape_string($conn, $pincode1);
$pincode2 = mysqli_real_escape_string($conn, $pincode2);
$aadhaar = mysqli_real_escape_string($conn, $aadhaar);
$pan = mysqli_real_escape_string($conn, $pan);
$voter_id = mysqli_real_escape_string($conn, $voter_id);
$number1 = mysqli_real_escape_string($conn, $number1);
$number2 = mysqli_real_escape_string($conn, $number2);
$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user into database
$sql = "INSERT INTO voters (fname, mname, lname, fathername, address1, address2, pincode1, pincode2, aadhaar, pan, voter_id, number1, number2, email, password)
        VALUES ('$fname', '$mname', '$lname', '$fathername', '$address1', '$address2', '$pincode1', '$pincode2', '$aadhaar', '$pan', '$voter_id', '$number1', '$number2', '$email', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Registration successful!'); window.location.href='login.html';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>