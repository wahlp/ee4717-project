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

    // check if the query actually deleted any row
    // if not, we should not update the table in javascript
    // this value will tell the js how to decide what to do
    echo $result->affected_rows;

    // unlikely this actually matters since we control the way appt_date appears in html
    // but it might help us avoid more bugs in future
?>