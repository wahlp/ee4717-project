<?php
    // var_dump($_POST);
    
    include 'db/dbconnect.php';
    session_start();

    $user_email = $_SESSION['email'];
    $appt_time = $_POST['time'];
    
    // delete the appointment matching by user email and appointment time
    $query = "delete a from appointments a
        inner join users 
        on users.id = a.user_id
        where users.email = '$user_email'
        and a.appointment_time = '$appt_time'";

    // echo $query;
    $result = $dbcnx->query($query);

    echo $result;
    // // create full url with absolute path
    // // fixes broken redirects in xampp due to subfolder paths
    // $host_url = 'http://' . $_SERVER['HTTP_HOST']; 
    // $subdir = dirname($_SERVER['PHP_SELF'], 2);
    // if ($subdir == '\\') {
    //     $subdir = '';
    // }

    // // refresh page
    // header('Location: ' . $host_url . $subdir . '/view_booking.php');
    // exit;
?>