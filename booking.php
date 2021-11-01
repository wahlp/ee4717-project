<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css"></link>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">   
    <title>Tan Family Clinic - Booking</title>
</head>
<body>
    <?php include 'php/common/header.php' ?>
    <div id="content">
        <div id="form-wrapper">
            <form action="php/create_booking.php" method="post" class="form-large form-booking">
                <h1>Appointment Details</h1>

                <div class="form-section-booking">
                    <label for="doctor">Choose a Doctor</label>
                    <select name="doctor" id="appt-doctor" onchange="setAppointmentTimes()">
                        <?php
                            // read query string to select default doctor name
                            $options = ['Jian Tan', 'Carrie Tan', 'Justin Tan'];
                            foreach ($options as $option) {
                                echo "<option value='$option'" . ($option == $_GET['doctor'] ? ' selected' : '') . ">$option</option>";
                            }
                        ?>
                    </select>
                    <br><br>

                    <label for="date">Choose a Date</label>
                    <!-- <input type="date" name="date" id=""> -->
                    <select name="date" id="appt-dates" onchange="setAppointmentTimes()">
                        <?php
                            $dates = new DatePeriod(
                                new DateTime('tomorrow'), // Start date of the period
                                new DateInterval('P1D'), // Define the intervals as Periods of 1 Day
                                7 // Apply the interval 7 times on top of the starting date
                            );
                            foreach ($dates as $date) {
                                $display_date = $date->format('d M (l)');
                                $proper_date = $date->format('Y-m-d');
                                echo "<option value=\"$proper_date\">$display_date</option>";
                            }
                        ?>
                    </select>
                    <!-- <br><br> -->

                    <!-- <label for="time">Choose a Time</label> -->
                    <select name="time" id="appt-times">
                        <option value="10:00:00">10:00</option>
                        <option value="11:00:00">11:00</option>
                        <option value="13:00:00">13:00</option>
                        <option value="14:00:00">14:00</option>
                        <option value="15:00:00">15:00</option>
                        <option value="16:00:00">16:00</option>
                        <option value="17:00:00">17:00</option>
                    </select>
                    <br><br>
                </div>

                <button type="submit">Book now!</button>
            </form>
        </div>
    </div>
    <?php include 'php/common/footer.php' ?>
    
    <script src="js/script.js"></script>
    <script>
        let data = <?php 
            // todo
            // make database query for future appointments of doctors
            // each doctor's existing future appointment prevents that timeslot from being chosen

            // simulating queried dates, replace with actual queried results when done
            // current day and day after will have some timeslots blocked
            $tdy = new DateTime('today');
            $tdy->add(new DateInterval('P2D'));
            $tmr = new DateTime('tomorrow');
            $banned_dates = array(
                $tdy->format('d-m') => ['15:00', '16:00'],
                $tmr->format('d-m') => ['15:00', '16:00', '17:00']
            );
            echo json_encode($banned_dates, JSON_HEX_TAG); 
        ?>;
        setAppointmentTimes();
    </script>
    <?php 
        // var_dump($banned_dates);
        // $banned_dates_fake = array(
        //     '17-10' => ['15:00'],
        //     '18-10' => ['15:00', '16:00']
        // );
        // var_dump($banned_dates_fake);
        // echo $banned_dates == $banned_dates_fake;
    ?>
</body>