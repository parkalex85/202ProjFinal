<html>
<title>
Your Search Results!
</title>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport"  content="width=device-width, initial-scale=1">
Here are your Search Results:
</head>
<body>
<body>
</html>

<?php
	session_start();
	$user = $_SESSION['id'];

$search = $_GET["search"];

require_once('db_conn.php');

		$conn = getConnection();

		$id = $user;

		$sql = 'SELECT * from projects WHERE name="'.$search.'"';

		$stmt = $conn->prepare($sql);
		$stmt->execute();

		$result = $stmt->fetchAll();

if(empty($result)){
	echo 'error';
}
foreach($result as $item){
	echo $item['name'];
	echo '<br>';
	echo $item['description'];
}


?>



