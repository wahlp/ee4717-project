<?php
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

    $result = $dbcnx->query($query);
    echo $result;
?>