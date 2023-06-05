<?php
session_start();
if (isset($_SESSION['logged_in'])) {
    header('Location: index.php'); // redirect to index page
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
    <title>Mordhub: Register</title>
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
   <div class="section">

        <div class="form-section">

            <div class="title"> 
             <h1>ENLIST</h1>
            </div>
                <form class="inline" action="PHPOnly/regaccount.php" method="post" autocomplete="off">

                    <div class="input-form">
                        <input style="border: none;" class="input-field" type="text" name="username" id="username"
                            placeholder="Username" required />
                    </div>
                    <br>

                    <div class="input-form">
                        <input style="border: none;" class="input-field" type="text" name="email" id="email"
                            placeholder="Email" required />
                    </div>
                    <br>

                    <div class="input-form">
                        <input style="border: none;" class="input-field" type="password" name="password1" id="password1"
                            placeholder="Password" required />
                    </div>
                    <br>

                    <div class="input-form">
                        <input style="border: none;" class="input-field" type="password" name="password2" id="password2"
                            placeholder="Confirm" required />
                    </div>
                    <br>

                    
                    <p><a href="login.php">Return to Login</a></p>

                    <div class="btn-group"> 

                     <input class="btn" type="submit" name="log" id="log" value="Confirm">

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