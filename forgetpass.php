<?php
session_start();

?>

<!-- This is the html -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="section">

        <div class="form-section">

            <div class="title">
                <img src="Assets/Icons/hilt_icon.png" height="100%" width="75px" />
                <h1>MORDHUB</h1>
            </div>
            <h3> home to the <span style="color: #F2BD00;">mordhau</span> community</h3>

            <form class="inline" action="PHPOnly/forgetpassword.php" method="post" autocomplete="off">

                <div class="input-form">
                    <input style="border: none;" class="input-field" type="text" name="email" id="email"
                        placeholder="Email" required />
                </div>
                <br>

                <div class="input-form">
                    <input style="border: none;" class="input-field" type="password" name="password1" id="password1"
                        placeholder="New Password" required />
                </div>

                <br>

                <div class="input-form">
                    <input style="border: none;" class="input-field" type="password" name="password2" id="password2"
                        placeholder="Confirm Password" required />
                </div>

                <?php
                if (isset($_SESSION['logged_in'])) {
                    echo '
                      <p><a href="index.php">Return to the Site</a></p>
                    ';
                } else {
                    echo '
                     <p><a href="login.php">Return to Login</a></p>

                     <p><a href="registration.php">Return to Registration</a></p>
                    ';

                }
                ?>


                <div class="btn-group">


                    <input class="btn" type="submit" name="reset" id="reset" value=" R E S E T ">

                </div>

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




        </div>
    </div>





</body>

</html>