<!DOCTYPE html>
<!--This page allows a user to see the results of the poll-->
<?php
include('includes/urls.php');

include('includes/db.php');
$sql = "EXEC GetAllData";
$stmt = sqlsrv_query($conn,$sql);
if ($stmt == false) {
  echo "Database Error<br>";
  foreach(sqlsrv_errors() as $err=>$msg){
    foreach($msg as $err_code=>$err_msg){
      echo "$err_code: $err_msg<br/><br/>";
    }
  }
}
?>

<html>
<head>
  <title>Poll Results</title>
</head>
<body>
  <h1>Poll results</h1>
  <table border="1px">
    <tr>
      <th>Name</th>
      <th>Favorate Colour</th>
    </tr>
    <?php
    while( $row = sqlsrv_fetch_array($stmt) ) { ?>
      <tr>
        <td><?php echo $row['Name']; ?></td>
        <td><?php echo $row['Colour']; ?></td>
      </tr>
      <?php
    }
    sqlsrv_close($conn);
    ?>
  </table>
  <a href="<?php echo $index; ?>">Submit a response</a><br>
  <a href="<?php echo $EditOrRemove; ?>">Edit or Remove a Response</a><br>
</body>
</html>
