<?php

include 'PHPOnly/connect.php'; // this file will be used

function createReplyRow($dataR){ // this function creates a reply to a post, using $dataR as parameter
  // concatenate into $response the reply HTML tags, with concatenated $dataR array values 
   $response = " 
   
   <div class='reply'>
   <div class='replyauthor-info'>
     <img src='Assets/pfps/". $dataR['pfp'] ."'.  class='pfp' height='50%' width='30px' />
     <div class='replyauthorname'>

       <h1>". $dataR['username'] . "</h1>

       <p> <span style='color: gray;'>" . $dataR['email'] . ", " . $dataR['date'] . "<span></p>

     </div>

   </div>
   <div class='reply-text'>
     <p>
     " . $dataR['reply_content'] . "
     </p>
   </div>


 </div>
   ";

   return $response; // return $response 
}

function createCommentRow($data) // this function creates a post, using $data as parameter
{


  if (empty($data['img'])) { // if statement that runs if data['img'] is empty
    // add to $response the contents of the post, with values from $data concatenated in
    $response = ' 
    
  <div class="post">

  <div class="postauthor-info">
    <img src="Assets/pfps/'. $data['pfp'] .'" class="pfp" height="100%" width="60px" />

    <div class="authorname">

      <h1> ' . $data['name'] . ' </h1>

      <p> <span style="color: gray;"> ' . $data['email'] . ',  ' . $data['date'] . ' <span></p>

    </div>


  </div>
  <hr>

  <div class="post-content">




    <div class="post-text">
      <p>
      ' . $data['content'] . ' 
      </p>
    </div>
     
    

    <div class="below-post"> 
    
    <div class="post-options">    ';

    $response .= '

    </div>

      <a class="tag" style="background-color: lightgray; color: black;"> ' . $data['tag'] . ' </a>

      
    </div>';

    // some content need to be visible for logged in users only, hence cutting the 
    if (isset($_SESSION['logged_in'])) {
      $response .= '
      <form class="reply-section" action="PHPOnly/InsertReply.php" method="post">
    <textarea id="contents" name="reply_content" rows="4" cols="50" maxlength="450"
     placeholder="Reply Here..." required></textarea>
     <input type="hidden" name="parent_id" id="parent_id" value="'.$data['id'].'">
     
     
     <input class="reply-btn" type="submit" name="post-reply" id="post-reply" value="R E P L Y">
     
    </form>
  
      '; // add to $response the abilty to reply

    }

    $response .= '

    
    
  </div>
  
  <div class="post-replies">
  '; 

  global $conn; // global $conn variable so it can be used inside this function
  // $sql2 = $conn->query(query: "SELECT username, mordhaureplies.parent_id, mordhaureplies.id, mordhaureplies.email, mordhaureplies.pfp, reply_content, mordhaureplies.date FROM mordhaureplies INNER JOIN mordhaucomments ON mordhaureplies.parent_id = mordhaucomments.id WHERE mordhaureplies.owner_id = '".$data['id']."' ORDER BY replies.id DESC LIMIT 1");
  $sql2 = $conn->query(query: "SELECT username, mordhaureplies.parent_id, mordhaureplies.id, mordhaureplies.email, mordhaureplies.pfp, reply_content, mordhaureplies.date FROM mordhaureplies WHERE mordhaureplies.parent_id = '".$data['id']."' ORDER BY mordhaureplies.id ");
  // sql2 query calls these datafields whose parent_id value is equal to the comment's id (this means that only replies to this specific comment will be acquired) 
  while($dataR = $sql2->fetch_assoc()){ // while $sql2 fetchthe values in the query as an array do this
      $response .= createReplyRow($dataR); // concatenate to $response the function createReplyRow with $dataR, which has the fetch_assoc value
  }

  // finish concatenating the string
  $response .='


  </div>

  </div>
  
  ';

  } else { // else means that $data[img] is not empty
    // this is the same except $data[img] is also included

    $response = '
    
    <div class="post">
  
    <div class="postauthor-info">
      <img src="Assets/pfps/'. $data['pfp'] .'" class="pfp" height="100%" width="60px" />
  
      <div class="authorname">
  
        <h1> ' . $data['name'] . ' </h1>
  
        <p> <span style="color: gray;"> ' . $data['email'] . ',  ' . $data['date'] . ' <span></p>
  
      </div>
  
  
    </div>
    <hr>
  
    <div class="post-content">

    

       <div class="post-media">
       <img src="Assets/PostMedia/' . $data['img'] . '" class="pfp" height="50%" width="50%" />
       </div>
  
  
  
  
      <div class="post-text">
        <p>
        ' . $data['content'] . ' 
        </p>
      </div>
       
      
  
      <div class="below-post"> 
      
      <div class="post-options">    ';
  
  
      $response .= '
  
      </div>
  
        <a class="tag" style="background-color: lightgray; color: black;"> ' . $data['tag'] . ' </a>
  
        
      </div>';
  
  
      if (isset($_SESSION['logged_in'])) {
        $response .= '
        <form class="reply-section" action="PHPOnly/InsertReply.php" method="post">
      <textarea id="contents" name="reply_content" rows="4" cols="50" maxlength="450"
       placeholder="Reply Here..." required></textarea>
       <input type="hidden" name="parent_id" id="parent_id" value="'.$data['id'].'">
       
       
       <input class="reply-btn" type="submit" name="post-reply" id="post-reply" value="R E P L Y">
       
      </form>
    
        ';
  
      }
  
      $response .= '
  
      
      
    </div>
    
    <div class="post-replies">
    ';
  
    global $conn;
    // $sql2 = $conn->query(query: "SELECT username, mordhaureplies.parent_id, mordhaureplies.id, mordhaureplies.email, mordhaureplies.pfp, reply_content, mordhaureplies.date FROM mordhaureplies INNER JOIN mordhaucomments ON mordhaureplies.parent_id = mordhaucomments.id WHERE mordhaureplies.owner_id = '".$data['id']."' ORDER BY replies.id DESC LIMIT 1");
    $sql2 = $conn->query(query: "SELECT username, mordhaureplies.parent_id, mordhaureplies.id, mordhaureplies.email, mordhaureplies.pfp, reply_content, mordhaureplies.date FROM mordhaureplies WHERE mordhaureplies.parent_id = '".$data['id']."' ORDER BY mordhaureplies.id ");
    
    while($dataR = $sql2->fetch_assoc()){
        $response .= createReplyRow($dataR);
    }
  
  
    $response .='
  
  
    </div>
  
    </div>
    
    ';



  }

  return $response; // return the finished $response value to whatever code has summoned this function
}

