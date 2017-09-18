<?php

  include_once 'func.php';

  if (isset($_GET["id"])){
    removeInternship($_GET["id"]);
    redirect("index.php");
  }

 ?>
