<?php 
    // find existing appointments for each doctor
    // so we know which timeslots are not available for booking

    include 'db/dbconnect.php';
    
    // get all future appointments' timeslot and doctor 
    $query = "select d.name as doctor, a.appointment_time as time
        from appointments a
        inner join doctors d
        on a.doctor_id = d.id
        where a.appointment_time >= NOW()";
    $result = $dbcnx->query($query);
    
    // var to hold the unavailable timeslots
    $doc_schedule = array();

    while ($row = $result->fetch_assoc()) {
        // break timeslot string into two vars for date and time
        list($date, $time) = explode(' ', $row['time']);
        $time = substr($time, 0, -3); // remove the seconds part of the time string

        // populate a nested array with this format
        // doctor name (assoc array) > date (assoc array) > time
        $doc_schedule[$row['doctor']][$date][] = $time; 
    }

    echo json_encode($doc_schedule);
?>