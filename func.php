<?php
session_start();

include_once 'db.php';


//If you dont want to get your hands dirty in sql then uncomment the function below.
//open the interno page in the browser using any server and this will automatically create
//the neccessary tables. The tupples wont be added though. use the interno application for that
//firstRun();


  // is there a user session. is any user logged in?
  function isUserLoggedIn(){
    return isset($_SESSION["email"]);
  }

  // is the current user an employer
  function isEmployer(){
    $result = executeDB("select * from users where email='".$_SESSION["email"]."'");
    $row = $result->fetch_assoc();
    if ($row["type"]=='1')
      return true;
    return false;
  }

  // create a new user session and login
  function loginUser($email,$pass){
    $pass = hash("sha256",$pass);

    $result = executeDB("select * from users where email='$email' and password='$pass'");
    if ($result->num_rows>0){
      $_SESSION["email"] = $email;
      redirect("index.php");
      return true;
    }

    return false;
  }

  // destroy the current session and logout
  function logoutUser(){
    session_destroy();
    redirect("index.php");
  }

  // get user id of current user
  function getCurrectUserId(){
    $email = $_SESSION["email"];
    $result = executeDB("select id from users where email='$email'");
    $row = $result->fetch_assoc();
    return $row["id"];
  }
  //get username of current user
  function getUserName(){
    $email = $_SESSION["email"];
    $result = executeDB("select username from users where email='$email'");
    $row = $result->fetch_assoc();
    return $row["username"];
  }

  //get username from user id
  function getUserNamebyId($id){
    $result = executeDB("select username from users where id=$id");
    $row = $result->fetch_assoc();
    return $row["username"];
  }

  //get the user id from his email
   function getUserId($email){
     $result = executeDB("select id from users where email='$email'");
     $row = $result->fetch_assoc();
     return $row["id"];
   }

   //employer or student
  function getUserType(){
    $email = $_SESSION["email"];
    $result = executeDB("select type from users where email='$email'");
    $row = $result->fetch_assoc();
    return $row["type"];
  }

  // the user signed up
  function createUser($name,$email,$pass,$type){
    $pass = hash("sha256",$pass);
    $result = executeDB("insert into users values(0,'$name','$email',$type,'$pass')");
    return $result;
  }


  // did the particular user apply for any Internship
  function userHasApplied($userid){
      $result = executeDB("select * from applications where user_id=$userid");
      if ($result->num_rows>0)
        return true;
      return false;
  }

  // get the name of internship which the current user applied for
  function getInternshipNamefromUserId($userid){
    $result = executeDB("select title from internships where id = (select internship_id from applications where user_id=$userid)");
    if ($result->num_rows>0){
      $row = $result->fetch_assoc();
      return $row["title"];
    }
  }

  // get the Application id which any user has applied for
  function getApplicationIdfromUserId($userid){
    $result = executeDB("select id from applications where user_id=$userid");
    if ($result->num_rows>0){
      $row = $result->fetch_assoc();
      return $row["id"];
    }
  }


  // some student applied for an internship
  function createApplication($userid,$iid,$extra){
    return executeDB("insert into applications values(0,$iid,$userid,'$extra')");
  }

  // the application was cancled or rejected
  function removeApplication($id){
      executeDB("delete from applications where id=$id");
  }

  //create an internship
  function createInternship($userid,$title,$desc,$start,$end){
    return executeDB("insert into internships values(0,$userid,'$title','$desc','$start','$end')");
  }

  //remove an internship
  function removeInternship($id){
    executeDB("delete from applications where internship_id=$id");
    return executeDB("delete from internships where id=$id");
  }

  // get all the internships
  function getIntenships(){
    return executeDB("select * from internships where CURDATE() < end_date");
  }

  // get internships submitted by a particular employer
  function getIntenshipsbyId($userid){
    return executeDB("select * from internships where submitted_by=$userid");
  }

  //Get the title of Internship from the id
  function getInternshipTitle($id){
    $result = executeDB('select title from internships where id='.$id);
    if ($result->num_rows>0){
      $row = $result->fetch_assoc();
      return $row["title"];
    }
  }

  //php redirect is bad, so we use JS
  function redirect($url){
    echo '<script>window.location = "'.$url.'";</script>';
  }

  //get all the applications of the current Employer
  function getApplications(){
    $userid = getUserId($_SESSION["email"]);
    return executeDB("select * from applications where internship_id in (select id from internships where submitted_by=$userid)");
  }

 ?>
