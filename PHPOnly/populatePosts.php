<?php // this is a PHP-only variant of the code that populates index.php with posts
include 'connect.php';

function createCommentRow($data)
{
    return "
    
    <div class='post'>

    <div class='postauthor-info'>
      <img src='Assets/Icons/hilt_icon.png' class='pfp' height='100%' width='60px' />

      <div class='authorname'>

        <h1> " . $data['name'] . " </h1>

        <p> <span style='color: gray;'> " . $data['email'] . " ,  " . $data['date'] . " <span></p>

      </div>


    </div>
    <hr>

    <div class='post-content'>



      <div class='post-media'>
        <img src='Assets/PostMedia/ " . $data['img'] . " ' class='pfp' height='100%' width='100%' />
      </div>

      <div class='post-text'>
        <p>
        " . $data['content'] . " 
        </p>
      </div>


      <div class='below-post'>

        <div class='post-options'>
          <a class='reply-option' style='margin-right: 15px;'> <button id='like-post'>LIKE</button> </a>

          <a class='reply-option' style='margin-right: 15px;'> <button id='create-edit'>EDIT</button> </a>

          <a class='reply-option'> <button id='create-reply'>REPLY</button> </a>
        </div>

        <a class='tag' style='background-color: #CB7A00; color: black;'> QUERY </a>
      </div>

      




    </div>


    </div>
    
    ";
}

if (isset($_POST['getAllComments'])) {
    $start = $conn->real_escape_string($_POST['start']);
    $response = "";
    $sql = $conn->query(query: "SELECT name, contents, date FROM mordhaucomments INNER JOIN users ON mordhaucomments.owner_id = accounts.id ORDER BY mordhaucomments.id DESC LIMIT $start, 20");
    while ($data = $sql->fetch_assoc()) {
        $response .= createCommentRow($data);
    }

    exit($response);
}
?>