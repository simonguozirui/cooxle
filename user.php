<html>
	<!-- Include a constant head file -->
	<?php include_once("required/head.php") ?>
	<body>
	<!-- Include common.php -->
	<?php require("required/common.php"); ?>
	<!-- Include a constant nav file -->
	<?php include_once("required/nav.php") ?>
	<!-- Inlcude our security file. -->
	<?php require("required/security.php") ?>
	<div class="post-container">
		<center>
			<div class="column is-half">
				<div class="box">
					<?php
							// Take the query string and sanitize it.
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

							// Protect from XSS attacks
							$clientname = htmlentities($string, ENT_QUOTES, 'UTF-8');
							// If there is no query string, redirect to index.php
							if (strlen($clientname)< 1) {
								$location = "http://" . $_SERVER['HTTP_HOST'] . "/index.php";
								echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.$location.'">';
							}
							// open connection
							$connection = mysqli_connect($host, $username, $password) or die ("Unable to connect!");

							// select database
							mysqli_select_db($connection, $dbname) or die ("Unable to select database!");

							$profile_query = "SELECT pic, bio FROM users where username = '$clientname'";
							$profile_query_result = mysqli_query($connection,$profile_query) or die ("Error in query: $profile_query. ".mysqli_error());
							$profile_query_result_row = mysqli_fetch_row($profile_query_result);
							$current_pic_link = $profile_query_result_row[0];
							$bio = $profile_query_result_row[1];

						?>
						<p class="image is-128x128">
							<img src="<?=$current_pic_link?>" alt="<?$usr?>">
						</p>
						<br>
						<h1 class="title is-1"><?=$clientname?></h1>
						<p><?=$bio?></p>
						<?php
							//get user's post number
							// To access $_SESSION['user'] values put in an array, show user his username


							$post_count = "SELECT count(id) FROM posts where username = '$clientname'";
							$post_count_result = mysqli_query($connection,$post_count) or die ("Error in query: $post_count. ".mysqli_error());
							$post_num = mysqli_fetch_row($post_count_result);

							$arr = array_values($_SESSION['user']);
							$clientid = $arr[0];
							$clientid_name = $arr[1];

							if ($clientid_name !== $clientname){
								// if($_POST['follow']) {
								//echo "yes";
								// }
								//echo $cleintid;
								//$follower_count = "SELECT count('followerid') FROM likes where 'followingid' = $cleintid";
							}

						?>

						<form action="<?=$_SERVER['PHP_SELF']?>">
							<input type="submit" name="follow" class="button is-primary is-small" value="follow" />
						</form>
						<!-- <form action="user.php" method="POST">
							<button type="submit" style="background: blue; border:none; padding:0;" value="<?=$id?>" name="like">

							</button>
						</form> -->
						<h3 class="subtitle is-4"><?=$post_num[0]?> Posts | Followers | Following</h3>
					</div>
			</div>
		</div>
		<br>
		</center>
	</div>
	<?php
		// To access $_SESSION['user'] values put in an array, show user his username

		// open connection
		$connection = mysqli_connect($host, $username, $password) or die ("Unable to connect!");

		// select database
		mysqli_select_db($connection, $dbname) or die ("Unable to select database!");

		// create query
		$search = $_POST["search"];

		$query = "SELECT * FROM posts WHERE username = '$clientname' ORDER BY `posts`.`id` DESC";

		// execute query
		$result = mysqli_query($connection,$query) or die ("Error in query: $query. ".mysql_error());
		// $result = array_reverse($initial);
		// see if any rows were returned

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
    		// print status message if there are no posts
    		echo '<div class="columns is-mobile"><div class="column is-half is-offset-one-quarter"><div class="notification is-danger">No posts found by <b>'.$clientname.'</b> (or no users by the name of <b>'.$clientname.'</b>)</div></div></div>';
		}

		// free up memory from sql data.
		mysqli_free_result($connection,$result);
		mysqli_close($connection);
		?>

	</body>
</html>
