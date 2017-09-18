<?php include_once 'func.php'; ?>

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
<?php if ( isUserLoggedIn() and isEmployer()==false and userHasApplied(getCurrectUserId())){ ?>

  <div class="alert alert-success" role="alert" style="overflow:hidden;">
    <div class="col-md-8">
        You have Applied for <?php echo getInternshipNamefromUserId(getCurrectUserId()); ?>
    </div>
    <div class="col-md-4">
      <a href="remove-application.php?id=<?php echo getApplicationIdfromUserId(getCurrectUserId()); ?>" class="btn btn-success" style="float:right; margin:-8px;">Cancel Internship</a>
    </div>

  </div>


<?php } ?>
      <!-- Everyone other than an Employer can see and try apply for an Internship -->
      <?php if (isEmployer() == false){

        $ilist = getIntenships();
        while ($row=$ilist->fetch_assoc()) {  ?>

      <div class="panel panel-default">
        <div class="panel-heading"><?php echo $row["title"]; ?></div>
        <div class="panel-body">
          <div class="col-md-8">
            <b>Posted by - </b> <?php echo getUserNamebyId($row["submitted_by"]);  ?> <br>
            <b>Date - </b> From <?php echo $row["start_date"]; ?> To <?php echo $row["end_date"]; ?> <br>
            <b>Description - </b> <?php echo $row["description"]; ?>
          </div>
          <div class="col-md-4">
            <form action="application.php" method="post">
              <input type="hidden" name="iid" value="<?php echo $row["id"]; ?>">
              <input type="submit" name="apply" value="Apply" class="btn btn-success" style="float:right;">
            </form>
          </div>
        </div>
      </div>
      <?php } //while end
    } //if end (not employer)



    //(is employer)
    //Employer can see and remove his Internships
      else {
        echo "<h3> Welcome Employer!</h3><a href='add-internship.php' class='btn btn-success'>Add Internship</a><br><br>
              <h3>Internships submitted by you :</h3>";

        $ilist = getIntenshipsbyId(getCurrectUserId());
        while ($row=$ilist->fetch_assoc()) {  ?>

          <div class="panel <?php if ($row["end_date"] < date('Y\-m\-d')) {echo 'panel-warning';}else {echo 'panel-default';}?>">
            <!-- Change Color to orange if expired -->

            <div class="panel-heading "><?php echo $row["title"]; ?>
              <?php if ($row["end_date"] < date('Y\-m\-d')){echo "<i style='margin-left:50px;'><b>Expired</b><i>";} ?>
            </div><!--Show Expired if end date has passed -->

            <div class="panel-body">
              <div class="col-md-8">
                <b>Posted by - </b> <?php echo getUserNamebyId($row["submitted_by"]);  ?> <br>
                <b>Date - </b> From <?php echo $row["start_date"]; ?> To <?php echo $row["end_date"]; ?> <br>
                <b>Description - </b> <?php echo $row["description"]; ?>
              </div>
              <div class="col-md-4">
                <form action="remove-internship.php" method="get">
                  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                  <input type="submit" name="remove" value="Remove" class="btn btn-danger" style="float:right;">
                </form>
              </div>
            </div>
          </div>

      <?php
    }//while end
  } // else end?>




  <!-- Employer can see Applications  -->
  <?php
    if (isEmployer()){


      $apps = getApplications();
      if ($apps->num_rows>0)
        echo '<br><br><h3>Applications : </h3>';
      while($row=$apps->fetch_assoc()){
        echo '<div class="well" style="overflow:hidden;">
        <div class="col-md-8">';
        echo '<b>Internship Title : </b>'.getInternshipTitle($row["internship_id"]).'<br>';
        echo '<b>Username : </b>'.getUserNamebyId($row["user_id"]).'<br>';
        echo '<b>Why he should be selected : </b>'.$row["extra_info"].'<br>';
        echo '</div>
        <div class="col-md-4">
        <a href="remove-application.php?id='. $row["id"].'" class="btn btn-danger" style="float:right;">Reject</a>
        </div>
        </div>';
      }
    }
   ?>


    </div>
    <!-- Container ends -->



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>
