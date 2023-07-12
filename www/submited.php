<!DOCTYPE html>
<!--This page tells a user that their answer to the poll has been submitted-->
<?php
//Enables access to urls
include('includes/urls.php');
?>

<html>
<head>
  <title>Success!</title>
</head>
<body>
  <h1>Success!</h1>
  <p>Your response has been submited</p>
  <p>Your response ID: <?php echo $_GET["id"]; ?></p>
  <p>Please make a note of this if you wish to edit or remove your response</p>
  <a href="<?php echo $index; ?>">Submit another response</a><br>
  <a href="<?php echo $results; ?>">view results</a><br>
  <a href="<?php echo $EditOrRemove; ?>">Edit or Remove your response</a><br>
</body>
</html>
