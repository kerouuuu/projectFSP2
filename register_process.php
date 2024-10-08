<?php
include 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $profile = 'member';

    $check_query = "SELECT * FROM member WHERE username = ?";
    $check_stmt = $mysqli->prepare($check_query);
    $check_stmt->bind_param('s', $username);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo "username sudah digunakan, silahkan gunakan username lainnya";
    } else {
        // Insert the new member into the database
        $query = "INSERT INTO member (fname, lname, username, password, profile) VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('sssss', $fname, $lname, $username, $hashed_password, $profile);

        if ($stmt->execute()) {
            // Redirect to login page after successful registration
            echo "Registration successful! <a href='login.php'>Login here</a>";
        } else {
            // Handle insertion error
            echo "Error: " . $stmt->error;
        }
    }
}
?>
