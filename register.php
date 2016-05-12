<?php

	require_once 'db_conn.php';

	if(isset($_POST['reg'])){

		$username = $_POST['un'];
		$salt = "1973qpzm";
		$password = $_POST['password'].$salt;
		$password = sha1($password);

		$conn = getConnection();

		$sql = "INSERT into users (username, password, admin)
			VALUES ('$username', '$password', 0)";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
		header("Location: index.php");
	}

?>

<html>
<head>

	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport"  content="width=device-width, initial-scale=1">

</head>
<body>
<h1>Register</h1>
<form method='post' name='reg'>
	Username: <input type='text' name='un'></br>
	Password: <input type='text' name='password'></br>
	<input type='submit' name='reg'>
</form>
</body>
</html>
