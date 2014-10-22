<!DOCTYPE html>
<html>
<head>
<title>Revision</title>
<style type="text/css">
body {
	text-align: center;
	font-family: "freight-sans-pro", "Lato", Helvetica, sans-serif;
}
h2 {
	font-size: 36px;
	font-weight: 200;
	color: #464542;
	height:20%;
	width:100%;
	float:right;
}
textarea {
	width: 410px;
	height: 203px;
}
div {
	text-align: left;
	width: 410px;
	height: 203px;
	word-wrap:break-word;
	overflow:scroll;
	display:inline-block;
	height:20em;
	width:100%;
	float:right;
}
input {
	width: 40px;
	height: 20px;
	padding: 9px 20px;
}
select,
button {
	padding: 9px 20px;
	border: none;
	background: #464542;
	color: #FFFFFF;
	cursor: pointer;
	width:50%;
	height: 5em;

	
	float: right;
	bottom: 0;
}
select.drop {
	padding: 9px 10px;
}
select:hover,
button:hover {
	background: #393835
}
.black {
	background-color: black;
	resize: none;
}
</style>
<script type="text/javascript">
function getAnswer() {
	var answerBox = document.getElementById("answer");
	answerBox.className = "";
}
function getNext() {
	location.reload();
}
</script>
</head>
<body>
<?php
header("Cache-Control: no-cache, must-revalidate"); 
try {
	#Trys to connect to the database and if unable throws an error message
	$dbhandle = new PDO("mysql:host=localhost;dbname=exams","root","");
} catch (PDOException $e) {
	die("CONNECTION NOT WORKING: " . $e->getMessage());
}

$sql = "SELECT * FROM computersystems ORDER BY RAND() LIMIT 0,1";

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

	<?php foreach($results as $row) { ?>
			<h2><?php echo $row["word"]; ?></h2>
			<div cols="50" rows="4" name="answer" class="black" id="answer"><?php echo $row["definition"]; ?></div>
	<?php } ?>
</br>
<br>
<button onclick="getNext()">Next</button>
<button onclick="getAnswer()">Get Answer</button>
</body>
</html>
