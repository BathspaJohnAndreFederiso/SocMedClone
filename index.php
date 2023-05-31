<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    header('Location: ../index.php'); // redirect to index page
    exit;
}

?>

<!-- This is the html -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mordhub: Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
   <div class="section">

        <div class="form-section">

            <h1>Mordhub</h1>
            <h3> Home To <span style="color: #F2BD00;">Mordhau</span>, <span style="color: #0F4DEC;">Chivalry</span>, <span style="color: #EC002A;">For Honor</span> and More</h3>

                <form class="inline" action="PHPOnly/authaccount.php" method="post" autocomplete="off">

                    <div class="input-form">
                        <i class="fa fa-user icon"></i>
                        <input style="border: none;" class="input-field" type="text" name="username" id="username"
                            placeholder="Username" required />
                    </div>
                    <br>

                    <div class="input-form">
                        <i class="fa fa-lock icon"></i>
                        <input style="border: none;" class="input-field" type="password" name="password" id="password"
                            placeholder="Password" required />
                    </div>

                    <input class="btn" type="submit" name="log" id="log" value="L O G I N">

                </form>

                <p id="error-msg">
                    <!-- element for displaying error messages, hidden if there are no messages -->
                    <?php

                    if (isset($_SESSION["Error"])) { // if session tag for error is set
                        echo $_SESSION['Error']; // echo the value of error
                        unset($_SESSION['Error']); // immediately unset the tag so it doesn't show up after refreshing the page
                    } 
                    ?>
                </p>

                <p>Don't have an account? <a href="Register.php">Enlist</a></p>

                <p>Forgot your Password? <a href="ForgetPass.php">Reset</a></p>

                

        </div>
    </div>



        
    
</body>

</html>