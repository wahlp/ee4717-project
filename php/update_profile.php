<?php
    include 'db/dbconnect.php';
    session_start();

    $params = array('name', 'nric', 'phone', 'email');
    $updated_fields = array();

    // iterate over profile details
    foreach ($params as $param) {
        // whichever that are requested to change
        if (isset($_POST[$param])) {
            if ($_POST[$param] != '') {
                // format them for sql query
                array_push($updated_fields, "$param = '$_POST[$param]'");
            }
        }
    }

    // update database 
    $query = 
        "update users set " . implode(', ', $updated_fields) . 
        " where email = '" . $_POST['email'] . "'";

    $result = $dbcnx->query($query);
    echo $result;

    // update session vars
    foreach($params as $param) {
        $_SESSION[$param] = $_POST[$param];
    }
?>