if (isset($_POST['getAllComments'])) { // if the POST for getAllComments has been set (this is done by the AJAX upon this document being ready)
  $start = $conn->real_escape_string($_POST['start']); // start variable is equal to the sql database connection function accessing POST start value (both getAllComments and start are returned by an AJAX script at the bottom of this page)
  $response = ""; // create an empty response (this will be concatenated with the post data)
  $sql = $conn->query(query: "SELECT name, mordhaucomments.owner_id, mordhaucomments.id, mordhaucomments.email, mordhaucomments.pfp, content, mordhaucomments.tag, mordhaucomments.img, date FROM mordhaucomments INNER JOIN accounts ON mordhaucomments.owner_id = accounts.id ORDER BY mordhaucomments.id DESC LIMIT $start, 20");
   // select post data (from mordhaucomments) that has equal value or is associated with a user's id via WHERE and INNER JOIN, ordered by the value of mordhaucomments.id
   
  while ($data = $sql->fetch_assoc()) { // while data is fetching arrays from mordhaucomments table via $sql do this
    $response .= createCommentRow($data); // concatenate into $response the returned value of createCommentRow with $data put as parameter

  }

  exit($response); // exit with the value of $response

}



$stmt = $conn->prepare('SELECT pfp FROM accounts WHERE id = ?');
// we will use the session id to retrieve the corresponding user data.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute(); // execute the prepared statement using the binded parameter
$stmt->bind_result($pfp);
$stmt->fetch();
    // bind to a variable, fetch then close
$stmt->close();

$stmt2 = $conn->prepare("SELECT id FROM mordhaucomments"); // select ALL id records from mordhaucomment
$stmt2->execute(); // execute
$numComments = $stmt2->num_rows; // set the variable of $numComments to the values taken by $stmt2

