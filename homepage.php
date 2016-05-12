<?php
	session_start();
	$logged = $_SESSION['id'];
	
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport"  content="width=device-width, initial-scale=1">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script>
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById("demo").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "table.php?user="+<?php echo $logged; ?>, true);
  xhttp.send();

</script>

	
</head>
<body>

<form method="get" action="search.php">
	<input type="text" name="search">
	<input type="submit" name="Run">
</form>

<h1>Welcome <?php echo $_SESSION['user']; ?></h1>


<h2>Add A Project</h2>
<form name = 'sub_change' method='post'>
Project Name: <input type='text' name='p_name'><br/>
Project Description: <input type='text' name='desc'><br/>
<input type='submit' name='sub_change'>
</form>
<h2>PROJECTS</h2>
<div id="demo"></div>
</body>
</html>
