<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css"></link>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">   
    <title>Tan Family Clinic - View Bookings</title>
</head>
<body>
    <?php include 'php/common/header.php' ?>
    <?php 
        include 'php/db/get_appt.php';
        $res = get_appointments($_SESSION['email']);

        // filter appointments by dates
        // so we can display future/past appointments separately
        // var_dump($res);
        $future_appts = array_filter($res, function ($element) {
            $date_now = time();
            $appt_date = strtotime($element['appt_time']);
            return $appt_date > $date_now;
        });

        // ignore dumb array to string conversion warnings
        @$past_appts = array_diff_assoc($res, $future_appts);

        // var_dump($future_appts);
        // var_dump($past_appts);
    ?>
    <div id="content">
        <div class="appt-table-container">
            <h1>Upcoming</h1>
            <table class="appt-table appt-upcoming">
                <thead>
                    <tr class="future-appt">
                        <th>Appointment Time</th>
                        <th>Doctor</th>
                        <th>Change Details</th>
                        <th>Cancel</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($future_appts as $appt)
                    echo "
                        <tr class='future-appt'>
                            <td>" . $appt['appt_time'] . "</td>
                            <td>" . $appt['doc_name'] . "</td>
                            <td><button>Change</button></td>
                            <td><button>Cancel</button></td>
                        </tr>
                        ";
                    ?>
                </tbody>
            </table>

            <h1>Previous</h1>
            <table class="appt-table appt-previous">
                <thead>
                    <tr>
                        <th>Appointment Time</th>
                        <th>Doctor</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($past_appts as $appt)
                    echo "
                        <tr>
                            <td>" . $appt['appt_time'] . "</td>
                            <td>" . $appt['doc_name'] . "</td>
                            <td>" . $appt['appt_details'] . "</td>
                        </tr>
                        ";
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include 'php/common/footer.php' ?>
</body>