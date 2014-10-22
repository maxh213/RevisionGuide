<!DOCTYPE html>
<html>
<head>
<title>Revision</title>
<link rel="stylesheet" type="text/css" href="style.css"> 
</head>
<body>
<?php
try {
	#Trys to connect to the database and if unable throws an error message
	$dbhandle = new PDO("mysql:host=localhost;dbname=exams","root","");
} catch (PDOException $e) {
	die("CONNECTION NOT WORKING: " . $e->getMessage());
}

$sql = "SELECT * FROM computersystems";

$query = $dbhandle->prepare($sql);
if ($query->execute() === false) {
	#Throws an error message if the query didn't execute
	die("ERROR: " .implode($query->errorInfo(), " "));
}
#The query results are stored in the results variable
$results = $query->fetchAll();
#Initialises the stepper variable, this is used for displaying zebra stripes in the tables
$stepper = 1;
?>
<table class="table_center">
	<tr>
		<th>Word</th><th>Definition</th>
	</tr>
	<?php foreach($results as $row) { ?>
		<tr class="zebra<?php echo($stepper++ & 1);?>">
			<td><?php echo $row["word"]; ?></td>
			<td><?php echo $row["definition"]; ?></td>
		</tr>
	<?php } ?>
</table>
</body>
</html>
