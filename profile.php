<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css"></link>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">   
    <title>Tan Family Clinic - Profile</title>
</head>
<body>
    <?php include 'php/common/header.php' ?>
    <div id="content">
        <div id="form-wrapper">
            <form action="php/update_profile.php" method="post" class="form-large form-booking">
                <h1>My Details</h1>

                <div class="form-section-register">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" disabled 
                        value="<?php echo isset($_SESSION["user_name"]) ? $_SESSION["user_name"] : ''; ?>"
                    >
                    <br><br>

                    <label for="nric">NRIC/FIN</label>
                    <input type="text" name="nric" pattern="^[STFG]\d{7}[A-Z]$" id="nric" disabled 
                        value="<?php echo isset($_SESSION["nric"]) ? $_SESSION["nric"] : ''; ?>"
                    >
                    <br><br>

                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" pattern="\d{8}" id="phone" disabled 
                        value="<?php echo isset($_SESSION["phone"]) ? $_SESSION["phone"] : ''; ?>"
                    >
                    <br><br>

                    <label for="email">Email</label>
                    <input type="email" name="email" pattern="^([\w\.-])+@([\w]+\.){1,3}([A-z]){2,3}$" id="email" disabled 
                        value="<?php echo isset($_SESSION["email"]) ? $_SESSION["email"] : ''; ?>"
                    >
                    <br><br>
                </div>

                <button type="button" onclick="toggleProfileFields()">Update</button>
            </form>
        </div>
    </div>
    <?php include 'php/common/footer.php' ?>
    <script src="js/script.js"></script>
</body>