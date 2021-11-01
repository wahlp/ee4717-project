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
                    <select name="date" id="appt-dates" onchange="setAppointmentTimes(data)">
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
        // passing variable from php to javascript
        const data = <?php include 'php/get_unavailable_timeslots.php' ?>;

        // for debugging
        // prints unavailable timeslots to console for easy reference to compare to actual removed timeslots
        for (const doctor in data) {
            console.log(`${doctor} is unavailable on these days`)
            for (const date in data[doctor]) {
                console.log(`${date} - ${JSON.stringify(data[doctor][date])}`)
            }
        }

        // in case the default option for timeslot is actually not available, we would need to remove it
        // so we need to run on page load
        setAppointmentTimes(data);
    </script>
</body>