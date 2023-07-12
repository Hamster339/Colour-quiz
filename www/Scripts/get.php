<?php
//php script to retive record from database

//Execute SQL Stored procridure
include('../includes/db.php');
$sql = "EXEC GetLine @id=?";
$params = [$_POST["id"]];
$stmt = sqlsrv_query($conn,$sql,$params);
if ($stmt == false) {
  echo "Database Error<br>";
  foreach(sqlsrv_errors() as $err=>$msg){
    foreach($msg as $err_code=>$err_msg){
      echo "$err_code: $err_msg<br/><br/>";
    }
  }
} else {
  $result = sqlsrv_fetch_array($stmt);
  //check for id not found
  if ($result == NULL) {
    $result = "InvalidID";
  } else if ($result["Name"] == NULL) {
    $result["Name"] = "";
  }

  echo json_encode($result);
}
sqlsrv_close($conn);
?>
