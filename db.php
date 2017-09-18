<?php

//database connect disconnect functions to make life easy.

//Tables -

// 1
//users - id | username | email | type | password
// id - autoincremented, username can have spaces, email used for loginUser
// type 0 Student and 1 Employer, password sha256 hashing

// 2
//internships - id | submitted_by | title | description | start_date | end_date
// id - autoincremented, submitted_by id of an employer, title Internship title
// description internship desc. , start_date end_date dates for Internships

// 3
//applications - id | internship_id | user_id | extra_info
// id - autoincremented, internship_id which internship, user_id who Applied
// extra_info why select that student



  //credentials                                 host      user   pass  database
  function connectDB(){return mysqli_connect('localhost','root','1234','interno');}



  function disconnectDB($c){$c->close();}
  function executeDB($sql){
    $c = connectDB();
    $data = $c->query($sql);
    disconnectDB($c);
    return $data;
  }

  function firstRun(){

    executeDB("create table if not exists users(id int(10) primary key auto_increment,
              username varchar(200), email varchar(200), type int(1), password varchar(300))");

    executeDB("create table if not exists internships(id int(10) primary key auto_increment,
              submittted_by int(10) , title varchar(200), description text,
              start__date date, end_date date)");

    executeDB("create table if not exists applications(id int(10) primary key auto_increment,
              internship_id int(10), user_id int(10), extra_info text)");
  }


 ?>
