<?php

include 'PHPOnly/connect.php'; // this file will be used

function show_replies($replies, $parent_id)
{
  $postreplies = '';
  if ($parent_id) {
    // If the comments are replies sort them by the "submit_date" column
    array_multisort(array_column($replies, 'date'), SORT_ASC, $replies);

    // Iterate the replies using the foreach loop
    foreach ($replies as $reply) {
      if ($reply['parent_id'] == $parent_id) {
        // Add the comment to the $post-replies variable
        $postreplies .= '

        <div class="post-replies">

        <h3>REPLIES</h3>

        <div class="reply">
          <div class="replyauthor-info">
            <img src="Assets/Icons/'. $reply['pfp'] .'" class="pfp" height="50%" width="30px" />
            <div class="replyauthorname">

              <h1>'. $reply['username'] .'</h1>

              <p> <span style="color: gray;">'. $reply['email'] .', '. $reply['date'] .'<span></p>

            </div>

          </div>

           <div class="reply-text">
             <p>
             '. $reply['reply_content'] .'
             </p>
           </div>
          </div>  
      </div>

        '; // reply html format goes above in $postreplies
      }
    }
  }
  return $postreplies;
}


function createCommentRow($data)
{



  if (empty($data['img'])) {

    $response = '
    
  <div class="post">

  <div class="postauthor-info">
    <img src="Assets/pfps/' . $data['pfp'] . '" class="pfp" height="100%" width="60px" />

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



    if (isset($_SESSION['logged_in'])) {
      $response .= '
    
       <button id="like-post" class="reply-option" style="margin-right: 15px;">LIKE</button> 


   
      ';

      if ($_SESSION['id'] == $data['owner_id']) {
        $response .= '
    
        <button id="create-edit" class="reply-option" style="margin-right: 15px;">EDIT</button>
 
    
       ';

      }


    }

    $response .= '

    </div>

      <a class="tag" style="background-color: lightgray; color: black;"> ' . $data['tag'] . ' </a>
    </div>';


    if (isset($_SESSION['logged_in'])) {
      $response .= '
      <form class="reply-section" action="PHPOnly/InsertReply.php" method="post">
    <textarea id="contents" name="reply_content" rows="4" cols="50" maxlength="150"
     placeholder="Reply Here..."></textarea>
     <input type="hidden" name="parent_id" id="parent_id" value="'.$data['id'].'">

     
     <input class="reply-btn" type="submit" name="post-reply" id="post-reply" value="R E P L Y">
     
    </form>
  
      ';

    }

    $response .= '

    
    
  </div>


    

  


  </div>
  
  ';

  } else {


    $response = '
    
  <div class="post">

  <div class="postauthor-info">
    <img src="Assets/pfps/' . $data['pfp'] . '" class="pfp" height="100%" width="60px" />

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
    <div class="post-options">
    ';



    if (isset($_SESSION['logged_in'])) {
      $response .= '
    
       <button id="like-post" class="reply-option" style="margin-right: 15px;">LIKE</button> 


   
      ';

      if ($_SESSION['id'] == $data['owner_id']) { // check if session id is equal to the id of the author of this post
        // let the current logged in id owner be able to edit the post
        $response .= ' 
    
        <button id="create-edit" class="reply-option" style="margin-right: 15px;">EDIT</button>
 
    
       ';

      }
    }

    $response .= '
     </div>
      <a class="tag" style="background-color: lightgray; color: black;"> ' . $data['tag'] . ' </a>
    </div>';


    if (isset($_SESSION['logged_in'])) {
      $response .= '
      <form class="reply-section" action="">
    <textarea id="contents" name="contents" rows="4" cols="50" maxlength="400"
     placeholder="Reply Here..."></textarea>

     
     <input class="reply-btn" type="submit" name="post-reply" id="post-reply" value="R E P L Y">
     
    </form>
  
      ';

    }

    $response .= '

    
    
  </div>


    




  </div>


  </div>
  
  ';



  }

  return $response;
}

if (isset($_POST['getAllComments'])) {
  $start = $conn->real_escape_string($_POST['start']);
  $response = "";
  $sql = $conn->query(query: "SELECT name, mordhaucomments.owner_id, mordhaucomments.id, mordhaucomments.email, mordhaucomments.pfp, content, mordhaucomments.tag, mordhaucomments.img, date FROM mordhaucomments INNER JOIN accounts ON mordhaucomments.owner_id = accounts.id ORDER BY mordhaucomments.id DESC LIMIT $start, 20");
  
  while ($data = $sql->fetch_assoc()) {
    $response .= createCommentRow($data);

  }

  exit($response);

}



$stmt = $conn->prepare('SELECT pfp FROM accounts WHERE id = ?');
// we will use the session id to retrieve the corresponding user data.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute(); // execute the prepared statement using the binded parameter
$stmt->bind_result($pfp);
$stmt->fetch();

$stmt->close(); // bind to a variable, fetch then close

$stmt2 = $conn->prepare("SELECT id FROM mordhaucomments");
$stmt2->execute();
$numComments = $stmt2->num_rows;

$stmt2->close(); // bind to a variable, fetch then close

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

        <form action="PHPOnly/insertPostBasic.php" enctype="multipart/form-data" method="post" autocomplete="off">

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
    var span = document.getElementsByClassName("close")[0];

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



    $(document).ready(function () {

      getAllComments(0, <?php echo $numComments ?>);
    });

    function getAllComments(start, max) {
      if (start > max) {
        return;
      }

      $.ajax({
        url: 'index.php',
        method: 'post',
        dataType: 'text',
        data: {
          getAllComments: 1,
          start: start
        }, success: function (response) {
          $(".center").append(response);
          getAllComments((start + 20), max);
        }
      })
    };
  </script>



</body>

</html>