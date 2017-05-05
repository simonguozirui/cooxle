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

	<center>
		<h1 class="title">
			<?php
				// get array values from login
		    	$arr = array_values($_SESSION['user']);
				$clientname = $arr[1]; // assign username to variable clientname
				$email = $arr[2]; // assing email to variable email
			?>
		</h1>
		<br>
	</center>
	<div class="columns">
		<div class="column is-half is-offset-one-quarter">

			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">


		    	<div class="control">
		    		<!-- <input class="input" type="text" placeholder="&#x21AA;" name="animal"> -->
		    		<p class="control">
    					<textarea class="textarea" type="text" placeholder="&#x21AA; (maximum 255 characters)" name="text"></textarea>
  					</p>
		    	</div>
		    	<br>
		    	<div class="control"><input class="input" type="text" placeholder="&#x21AA; (not required)" name="tags"></div>
					<br>
		    	<input class="button is-primary" type="submit" name="submit">
		    </form>
		</div>
	</div>
	<?php

		// open connection
		$connection = mysqli_connect($host, $username, $password) or die ("Unable to connect!");

		// select database
		mysqli_select_db($connection, $dbname) or die ("Unable to select database!");


		$searchTags = $_POST["tag-lookup"];
		$searchUser = $_POST["user-lookup"];

		// if the person looks up a tag
		if ($searchTags != '') {
			// redirect them to tag.php with the tag name as the query string
			$location = "http://" . $_SERVER['HTTP_HOST'] . "tag.php?".$searchTags;
			echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.$location.'">';
		}
		// if the person looks up a user
		elseif ($searchUser != '') {
			// redirect them to user.php with the username as the query string
			$location = "http://" . $_SERVER['HTTP_HOST'] . "user.php?".$searchUser;
			echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.$location.'">';
		}
		// search symbols in from most to least recent
		$query = "SELECT * FROM `symbols` ORDER BY `symbols`.`id` DESC";
		// execute query
		$result = mysqli_query($connection,$query) or die ("Error in query: $query. ".mysql_error());
		// $result = array_reverse($initial);
		// see if any rows were returned

		// if there are rows
		if (mysqli_num_rows($result) > 0) {

    		// print them one after another
    		echo '<div class="columns">"';
    		while($row = mysqli_fetch_row($result)) {
    			$tag = $row[1]; // get tag from 2nd array index
    			$id = $row[0]; // get id from 1st array index
    			$text = $row[2]; // get post text from 3rd array index
    			$usr = $row[3]; // get username from 4th array index
    			$tagText = "";
    			// if there is a tag, create a button for it.
    			if ($tag != "") {
    				$tagText = '<a href="tag.php?'.$tag.'"><span class="tag is-primary is-small">'.$tag.'</span></a><br>';
    			}
				?><div class="column is-half is-offset-one-quarter"><div class="box"><article class="media">
  						<figure class="media-left">
    						<p class="image is-64x64">
						      <img src="http://bulma.io/images/placeholders/128x128.png">
						    </p>
						</figure>
						<div class="media-content">
						 	<div class="content">
						      	<p>
						        <strong><a href="user.php?<?=$usr?>"><?=$usr?></a></strong> <small>ID: <?=$id?></small>
						        <br>
						       <?=$tagText?> <?=$text?>
						      	</p>
						    </div>
						    <nav class="level is-mobile">
						    	<div class="level-left">
						        	<a class="level-item">
										<form action="<?=$_SERVER['PHP_SELF']?>">
											<input type="submit" name="<?=$id?>" class="button is-primary is-small" value="Like" />
										</form>
						        	</a>
						      	</div>
						    </nav>
						</div>
					</article></div></div></div>
			<?php
    		}
		    echo "</div></div>";
		// if there are no posts
		}
		else {

    		// tell the user in a red notification
    		echo '<div class="columns is-mobile"><div class="column is-half is-offset-one-quarter"><div class="notification is-danger">No posts found</div></div></div>';
		}

		// free result set memory
		mysqli_free_result($connection,$result);

		// if (strpos($_SERVER['QUERY_STRING'], "=Like") !== false) {
		// 	$id = int(str_replace($_SERVER['QUERY_STRING'], ""));

		// }

		// This is the part of the program that handles created posts \\

		// set variable values to HTML form inputs
		$postTags = htmlspecialchars($_POST['tag']); // get the tag and assign it to variable postTags
		$postTags = strtolower($postTags); // make the tag lowercase
		$postTags = str_replace(" ", "_", $postTags); // replace spaces with underscores. (Snake case woohoo)
    	$postText = htmlspecialchars($_POST['text']); // get the post text and assign it to variable postText

		// check to see if user has entered anything
		if ($postText != "") {
	 		// build SQL query
			$query = "INSERT INTO symbols (country, animal, username) VALUES ('$postTags', '$postText', '$clientname')";
			// run the query
     		$result = mysqli_query($connection,$query) or die ("Error in query: $query. ".mysql_error());
			// refresh the page to show new update
	 		echo "<meta http-equiv='refresh' content='0'>";
		}
		mysqli_close($connection);

	?>

	</body>
</html>
