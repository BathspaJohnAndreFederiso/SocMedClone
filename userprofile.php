<?php

include 'PHPOnly/connect.php'; // this file will be used

if (!isset($_SESSION['logged_in'])) { // this will catch anyone trying to go to the personal user page without loggin in
  header('Location: index.php'); // redirect to logged_in page
  exit;
}

$stmt = $conn->prepare('SELECT email, username, join_date, pfp, bio FROM accounts WHERE id = ?');
// we will use the session id to retrieve the corresponding user data.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($email, $username, $join_date, $pfp, $bio);
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
        <hr>
        <div class="title">

          <h1>edit profile</h1>
          <i class="fa fa-times-circle-o close" aria-hidden="true"></i>

        </div>


        <form action="PHPOnly/updateaccount.php" enctype="multipart/form-data" method="post" autocomplete="off">

          <!-- 
          <div class="update-pfp input-form">
            <input type="file" class="pfp-upload" id="pfp-upload" name="pfp-upload">
          </div>
         -->
          <div class="update-pfp input-form">
            <input type="file" class="pfp-upload" id="pfp-upload" name="pfp-upload" required />
          </div>

          <br>

          <div class="input-form">
            <input style="border: none;" class="input-field" type="text" name="username" id="username"
              placeholder="<?= htmlspecialchars($username) ?>" required />
          </div>

          <br>

          <div class="input-form">
            <input style="border: none;" class="input-field" type="email" name="email" id="email"
              placeholder="<?= htmlspecialchars($email) ?>" required />
          </div>

          <br>

          <p id="error-msg">
            <!-- element for displaying error messages, hidden if there are no messages -->
            <?php
            if (isset($_SESSION["Error"])) { // if session tag for error is set
              echo $_SESSION['Error']; // echo the value of error
              unset($_SESSION['Error']); // immediately unset the tag so it doesn't show up after refreshing the page
            }
            ?>
          </p>

          <p>Forgot your Password? <a href="forgetpass.php">Reset</a></p>

          <p>Want to delete your account? <a href="PHPOnly/deleteaccount.php">Delete</a></p>

          <div class="btn-group">

            <input class="btn" type="submit" name="update" id="update" value="UPDATE">

          </div>

        </form>
        <!---->

      </div>

    </div>

  </div>


  <div id="editModal2" class="modal-bio">

    <div class="bio-area">
      <form action="PHPOnly/setbio.php" method="post">

        <div class="bio-title">
          <h1>Edit Bio</h1>
          <i class="fa fa-times-circle-o close2" aria-hidden="true"></i>
        </div>

        <textarea id="userBio" name="userBio" rows="4" cols="50" maxlength="200" placeholder="<?= $bio ?>"></textarea>


        <p id="error-msg">
          <!-- element for displaying error messages, hidden if there are no messages -->
          <?php
          if (isset($_SESSION["Error"])) { // if session tag for error is set
            echo $_SESSION['Error']; // echo the value of error
            unset($_SESSION['Error']); // immediately unset the tag so it doesn't show up after refreshing the page
          }
          ?>
        </p>

        <input class="bio-btn" type="submit" name="save" id="save" value="SAVE">

      </form>
    </div>

  </div>



  <div class="coms">


  </div>




  <div class="below">

    <div class="text-boxes">



      <div class="left">


        <div class="pfp">
          <img src="Assets/pfps/<?= $pfp ?>" class="pfp" height="200px" width="200px" />

          <button id="editBtn" class="editBtn">
            <h3><span style='color: white;'>EDIT PROFILE</span></h3>
          </button>
        </div>

      </div>

      <div class="center">

        <div class="profile">

          <div class="user-info">

            <div class="username">

              <h1>
                <?= htmlspecialchars($username) ?>
              </h1>

              <h3>
                <?= htmlspecialchars($email) ?>
              </h3>

              <p> Joined:
                <?= $join_date ?>
              </p>

              <hr>
            </div>


            <div class="about">


              <h4> About Me</h4>
              <div class="bio">
                <p>
                  <?= htmlspecialchars($bio) ?>
                <p>
              </div>

              <button id="editBio" class="editBio">
                <h3><span style='color: white;'><span style='color: white;'>edit bio</span></h3>
              </button>

            </div>

          </div>




        </div>




      </div>



      <div class="right">


        <div class="comsbanner">

          <div class="options">

            <div>
              <a href="index.php">
                <h3>TIMELINE</h3>
              </a>
            </div>


            <div>
              <a>
                <h3><span style='color: #CB7A00;'>PROFILE</span></h3>
              </a>
            </div>


            <div>
              <a href="PHPOnly/logout.php">
                <h3>LOG OUT</h3>
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
    var modal2 = document.getElementById("editModal2");
    // Get the button that opens the modal
    var btn = document.getElementById("editBtn");
    var btn2 = document.getElementById("editBio");

    var span = document.getElementsByClassName("close")[0];
    var span2 = document.getElementsByClassName("close2")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function () {
      modal.style.display = "flex";
    }

    btn2.onclick = function () {
      modal2.style.display = "flex";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
      modal.style.display = "none";
    }

    span2.onclick = function () {
      modal2.style.display = "none";
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