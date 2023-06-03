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

  <div class="coms">
   
    <div class="comsbanner">
 
     <div class="options">
       
   
        <a class="selected">
        <h3><span style="color: white;">MORDHAU</span></h3>
        </a>
     

       <a href="#">
       <h3><span style="color: black;">CHIVALRY</span></h3>
       </a>

       <a href="#">
       <h3><span style="color: black;">FOR HONOR</span></h3>
       </a>

       <a href="#">
       <h3><span style="color: black;">HELLISH QUART</span></h3>
       </a>

      </div>


    </div>

   </div>

   <div class="text-boxes">


    <div class="left">  

      <div class="user">

        <img src="Assets/Icons/hilt_icon.png" height="100%" width="120px"/>  
        <div class="names"> 
          <h1> Username </h1>
          <h3> email@email.com </h3>
        
        </div>

      </div>

      
      <div class="buttons">
            
      </div>

      <div class="info">
        <h1> MORDHAU </h1>
        <p>

         MORDHAU is a medieval first & third person multiplayer slasher. Enter a hectic battlefield of up to 64 players as a mercenary in a fictional, but realistic world, where you will get to experience the brutal and satisfying melee combat that will have you always coming back for more.

        </p>
      </div>

    </div>

    <div class="right">  

      <div class="post">

        <div class="user-info"> 
          <img src="Assets/Icons/hilt_icon.png" class="pfp" height="100%" width="60px"/>  
          
          <div class="username"> 
            
            <h1> POST OWNER NAME</h1>
        
            <h3> post owner's email, just now</h3>
            
           
          </div>

        </div>

        <div class="post-content">
          
       

            <div class="post-media">
              
            </div>

            <div class="post-text">
              
            </div>

        </div>
        
        <div class="reply">
              
        </div>

      </div>

    </div>


    
    <div class="rightest">  

        <form class="create-post">
         <a href="#"><h2>CREATE POST</h2></a>
        </form>


        <div>

        </div>
    </div>
 
 




   </div>



        
    
</body>

</html>