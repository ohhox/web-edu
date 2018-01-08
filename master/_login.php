<?php  
	if (!empty($_POST)) {
		include "../_conn.php";
		$db = new DATABASE();
		$username = $_POST['username'];
		$password = $_POST['password'];
		

		$query = $db->mysqli->query("SELECT * FROM user WHERE username='$username' AND password='$password' ");

		if($query->num_rows > 0){
			$userInformation = $query->fetch_object();
			setcookie('userid',$userInformation->user_id, time()+(3600 * 24) );
			header("Location: index.php");
		}else{
			header("Location: login.php?error=1");
		}
	}else{
		echo "1";
	}
 ?>