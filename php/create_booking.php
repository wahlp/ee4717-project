<?php
    include 'redirect.php'; 
    include 'db/dbconnect.php';
    session_start();

    // create full url with absolute path
    // fixes broken redirects in xampp due to subfolder paths
    $host_url = 'http://' . $_SERVER['HTTP_HOST']; 
    $subdir = dirname($_SERVER['PHP_SELF'], 2);
    if ($subdir == '\\') {
        $subdir = '';
    }

    if (!isset($_SESSION['email'])) {
        // user is not logged in
        // they do not have permission to create booking
        redirectTo('/login.php');
    }

    $user_email = $_SESSION['email'];
    $doctor_name = $_POST['doctor'];
    $appt_date = $_POST['date'];
    $appt_time = $_POST['time'];

    // format string for mysql datetime type
    $appt_timeslot = "$appt_date $appt_time";
    
    // create new appt entry with user id, doctor id, and time
    // use user's email to find user's id
    // use doctor's name to find doctor's id
    $query = "insert into appointments (user_id, doctor_id, appointment_time)
        select u.id, d.id, '$appt_timeslot'
        from users u, doctors d
        where u.email = '$user_email'
        and d.name = '$doctor_name'";

    $result = $dbcnx->query($query);

    if ($result) {
        // appointment successfully created
        // redirect user to view booking
        redirectTo('/view_booking.php');
    } else {
        redirectTo('/booking.php');
    }
?>