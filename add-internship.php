<?php include_once 'func.php'; ?>

<?php

// Add to DB when submit button clicked
if (isset($_POST["add_submit"])){
  $title = $_POST["title"];
  $start = $_POST["startDate"];
  $end = $_POST["endDate"];
  $info = $_POST["info"];
  createInternship(getCurrectUserId(),$title,$info,$start,$end);
  $result="<h3>Your New Internship has been Added!</h3><a href='index.php' class='btn btn-success'>Go Home</a>";
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


    <!-- Container Starts -->
    <div class="container">


      <!-- If we submitted then dont show form again -->
      <?php if (isset($result)==false){ ?>
        <div class="col-md-6" style="float:none; margin:30px auto;">
          <h3>Add New Internship</h3>
          <form action="add-internship.php" method="post">
            <input type="text" name="title" value="" placeholder="Title" class="form-control"><br>
            <input type="text" name="startDate" value="" placeholder="Start Date : yyyymmdd" class="form-control"><br>
            <input type="text" name="endDate" value="" placeholder="End Date : yyyymmdd" class="form-control"><br>
            <textarea name="info" rows="8" cols="80" placeholder="Description" class="form-control"></textarea><br>
            <input type="submit" name="add_submit" value="Add Internship" class="btn btn-success">
          </form>
        </div>
        <?php }
        else {
          // If we got the submit result then show it to user
          echo $result;
        }?>



    </div>
    <!-- Container ends -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>
