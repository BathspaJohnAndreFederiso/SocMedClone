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
    <title>Profile</title>
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

  <div class="coms">
   

  </div>


  <div class="below"> 

   <div class="text-boxes">



    <div class="left">  
      

      <div class="pfp">
        <img src="Assets/Icons/hilt_icon.png" class="pfp" height="200px" width="200px"/>  
        <form action="updatepfp.php" class="update-pfp"> 
         <input type="file" class="pfp-upload" id="pfp-upload" name="pfp-upload">
         <input type="submit" class="pfp-submit" name="pfp-submit" id="pfp-submit" value="Update">
        </form>
      </div>

    </div>

    <div class="center">  

      <div class="profile">

        <div class="user-info"> 
          
          <div class="username"> 
            
            <h1> POST OWNER </h1>
        
            <h3> postowner@email.com</h3>
            
            <p> Joined: 20-09-2023</p>
            
           
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
           <a class="selected" href="index.php">
           <h3><span style="color: white;">TIMELINE</span></h3>
           </a>
         </div>

         <div>
            <a>
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



        
    
</body>

</html>