<?php

include 'PHPOnly/connect.php'; // this file will be used
include 'PHPOnly/insertPost.php'; // this file will also be used


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
  <link rel="stylesheet" href="css/postmodal.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

  <div class="coms">


  </div>



  <div id="postModal" class="post-modal">

    <div class="post-section">

      <div class="postform-section">
        <hr>
        <div class="title">

          <h1>create post</h1>
          <i class="fa fa-times-circle-o close" aria-hidden="true"></i>

        </div>
        <hr>

        <form action="PHPOnly/insertPost.php" enctype="multipart/form-data" method="post" autocomplete="off">


          <div class="post-img input-form">
            <input type="file" class="img-upload" id="img-upload" name="img-upload" />
          </div>

          <br>


          <div class="input-form">
            <input style="border: none;" class="input-field" type="text" name="tag" id="tag" placeholder="tag here..."
              required />
          </div>
          <br>

          <textarea id="contents" name="contents" rows="4" cols="50" maxlength="400"
            placeholder="Post here..."></textarea>

          <br>


          <div class="btn-group">

            <input class="btn" type="submit" name="createPost" id="createPost" value="POST">

          </div>

        </form>
        <!---->

      </div>

    </div>

  </div>




  <div id="replyModal" class="post-modal">

    <div class="post-section">

      <div class="postform-section">
        <hr>
        <div class="title">

          <h1>reply</h1>
          <i class="fa fa-times-circle-o close" aria-hidden="true"></i>

        </div>
        <hr>

        <form action="PHPOnly/createpost.php" enctype="multipart/form-data" method="post" autocomplete="off">

          <textarea id="contents" name="contents" rows="4" cols="50" maxlength="400"
            placeholder="Post here..."></textarea>

          <br>

          <div class="btn-group">

            <input class="btn" type="submit" name="create" id="create" value="POST">

          </div>

        </form>
        <!---->

      </div>

    </div>

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
        
           <h1> ' . htmlspecialchars($_SESSION['name']) . ' </h1>
           <hr>
           <h3> ' . htmlspecialchars($_SESSION['email']) . ' </h3>
       
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

          <div class="postauthor-info">
            <img src="Assets/Icons/hilt_icon.png" class="pfp" height="100%" width="60px" />

            <div class="authorname">

              <h1> POST OWNER </h1>

              <p> <span style="color: gray;">postowner@email.com, 5 minutes ago<span></p>

            </div>


          </div>
          <hr>

          <div class="post-content">



            <div class="post-media">
              <img src="Assets/PostMedia/mordhau_banner.png" class="pfp" height="100%" width="100%" />
            </div>

            <div class="post-text">
              <p>
                Looking for duelyards. Any recs?
              </p>
            </div>


            <div class="below-post">

              <div class="post-options">
                <a class="reply-option" style="margin-right: 15px;"> <button id="like-post">LIKE</button> </a>

                <a class="reply-option" style="margin-right: 15px;"> <button id="create-edit">EDIT</button> </a>

                <a class="reply-option"> <button id="create-reply">REPLY</button> </a>
              </div>

              <a class="tag" style="background-color: #CB7A00; color: black;"> QUERY </a>
            </div>

            <div class="post-replies">

              <h3>REPLIES</h3>

              <div class="reply">
                <div class="replyauthor-info">
                  <img src="Assets/Icons/hilt_icon.png" class="pfp" height="50%" width="30px" />
                  <div class="replyauthorname">

                    <h1> POST OWNER 2</h1>

                    <p> <span style="color: gray;">postowner2@email.com, 2 minutes ago<span></p>

                  </div>

                  <a class="reply-option subreply" style="margin-right: 15px;"> <button id="like-post">LIKE</button>
                  </a>

                  <a class="reply-option subreply" style="margin-right: 15px;"> <button id="create-edit">EDIT</button>
                  </a>

                </div>

                <div class="reply-text">
                  <p>
                    Avoid Nukan's Duels EU, bad admin
                  </p>
                </div>


              </div>



            </div>



          </div>


        </div>







      </div>



      <div class="right">


        <div class="comsbanner">

          <div class="options">

         

              <p id="error-msg">
                <!-- element for displaying error messages, hidden if there are no messages -->
                <?php
                if (isset($_SESSION["Error"])) { // if session tag for error is set
                  echo "
                    <div>
                    ". $_SESSION['Error'] ."
                    </div>
                  
                  "; // echo the value of error
                  unset($_SESSION['Error']); // immediately unset the tag so it doesn't show up after refreshing the page
                }
                ?>
              </p>

        



            <?php
            if (isset($_SESSION['logged_in'])) {
              echo "

              <div>
                
                <button class='create-post' id='create-post'href='createpost.php'><h2>CREATE POST</h2></a>
              </div>
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




  <script>
    // Get the modal
    var modal = document.getElementById("postModal");

    // Get the button that opens the modal
    var btn = document.getElementById("create-post");

    var modal2 = document.getElementById("replyModal");
    var btn2 = document.getElementById("create-reply");

    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function () {
      modal.style.display = "flex";
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