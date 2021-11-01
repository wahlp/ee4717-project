<?php
    // var_dump($_POST);
    // exit;

    include 'db/dbconnect.php';
    session_start();

    $user_email = $_SESSION['email'];
    $doctor_name = $_POST['doctor'];
    $appt_date = $_POST['date'];
    $appt_time = $_POST['time'];

    $appt_timeslot = "$appt_date $appt_time";
    
    // create new appt entry with user id, doctor id, and time
    $query = "insert into appointments (user_id, doctor_id, appointment_time)
        select u.id, d.id, '$appt_timeslot'
        from users u, doctors d
        where u.email = '$user_email'
        and d.name = '$doctor_name'";
    // echo $query;

    $result = $dbcnx->query($query);
    echo $result;
?>