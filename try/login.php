<?php
session_start();

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

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the values submitted via the form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Perform basic email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
    } else {
        // Email is valid, proceed with database validation
        // Prepare and execute SQL statement to fetch user record
        $stmt = $conn->prepare("SELECT email, password FROM login WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user with given email exists
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Verify password
            if (password_verify($password, $row['password'])) {
                // Password is correct, set session and redirect to home page
                $_SESSION['email'] = $email;
                header("Location: home.html");
                exit();
            } else {
                // Password is incorrect
                echo "Incorrect password";
            }
        } else {
            // User with given email doesn't exist
            echo "User not found";
        }
    }
} else {
    // Redirect the user back to the login page if they try to access this page directly without submitting the form
    header("Location: home.html");
    exit;
}

$conn->close();
?>
