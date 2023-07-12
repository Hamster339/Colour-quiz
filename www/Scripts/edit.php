<?php
//php script to edit a record in database

if ($_POST["name"] == ""){
  $_POST["name"] = NULL;
}

//Execute SQL Stored procridure
include('../includes/db.php');
$sql = "EXEC EditLine @id=?, @name=?, @colour=?";
$params = [$_POST["id"],$_POST["name"],$_POST["colour"]];
$stmt = sqlsrv_query($conn,$sql,$params);
if ($stmt == false) {
  echo "Database Error<br>";
  foreach(sqlsrv_errors() as $err=>$msg){
    foreach($msg as $err_code=>$err_msg){
      echo "$err_code: $err_msg<br/><br/>";
    }
  }
}else{
  echo "edit successfull";
}
sqlsrv_close($conn);
?>
