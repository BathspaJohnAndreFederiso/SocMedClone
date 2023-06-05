<?php
session_start();
//if (!isset($_SESSION['logged_in'])) {
    //header('Location: login.php'); // redirect to logged_in page
    //exit;
//}

?>

<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mordhau</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>


   <div class="below"> 

   <div class="text-boxes">


    <div class="center">  

      <div class="post">

        <div class="user-info"> 
          <img src="Assets/Icons/hilt_icon.png" class="pfp" height="100%" width="60px"/>  
          
          <div class="username"> 
            
            <h1> POST OWNER </h1>
        
            <h3> postowner@email.com, 5 minutes ago</h3>
            
           
          </div>

        </div>

        <div class="post-content">
          
       

            <div class="post-media">
              <img src="Assets/Images/mordhau_banner.png" class="pfp" height="100%" width="100%"/>  
            </div>

            <div class="post-text">
                <p> 
                  This is a test. "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                </p>
            </div>
           
            
          <a class="create-reply" href="createpost.php">REPLY</a>
        </div>
        
        <div class="replies">
          
          <div class="user-info"> 
           <img src="Assets/Icons/hilt_icon.png" class="pfp" height="90%" width="40px"/>  
          
           <div class="username"> 
            <h4> POST OWNER 2 </h4>
            <p> postowner@email.com, 2 minutes ago</p>
           </div>
          </div>

          
          <a class="create-reply" href="createpost.php">REPLY</a>
        </div>

      </div>


      

    </div>

   </div>




        
    
</body>

</html>