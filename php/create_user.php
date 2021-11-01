<?php
    include 'db/dbconnect.php';

    if (isset($_POST['submit'])) {
        if (empty($_POST['name']) || empty($_POST['email']) || 
            empty($_POST['password']) || empty($_POST['password2']) ) {
            echo "All records to be filled in";
            exit;
        }
    }
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($password != $password2) {
        echo "Sorry passwords do not match";
        exit;
    }

    // encrypt password using insecure hash :)
    $password = md5($password);

    $sql = "INSERT INTO users (name, email, password) 
            VALUES ('$name', '$email', '$password')";
    $result = $dbcnx->query($sql);

    // create full url with absolute path
    // fixes broken redirects in xampp due to subfolder paths
    $host_url = 'http://' . $_SERVER['HTTP_HOST']; 
    $subdir = dirname($_SERVER['PHP_SELF'], 2);
    if ($subdir == '\\') {
        $subdir = '';
    }
    
    // redirect user
    header('Location: ' . $host_url . $subdir . '/booking.php');
    exit;
    
?>