$stmt2->close(); // close


?>

<!DOCTYPE html>
<html lang="en">



<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mordhub: Home</title>
  <link rel="stylesheet" href="css/index.css">

  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> 
  <link rel="stylesheet" href="css/postmodal.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- call jquery and fontawesome scripts from their sites, css files from the folder-->
</head>

<body>

  <div class="coms">


  </div> <!-- this is the banner on top with the image of the Mordhau knight -->


 <!-- modal for posts, this is hidden by default -->
  <div id="postModal" class="post-modal">

    <div class="post-section">

      <div class="postform-section">
        <hr>
        <div class="title">

          <h1>create post</h1>
          <i class="fa fa-times-circle-o close" id="close"aria-hidden="true"></i>

        </div>
        <hr>

        <form action="PHPOnly/insertPost.php" enctype="multipart/form-data" method="post" autocomplete="off">
         <!-- form uses insertPost.php as action -->

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
          <!-- input forms for image submission, tag and post contents-->

          <div class="btn-group">

            <input class="btn" type="submit" name="createPost" id="createPost" value="POST">

          </div>

        </form>
        <!---->

      </div>

    </div>

  </div>





  <!-- this div class manages whats below coms-->
  <div class="below">
 
    <div class="text-boxes">

      
      <div class="left">

       <!-- some page elements are only visible if some session tags are set-->
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
 
        ?> <!-- use htmlspecialchars to avoid illegal characters being outputted to the user -->



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
        <!-- This is where the comments live -->





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
                    " . $_SESSION['Error'] . "
                    </div>
                  
                  "; // echo the value of error
                unset($_SESSION['Error']); // immediately unset the tag so it doesn't show up after refreshing the page
              }
              ?>
            </p>




            <!-- some layouts change entirely depending on whether or not the logged_in session tag is set-->
            <?php
            if (isset($_SESSION['logged_in'])) { // if the logged_in tag is set, output the options for viewing your profile and creating posts
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
            } else { // if not, output other options

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
    //var modal2 = document.getElementById("editModal");
    // Get the button that opens the modal
    var btn = document.getElementById("create-post");
    //var btn2 = document.getElementById("create-edit");

    var span = document.getElementById("close");
    //var span2 = document.getElementById("close2");

    // When the user clicks the button, open the modal 
    btn.onclick = function () {
      modal.style.display = "flex";
    };

    

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
      modal.style.display = "none";
    };

    // if the user clicks outside of the modal, close the modal
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    };
  </script>

  <script>
    // Get the modal
    //var modal2 = document.getElementById("replyModal");
    // Get the button that opens the modal
    //var btn2 = document.getElementById("create-reply");
    //var span2 = document.getElementsByClassName("close2")[0];

    // When the user clicks the button, open the modal
    //btn2.onclick = function () {
      //modal2.style.display = "flex";
    //};

    // When the user clicks on <span> (x), close the modal
    //span2.onclick = function () {
      //modal2.style.display = "none";
    //};

    // if the user clicks outside of the modal, close the modal
    //window.onclick = function (event) {
      //if (event.target == modal) {
        //modal2.style.display = "none";
      //}
    //};
  </script>


  <script id="this-is-AJAX" type="text/javascript"> 
    // ajax script, used for populating the center div with posts and replies


    $(document).ready(function () {  // once the document is ready execute this function

      getAllComments(0, <?php echo $numComments ?>); // call getAllComments (right below), with 0 and $numcomments variable (the code at the top, line 263) passed as parameter
      
    });

    function getAllComments(start, max) { // getAllComments has start and max has parameters
      if (start > max) { // start is greater than max? this must run
        return; // return value
      }

      $.ajax({ // ajax stuff
        url: 'index.php',
        method: 'post',
        dataType: 'text', // set url, method and dataTypes. This populates the page with posts so it has to be text
        data: {    // save data for getAllComments and start 
          getAllComments: 1,
          start: start
        }, success: function (response) { // if success do this function with $response
          $(".center").append(response); // append to the class .center the value of $response
          getAllComments((start + 20), max); // call getAllComments again with start + 20 and max and the first and second parameter
        }
      })
    };

    
  </script>


</body>

</html>