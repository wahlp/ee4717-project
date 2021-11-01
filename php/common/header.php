<header>
    <div id="logo">
        <svg width="205" height="60">
            <circle cx="30" cy="30" r="25" fill="#ee4717" stroke="black" stroke-width="5" />
            <polygon points="100,5 129,55 71,55" style="fill:#ee4717;stroke:black;stroke-width:5" />
            <rect x="150" y="5" width="50" height="50" fill="#ee4717" stroke="black" stroke-width="5"></rect>
        </svg>
    </div>
    <div id="nav">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="doctors.php">Our Doctors</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="booking.php">Booking</a></li>
            <li id="login-btn">
                <?php
                    session_start();
                    if (isset($_SESSION['user_name'])) {
                        // echo '<a href="logout.php">Logout</a>';
                        echo '
                        <div class="dropdown">
                            <a href="profile.php" class="dropbtn">Profile</a>
                            <div class="dropdown-content">
                                <a href="view_booking.php">My Booking</a>
                                <a href="logout.php">Logout</a>
                            </div>
                        </div>
                        ';
                    }
                    else {
                        echo '<a href="login.php">Login</a>';
                    }
                ?>
            </li>
        </ul>
    </div>
</header>