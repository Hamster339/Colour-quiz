<!DOCTYPE html>
<!--Page in showing forms for editing and removeing records from the database-->
<?php
//Enables access to urls
include('includes/urls.php');
?>

<html>
<head>
  <title>Edit or Remove</title>
  <script src="includes/jQuery.js"></script>
  <script src=scripts/EORScript.js ></script>
</head>

<body onload="prep()">
  <h1>Edit or Remove a response</h1>
  <form  id="idForm" action="javascript:getRecord()" on method="post">
    Enter your Responce ID Number:<br> <input type="text" id="id" <br>
    <p id="idErr"></p>
    <input type="submit" value="Edit or Remove">
  </form>
  <br>
  <form id="editForm" action="javascript:editRecord()" on method="post">
    Name: <input type="text" id="nameField">
    Colour: <input type="text" id="colourField">
    <input type="submit" value="Save Changes">
    <p id="nameErr"></p>
    <p id="colourErr"></p>
    <button type="button" id="removebtn">Delete Response</button><br>
    <button type="button" id="cancelbtn">Cancel</button>
  </form>
  <p id="result"></p>
  <a href="<?php echo $index; ?>">Submit a response</a><br>
  <a href="<?php echo $results; ?>">view results</a><br>
</body>
</html>
