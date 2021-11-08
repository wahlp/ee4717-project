<?php
    include 'redirect.php';
    include 'db/dbconnect.php';

    // check that all post request variables are valid
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

    // check that both password fields are the same
    if ($password != $password2) {
        echo "Sorry passwords do not match";
        exit;
    }

    // if we reached this point, the user has given valid details for account setup

    // basic password encryption
    $password = md5($password);

    $sql = "INSERT INTO users (name, email, password) 
            VALUES ('$name', '$email', '$password')";
    $result = $dbcnx->query($sql);

    // redirect user
    redirectTo('/login.php');
?>