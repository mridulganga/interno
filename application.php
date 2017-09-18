<?php

include_once 'func.php';

if (isset($_POST["apply"])){
  $iid=$_POST["iid"];

  if (isUserLoggedIn()==false){
    //redirect user.php;
    redirect("user.php");
  }

  if (userHasApplied(getCurrectUserId())){
    $form = '<h3>You have Already Applied!</h3><a href="index.php" class="btn btn-danger">Go Home</a>';
  }

  else
    $form = '<form action="application.php" method="post">
    <p>Why should you be selected?</p>
    <textarea name="extra" rows="8" cols="80" class="form-control"></textarea><br>
    <input type="hidden" name="aid" value="'.$iid.'">
    <input type="submit" name="apply_submit" value="Confirm Application" class="btn btn-success">
    </form>';
}

if (isset($_POST["apply_submit"])){
  createApplication(getCurrectUserId(),$_POST["aid"],$_POST["extra"]);
  $form= "<h3>We Received your application.</h3><a class='btn btn-success' href='index.php'>Goto Home</a>";
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
      <?php include 'nav.php'; ?>


      <div class="container">
        <?php echo $form; ?>
      </div>



          <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
          <!-- Include all compiled plugins (below), or include individual files as needed -->
          <script src="assets/js/bootstrap.min.js"></script>

    </body>
  </html>
