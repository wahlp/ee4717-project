<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css"></link>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">   
    <title>Tan Family Clinic - Login</title>
</head>
<body>
    <?php include 'php/common/header.php' ?>
    <div id="content">
        <div id="form-wrapper">
            <form action="php/login_action.php" method="post" class="form-login">
                <h1>Login</h1>

                <label for="email">Email</label>
                <input type="email" name="email" pattern="^([\w\.-])+@([\w]+\.){1,3}([A-z]){2,3}$" required>
                <br><br>
                
                <label for="password">Password</label>
                <input type="password" name="password" required>
                <br><br>

                <div class="form-footer">
                    <button type="submit">Go</button>
                    <a href="">Forget password?</a>
                    <a href="new_account.php">Create account</a>
                </div>
            </form>
        </div>
    </div>
    <?php include 'php/common/footer.php' ?>
</body>