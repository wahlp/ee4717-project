<?php //authmain.php
    include "db/dbconnect.php";
    session_start();
    
    if (isset($_POST['email']) && isset($_POST['password']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $password = md5($password);
        $query = 'select * from users '
                    ."where email='$email' "
                    ." and password='$password'";
        
        $result = $dbcnx->query($query);
        $row = $result->fetch_object();
        // var_dump($row);
        // echo $row->name;

        if ($result->num_rows >0 )
        {
            // if they are in the database register the user id
            $_SESSION['user_name'] = $row->name;
            $_SESSION['nric'] = $row->nric;
            $_SESSION['phone'] = $row->phone;
            $_SESSION['email'] = $row->email;
        }
        $dbcnx->close();
    }

    // todo: change this redirect
    // instead of redirecting from php file
    // let javascript request and determine login success
    // if login successful -> redirect, else reset form / notify user

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
    