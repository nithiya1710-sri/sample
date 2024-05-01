<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "login";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve input data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insert user data into the database
    $sql = "INSERT INTO login (email, password) VALUES ('$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['email'] = $email;
        header("Location: home.html"); // Redirect to home page
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
