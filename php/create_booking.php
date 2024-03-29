<?php
    include 'redirect.php'; 
    include 'db/dbconnect.php';
    session_start();

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
        $to      = 'f32ee@localhost';
        $subject = 'Tan Family Clinic - Booking for ' . $doctor_name;
        $message = 'Your booking has been set for ' . $appt_timeslot;
        $headers = 'From: f32ee@localhost' . "\r\n" .
            'Reply-To: f32ee@localhost' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers,'-ff32ee@localhost');
        // redirect user to view booking
        redirectTo('/view_booking.php');
    } else {
        redirectTo('/booking.php');
    }
?>