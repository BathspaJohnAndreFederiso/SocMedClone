<?php
if (!isset($_SESSION['logged_in'])) { // this will catch anyone trying to go to the personal user page without loggin in
    header('Location: index.php'); // redirect to logged_in page
    exit;
}

include 'PHPOnly/connect.php'; // this file will be used

$stmt = $conn->prepare('SELECT password, email, join_date, pfp FROM accounts WHERE id = ?');
// we will use the session id to retrieve the corresponding user data.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email, $join_date, $pfp);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Personal Profile</title>
  <link rel="stylesheet" href="css/profile.css">
  <link rel="stylesheet" href="css/editprofilemodal.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <!--
          <div class="update-pfp">
            <input type="file" class="pfp-upload" id="pfp-upload" name="pfp-upload">
            <input type="submit" class="pfp-submit" name="pfp-submit" id="pfp-submit" value="Update">
          </div>
  -->

  <div id="editModal" class="modal">
   
    <div class="edit-section">

      <div class="editform-section">

        <div class="title">
          <h1>edit profile</h1>
          <i class="fa fa-times-circle-o close" aria-hidden="true"></i>
        </div>
        
        <form action="PHPOnly/editaccountdetails.php" method="post" autocomplete="off">
           
          <div class="update-pfp input-form">
            <input type="file" class="pfp-upload" id="pfp-upload" name="pfp-upload">
          </div>

          <br>

          <div class="input-form">
            <input style="border: none;" class="input-field" type="text" name="username" id="username"
              placeholder="Username" />
          </div>

          <br>

          <div class="input-form">
            <input style="border: none;" class="input-field" type="email" name="email" id="email"
              placeholder="Email" />
          </div>

          <br>

          <p>Forgot your Password? <a href="forgetpass.php">Reset</a></p>

          <div class="btn-group">

            <input class="btn" type="submit" name="update" id="update" value="SAVE">

          </div>

        </form>
           <!---->
      </div>
    </div>

  </div>



  <div class="coms">


  </div>




  <div class="below">

    <div class="text-boxes">



      <div class="left">


        <div class="pfp">
          <img src="Assets/pfps/<?=$pfp?>" class="pfp" height="200px" width="200px" />

          <button id="editBtn" class="editBtn">
            <h3><span style='color: white;'>EDIT PROFILE</span></h3>
          </button>
        </div>

      </div>

      <div class="center">

        <div class="profile">

          <div class="user-info">

            <div class="username">

              <h1> <?=$_SESSION['name']?> </h1>

              <h3> <?=$email?></h3>

              <p> Joined: <?=$join_date?></p>


            </div>

            <div class="about">


              <p> About Me </p>
            </div>

          </div>




        </div>




      </div>



      <div class="right">


        <div class="comsbanner">

          <div class="options">

            <div>
              <a href="index.php">
                <h3><span style='color: white;'>TIMELINE</span></h3>
              </a>
            </div>


            <div>
              <a href="#">
                <h3><span style='color: red;'>PROFILE</span></h3>
              </a>
            </div>


            <div>
              <a href="logout.php">
                <h3><span style='color: white;'>LOG OUT</span></h3>
              </a>
            </div>

          </div>





        </div>

      </div>


    </div>






  </div>

  <script>
    // Get the modal
    var modal = document.getElementById("editModal");

    // Get the button that opens the modal
    var btn = document.getElementById("editBtn");
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function () {
      modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
      modal.style.display = "none";
    }

    // if the user clicks outside of the modal, close the modal
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>



</body>

</html>