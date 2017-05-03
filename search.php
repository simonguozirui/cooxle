<html>
	<!-- Use constant head file in required/  -->
	<?php include_once("required/head.php") ?>
	<body>
	<!-- import common.php -->
	<!-- Use constant nav in required/ -->
	<?php
		require("required/common.php");
		include_once("required/nav.php");
		require("required/security.php");
	?>
	<div class="columns">
		<div class="column is-half is-offset-one-quarter">
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<label class="label">Search tags:</label>
                <p class="control">
           	        <input name="tag-lookup" class="input" type="text" placeholder="Search for tags">
                </p>
                <br>
                <input class="button is-primary" type="submit" name="submit">
   	        </form>
   	        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<label class="label">Search users:</label>
                <p class="control">
           	        <input name="user-lookup" class="input" type="text" placeholder="Search for users">
                </p>
                <br>
                <input class="button is-primary" type="submit" name="submit">
   	        </form>
		</div>
	</div>

	<?php

		$searchTags = $_POST["tag-lookup"];
		$searchUser = $_POST["user-lookup"];

		// if the person looks up a tag
		if ($searchTags != '') {
			// redirect them to tag.php with the tag name as the query string
			$location = "http://" . $_SERVER['HTTP_HOST'] . "/tag.php?".$searchTags;
			echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.htmlentities($location, ENT_QUOTES, 'UTF-8').'">';
		}
		// if the person looks up a user
		elseif ($searchUser != '') {
			// redirect them to user.php with the username as the query string
			$location = "http://" . $_SERVER['HTTP_HOST'] . "/user.php?".$searchUser;
			echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.htmlentities($location, ENT_QUOTES, 'UTF-8').'">';
		}
	?>


	</body>
</html>
