<?php

include_once 'func.php';

if (isset($_GET["id"])){
  $id = $_GET["id"];
  removeApplication($id);
  redirect("index.php");
}

 ?>
