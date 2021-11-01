<?php //authmain.php
    include "db/dbconnect.php";
    session_start();
    
    if (isset($_POST['email']) && isset($_POST['password']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = md5($password); // basic hash

        // find user
        $query = 'select * from users '
                    ."where email='$email' "
                    ." and password='$password'";
        
        $result = $dbcnx->query($query);
        $row = $result->fetch_object();

        // create full url with absolute path
        // fixes broken redirects in xampp due to subfolder paths
        $host_url = 'http://' . $_SERVER['HTTP_HOST']; 
        $subdir = dirname($_SERVER['PHP_SELF'], 2);
        if ($subdir == '\\') {
            $subdir = '';
        }

        if ($result->num_rows >0 )
        {
            // user exists
            // save their db details to session vars
            $_SESSION['user_name'] = $row->name;
            $_SESSION['nric'] = $row->nric;
            $_SESSION['phone'] = $row->phone;
            $_SESSION['email'] = $row->email;

            // todo: change this redirect
            // instead of redirecting from php file
            // let javascript request and determine login success
            // if login successful -> redirect, else reset form / notify user
            
            // redirect user
            header('Location: ' . $host_url . $subdir . '/booking.php');
            exit;
        } else {
            header('Location: ' . $host_url . $subdir . '/login.php');
        }
        $dbcnx->close();
}
?>
    