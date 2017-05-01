<?php
	if(empty($_SESSION['user'])) {

		$location = "http://" . $_SERVER['HTTP_HOST'] . "/login.php";
		echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.$location.'">';
		//exit;

		die("<center><div class='notification is-danger'>Redirecting to login</div></center>");
	}
?>