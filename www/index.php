<!DOCTYPE html>
<!--Index page of Colour poll Website
Website alllows users to participate in colour poll and to view the Results

this page allows a user to submit an answer to the pool
-->
<?php
include('includes/urls.php');
// define variables and set to empty values
$nameErr = $colourErr = "";
$name = $colour = "";
$success = false;

//if request is a post validate the submited data
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$name = $_POST["name"];
	$colour = $_POST["colour"];

	if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
		$nameErr = "Special characters and numbers are not allowed in a name";
	}
	if (!preg_match("/^[a-zA-Z-' ]*$/",$colour)) {
		$colourErr = "Special characters and numbers are not allowed in a colour";
	}
	if (empty($_POST["colour"])) {
		$colourErr = "A colour is required";
	}

	if ($nameErr == "" && $colourErr == ""){

		if ($name ==""){
			$name = NULL;
		}

		$datetimeOb= new DateTime();
		$time = $datetimeOb->format('Y-m-d H:i:s.u');
		$id=hash("sha256",($_POST["name"] . $_POST["colour"] . $time));
		$success = true;
	}
}

//if there has not been a successfull submit
if ($success == false) { ?>
	<html>
	<head>
		<title>Colour Poll</title>
	</head>
	<body>
		<h1>What is your favorate colour?</h1>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" on method="post">
			Your Name (optional):<br> <input type="text" name="name" value="<?php echo $name;?>"><br>
			<?php echo $nameErr;?><br>
			Colour:<br> <input type="text" name="colour" value="<?php echo $colour;?>"><br>
			<?php echo $colourErr;?><br>
			<input type="submit" value="Submit">
		</form>
		<a href="<?php echo $results; ?>">view results</a><br>
		<a href="<?php echo $EditOrRemove; ?>">Edit or Remove a response</a><br>
	</body>
	</html>


	<?php
	//if there has been a successfull submit
} else {

	//add to Database
	include('includes/db.php');
	$sql = "EXEC InsertNewLine @id=?, @name=?, @colour=?";
	$params = array($id,$_POST["name"],$_POST["colour"]);

	$stmt = sqlsrv_query($conn,$sql,$params);

	if ($stmt == false) {
		echo "Database Error<br>";
		foreach(sqlsrv_errors() as $err=>$msg){
			foreach($msg as $err_code=>$err_msg){
				echo "$err_code: $err_msg<br/><br/>";
			}
		}
	}else {
		//redirect to submited page
		sqlsrv_close($conn);
		header('Location:' . $submited . "?id=" .$id);
	}
}
?>
