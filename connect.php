<?php
  $local=$_SERVER['HTTP_HOST'];
  if($local=='localhost'){
    $con= new mysqli('localhost','root','','agendalab');
  } else {
$con= new mysqli('108.179.192.85','avisnetc_turma168','l#kRgP3N!Y4w','avisnetc_turma168');
  }

  if (!$con) {
     die(mysqli_error($con));
  } 
?>