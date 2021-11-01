<?php
    include 'db/dbconnect.php';
    session_start();

    $params = array('name', 'nric', 'phone', 'email');
    $updated_fields = array();

    foreach ($params as $param) {
        if (isset($_POST[$param])) {
            // echo "received $param = $_POST[$param]". PHP_EOL;
            if ($_POST[$param] != '') {
                array_push($updated_fields, "$param = '$_POST[$param]'");
            }
        }
        // else {
        //     // echo "did not receive $param = $_POST[$param]" . PHP_EOL;
        // }
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
    
    // echo PHP_EOL . $_SESSION['nric'];
?>