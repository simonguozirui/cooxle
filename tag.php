<html>
	<?php include_once("required/head.php") ?>
	<body>
	<?php require("required/common.php"); ?>
	<?php include_once("required/nav.php") ?>
	<?php require("required/security.php") ?>

	<center>
		<h1 class="title">
			<?php


				$string = $_SERVER['QUERY_STRING'];
				$string = str_replace("%23", "#", $string);
				$string = str_replace("%24", "$", $string);
				$string = str_replace("%25", "&", $string);
				$string = str_replace("%26", "+", $string);
				$string = str_replace("%2B", ".", $string);
				$string = str_replace("%2C", "/", $string);
				$string = str_replace("%2F", ":", $string);
				$string = str_replace("%3C", "<", $string);
				$string = str_replace("%3E", ">", $string);
				$string = str_replace("%3B", ";", $string);
				$string = str_replace("%3D", "=", $string);
				$string = str_replace("%3F", "?", $string);
				$string = str_replace("%40", "@", $string);


				$curTag = htmlentities($string, ENT_QUOTES, "UTF-8");
				if (strlen($curTag)<= 1) {
					$location = "http://" . $_SERVER['HTTP_HOST'] . "/index.php";
					echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.$location.'">';
				}
				echo '<span class="tag is-primary is-large">'.$curTag.'</span>';
			?>
		</h1>
		<hr>
		<a class="button is-primary" href="search.php">Search</a><br><br>
		<br><br>
	</center>
	<?php

		$connection = mysqli_connect($host, $username, $password) or die ("Unable to connect!");
		mysqli_select_db($connection, $dbname) or die ("Unable to select database!");
		$search = $_POST["search"];
		$query = "SELECT * FROM symbols WHERE country = '$curTag' ORDER BY `symbols`.`id` DESC";
		$result = mysqli_query($connection,$query) or die ("Error in query: $query. ".mysql_error());

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
						      <img src="img/user.png">
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
		} else {

    		echo '<div class="columns is-mobile"><div class="column is-half is-offset-one-quarter"><div class="notification is-danger">No posts found</div></div></div>';
		}

		mysqli_free_result($connection,$result);
		mysqli_close($connection);
		?>
	</body>
</html>
