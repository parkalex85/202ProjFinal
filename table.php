<?php
require_once('db_conn.php');
$user = $_GET['user'];
echo $user;
	function get_projects(){
		$conn = getConnection();

		$id = $user;

		$sql = "SELECT * from projects";

		$stmt = $conn->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll();
	}

	if(isset($_POST['Change'])){

		$conn = getConnection();

		$descript = $_POST['text'];
		$p_id = $_POST['res_id'];

		$sql = "UPDATE projects
			SET description = '$descript'
			WHERE id = $p_id";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
		header( 'Location: homepage.php' ) ;
	}

	if(isset($_POST['Delete'])){

		$conn = getConnection();

		$descript = $_POST['text'];
		$p_id = $_POST['res_id'];

		$sql = "DELETE from projects
			WHERE id = $p_id";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
		header( 'Location: homepage.php' ) ;
	}

	if(isset($_POST['sub_change'])){
		$conn = getConnection();

		$p_name = $_POST['p_name'];
		$desc = $_POST['desc'];
		$o_id = $user;

		$sql = "INSERT into projects
			(o_id, name, description)
			VALUES ($o_id, '$p_name', '$desc')";

		$stmt = $conn->prepare($sql);
		$stmt -> execute();
		header( 'Location: homepage.php' ) ;
	}		

$results = get_projects();

		foreach($results as $result){
			echo '<form method="post" action="table.php"><tr>';
				echo '<td>';
					echo $result['name'];
				echo '</td>';
				echo '<td>';
					echo '<input style="width:100%;" type="text" name="text" value=\'';
					echo $result['description'] . '\'>';
				echo '</td>';
				if($user == $result['o_id'] || $user == 17){
					echo "<input type='hidden' name='res_id' value='" . $result['id'] . "'>";
					echo "<td><input type='submit' name='Change' value='Change'></td>";

					echo "<input type='hidden' name='res_id' value='" . $result['id'] . "'>";
					echo "<td><input type='submit' name='Delete' value='Delete'></td>";
				}
			echo '</tr></form>';
		}

	?>
