<?php
$servername = "localhost";
$username = "mclaros1";
$password = "mclaros1";
$dbname = "mclaros1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmPassword'])){
        // Retrieve form data
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        // Check if password and confirm password match
        if($password !== $confirmPassword) {
            echo "Error: Passwords do not match.";
            exit();
        }

        // Check if the username already exists
        $check_username_sql = "SELECT * FROM user WHERE username='$username'";
        $check_username_result = $conn->query($check_username_sql);
        if ($check_username_result->num_rows > 0) {
            echo "Error: Username already exists.";
            exit();
        }

        // Insert data into 'user' table
        $sql = "INSERT INTO user (username, email, password) 
                VALUES ('$username', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "Record inserted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: All fields are required.";
    }
}

$conn->close();
?>

