<?php
// SQL Server connection function
function db_connect() {

	static $conn;

	if(!isset($conn)) {

		$server = "BERNARD\SQLEXPRESS"; // replace with your server name
		$database = "demo_database";
		$username = "HPhilip"; // replace a database username
		$password = "admin"; // replace with username password
		$config = array("Database" => $database, "UID" => $username, "PWD" => $password);
		$conn = sqlsrv_connect($server, $config);
	}
	if($conn === false) {
		return false;
	}
	return $conn;
}


$conn = db_connect();

//Output error messages if error
if( $conn === false ) {
	foreach(sqlsrv_errors() as $err=>$msg){
		foreach($msg as $err_code=>$err_msg){
			echo "$err_code: $err_msg<br/><br/>";
		}
	}
}


?>
