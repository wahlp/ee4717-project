<?php
    include 'dbconnect.php';

    function get_appointments($email){
        global $dbcnx;

        // knowing user's email, find user's profile id
        // match this profile id with user_id in appointments table to get name of user
        // also match doctors table id with doctor_id to get name of doctor
        $query = "
            select
                appointment_time as appt_time, 
                appointment_details as appt_details, 
                doctors.name as doc_name
            from appointments as A
            inner join users 
            on users.id = A.user_id
            inner join doctors
            on doctors.id = A.doctor_id
            where users.email = '" . $email . "'
        ";
        
        $result = $dbcnx->query($query);
        
        // format to assoc array and return
        return $result->fetch_all(MYSQLI_ASSOC);
    }
?>