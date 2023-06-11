<?php
session_start(); 
if (isset($_SESSION['logged_in'])) { // if session logged_in is set run this code
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
    <title>Mordhub: Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
   <div class="section">

        <div class="form-section">

            <div class="title"> 
             <img src="Assets/Icons/hilt_icon.png" height="100%" width="75px"/> 
             <h1>MORDHUB</h1>
            </div>
            

            <h3> home to the <span style="color: #F2BD00;">mordhau</span> community</h3>
            
            



                <form class="inline" action="PHPOnly/authaccount.php" method="post" autocomplete="off">
                      <!-- use authaccount as action -->
                    <div class="input-form">
                        <input style="border: none;" class="input-field" type="text" name="username" id="username"
                            placeholder="Username" required />
                    </div>
                    <br>

                    <div class="input-form">
                        <input style="border: none;" class="input-field" type="password" name="password" id="password"
                            placeholder="Password" required />
                    </div>

                     <!-- links to other pages if you're looking to register or reset password -->
                    <p>Don't have an account? <a href="registration.php">Enlist</a></p>

                    <p>Forgot your Password? <a href="forgetpass.php">Reset</a></p>

                    
                    <div class="btn-group"> 


                    <input class="btn" type="submit" name="log" id="log" value="L O G I N">

                    </div>

                </form>

                
            <p id="error-msg">
                    <!-- element for displaying error messages, hidden if there are no messages -->
                    <span style="color: #F2BD00;">
                    <?php
                    if (isset($_SESSION["Error"])) { // if session tag for error is set
                        echo $_SESSION['Error']; // echo the value of error
                        unset($_SESSION['Error']); // immediately unset the tag so it doesn't show up after refreshing the page
                    } 
                    ?>
                    </span>
            </p>


                

        </div>
    </div>



        
    
</body>

</html>