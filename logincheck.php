<?php
// start session
session_start();

// connect to database using PDO
include 'connection.php';

// check if form submitted
if (isset($_POST['username']) && isset($_POST['password'])) {
    // get form data using $_POST superglobal
    $username = $_POST['username'];
    $password = $_POST['password'];

    // retrieve user from database using PDO
    $stmt = $conn->prepare('SELECT * FROM admins WHERE username = :username');
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // check if user exists and password is correct
    $has=password_hash($user['password'], PASSWORD_DEFAULT);
    if ($user && password_verify($password,$has)) {
        // login successful
        $_SESSION['username'] = $username;
        header('Location: adminhome.php');
        exit;
    } else {
        // login failed
        $error = 'Invalid username or password';
        header('Location: index.php');
    }
}

?>
