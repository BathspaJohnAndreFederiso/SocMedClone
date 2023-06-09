<?php
//if (!isset($_SESSION['logged_in'])) {
//header('Location: login.php'); // redirect to logged_in page
//exit;
//}


include 'PHPOnly/connect.php'; // this file will be used


$stmt = $conn->prepare('SELECT pfp FROM accounts WHERE id = ?');
// we will use the session id to retrieve the corresponding user data.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute(); // execute the prepared statement using the binded parameter
$stmt->bind_result($pfp);
$stmt->fetch();
$stmt->close(); // bind to a variable, fetch then close

?>

<!DOCTYPE html>
<html lang="en">



<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mordhub: Home</title>
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

  <div class="coms">


  </div>

  <div class="below">

    <div class="text-boxes">


      <div class="left">


        <?php
        if (isset($_SESSION['logged_in'])) {
          echo '
           <div class="user">
           <img src="Assets/pfps/' . $pfp . '" height="100%" width="120px"/>  
           <div class="names">  
        
           <h1> ' . $_SESSION['name'] . ' </h1>
           <hr>
           <h3> ' . $_SESSION['email'] . ' </h3>
       
           </div>
           </div>';
        }

        ?>



        <div class="info">

          <h1> MORDHAU </h1>
          <hr>
          <p>

            MORDHAU is a medieval first & third person multiplayer slasher. Enter a hectic battlefield of up to 64
            players as a mercenary in a fictional, but realistic world, where you will get to experience the brutal and
            satisfying melee combat that will have you always coming back for more.

          </p>
        </div>

      </div>

      <div class="center">

        <div class="post">

          <div class="user-info">
            <img src="Assets/Icons/hilt_icon.png" class="pfp" height="100%" width="60px" />

            <div class="username">
             
                <h1> POST OWNER </h1>

                <p> postowner@email.com, 5 minutes ago</p>
            

            </div>


          </div>


          <div class="post-content">



            <div class="post-media">
              <img src="Assets/PostMedia/mordhau_banner.png" class="pfp" height="100%" width="100%" />
            </div>

            <div class="post-text">
              <p>
                Looking for duelyards. Any recs?
              </p>
            </div>

            <div class="post-options">

              <a class="reply-option" href="createpost.php"> REPLY </a>

              <a class="tag" style="background-color: #CB7A00; color: black;"> QUERY </a>


            </div>


          </div>


        </div>


        




      </div>



      <div class="right">


        <?php
        if (isset($_SESSION['logged_in'])) {
          echo '
                
          <a class="create-post" href="createpost.php"><h2>CREATE POST</h2></a>
    
         ';
        } ?>


        <div class="comsbanner">

          <div class="options">



            <?php
            if (isset($_SESSION['logged_in'])) {
              echo "
              <div>
              <a class='selected'>
                <h3><span style='color: #CB7A00;'>TIMELINE</span></h3>
              </a>
            </div>

          <div>
            <a href='userprofile.php'>
             <h3>PROFILE</h3>
            </a>
          </div>

          <div>
            <a href='PHPOnly/logout.php'>
             <h3>LOG OUT</h3>
            </a>
          </div>
         ";
            } else {

              echo "

              <div>
              <a class='selected'>
                <h3><span style='color: #CB7A00;'>TIMELINE</span></h3>
              </a>
            </div>

          
          <div>
            <a href='login.php'>
             <h3>LOG IN</h3>
            </a>
          </div>

      

          <div>
            <a href='registration.php'>
             <h3>REGISTER</h3>
            </a>
          </div>
         ";

            }
            ?>
          </div>

        </div>

      </div>


    </div>






  </div>



</body>

</html>