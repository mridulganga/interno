<?php

include_once 'func.php';

if (isset($_GET["signout"])){
  logoutUser();
}

if (isset($_POST["signin"])){
  $form = '<h3>Sign IN</h3>
    <form action="user.php" method="post">
    <input type="text" name="email" value="" placeholder="Email" class="form-control"><br>
    <input type="password" name="pass" value="" placeholder="Password" class="form-control"><br>
    <input type="submit" name="signin_submit" value="Sign IN" class="btn btn-success">
    </form>';
}else if (isset($_POST["signup"])){
  $form = ' <h3>Sign UP</h3>
    <form action="user.php" method="post">
    <input type="text" name="name" value="" placeholder="Name"class="form-control"><br>
    <input type="text" name="email" value="" placeholder="Email"class="form-control"><br>
    <input type="radio" name="type" value="0"> Student <br>
    <input type="radio" name="type" value="1"> Employer <br>
    <input type="password" name="pass" value="" placeholder="Password"class="form-control"><br>
    <input type="submit" name="signup_submit" value="Sign UP" class="btn btn-success">
    </form>';
}
else if (isset($_POST["signin_submit"])){
  loginUser($_POST["email"],$_POST["pass"]);
}
else if (isset($_POST["signup_submit"])){
  createUser($_POST["name"],$_POST["email"],$_POST["pass"],$_POST["type"]);
  loginUser($_POST["email"],$_POST["pass"]);
}
else{
  if (isUserLoggedIn()){
    $form = '<h3>Welcome to the Interno Community</h3>';
  }
  else{
    $form = '<h3>Sign IN</h3>
      <form action="user.php" method="post">
      <input type="text" name="email" value="" placeholder="Email" class="form-control"><br>
      <input type="password" name="pass" value="" placeholder="Password" class="form-control"><br>
      <input type="submit" name="signin_submit" value="Sign IN" class="btn btn-success">
      </form>';
  }

}

 ?>



 <!DOCTYPE html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <title>Interno</title>

     <link href="assets/css/bootstrap.min.css" rel="stylesheet">

   </head>
   <body>

     <!-- Show the Navigation -->
     <?php include_once 'nav.php'; ?>
     <div class="container">
       <div class="col-md-5" style="float:none; margin:40px auto;">
          <?php echo $form; ?>
       </div>

     </div>


   </body>
 </html>
