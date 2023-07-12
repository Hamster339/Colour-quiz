<?php
//php script to remove record from database

//Enables access to urls

if ($_POST["name"] == ""){
  $_POST["name"] = NULL;
}

//Execute SQL Stored procridure
include('../includes/db.php');
$sql = "EXEC RemoveLine @id=?";
$params = [$_POST["id"]];
$stmt = sqlsrv_query($conn,$sql,$params);

if ($stmt == false) {
  echo "Database Error<br>";
  foreach(sqlsrv_errors() as $err=>$msg){
    foreach($msg as $err_code=>$err_msg){
      echo "$err_code: $err_msg<br/><br/>";
    }
  }
}else{
  echo "Remove successfull";
}
sqlsrv_close($conn);
?>
