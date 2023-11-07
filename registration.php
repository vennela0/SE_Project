<?php
session_start();

// Establish a database connection
$con = mysqli_connect('localhost', 'root', );

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve user inputs from the form
mysqli_select_db($con,'igrowthlearning');
$name = $_POST['name'];
$pass = $_POST['password'];
$email = $_POST['email'];

// Check if the user already exists in the database
$query = "SELECT * FROM login WHERE username='$name'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    echo "Username already exists. Please choose a different one.";
    header('location: signup.html');
} else {
    // Insert the user's data into the database
    $insertQuery = "INSERT INTO login (username, password, email) VALUES ('$name', '$pass', '$email')";

    if (mysqli_query($con, $insertQuery)) {
        echo "Registration successful!";
        header('location: index.php');
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

// Close the database connection
mysqli_close($con);
?>
