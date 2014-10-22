<!DOCTYPE html>
<html>
<head>
<title>Revision</title>
<link rel="stylesheet" type="text/css" href="style.css"> 
</head>
<body>
<?php
$word=$_GET["word"];
$word='"'.$word.'"';
$definition=$_GET["definition"];
$definition='"'.$definition.'"';
try {
	#Trys to connect to the database and if unable throws an error message
	$dbhandle = new PDO("mysql:host=localhost;dbname=exams","root","");
} catch (PDOException $e) {
	die("CONNECTION NOT WORKING: " . $e->getMessage());
}

$sql = "INSERT INTO computersystems (word, definition) VALUES ( $word , $definition )";

$query = $dbhandle->prepare($sql);
if ($query->execute() === false) {
	#Throws an error message if the query didn't execute
	die("ERROR: " .implode($query->errorInfo(), " "));
}
#The query results are stored in the results variable
$results = $query->fetchAll();
#Initialises the stepper variable, this is used for displaying zebra stripes in the tables
$stepper = 1;

header("Location: add.php");
?>
</body>
</html>
