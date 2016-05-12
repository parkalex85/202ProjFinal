<?php

	session_start();
	require_once 'db_conn.php';

	$conn = getConnection();

	if(isset($_POST['login'])){
		
		$username = $_POST['username'];
		$salt = "1973qpzm";
		$password = $_POST['pass'].$salt;
		$password = sha1($password);

		$conn = getConnection();

		$sql = "SELECT * from users
			WHERE username = '$username' AND
			password = '$password'";		

		$stmt = $conn->prepare($sql);	
		try{
			$stmt->execute();
		} catch (Exception $e){
			echo $e;
		}
	
		$results = $stmt -> fetchAll();
		
		if(!empty($results)){
			foreach($results as $result){
				if($result['username'] == $username
				&& $result['password'] == $password){
					$_SESSION['user'] = $username;
					$_SESSION['id'] = $result['id'];
					$_SESSION['admin'] = $result['admin'];
						
					header("Location: homepage.php");
				}
			}
		}

		echo "Incorrect username or password";
	} else if(isset($_POST['guest'])){
		$_SESSION['user'] = 'Guest';
		$_SESSION['id'] = -1;
		header("Location: homepage.php");
	}

?>

<html>
	<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport"  content="width=device-width, initial-scale=1">
	<style>

	</style>

	

		<title>Welcome to GDEV!</title>
	</head>
	<body>
		<h1>WELCOME TO GDEV!</h1>
		<h2>Login</h2>
		
		<form method="post" name="login">
			Username: <input type="text" name="username"><br>
			Password: <input type="password" name="pass"><br>
			<input type="submit" name="login"></br></br>
		

		<a href ="register.php">Register</a><br/>
		<input type='submit' name='guest' value='Continue As Guest'>
		</form>
	</body>


</html>
