<?php session_start() ?>
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
				$clientid = $arr[0];
				$clientname = $arr[1]; // assign username to variable clientname
				$email = $arr[2]; // assing email to variable email
				echo "Hello " . $clientname."!";
			?>
		</h1>
		<br>
	</center>
	<div class="columns">
		<div class="column is-half is-offset-one-quarter">

			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
					<!--Javascript function that shows how much characters could be entered within the limit-->
					<script>
					function countChar(val) {
						var len = val.value.length;
						if (len >= 255) {
							val.value = val.value.substring(0, 255);
							$('#charNum').text("Exceeding Character Limit");
						} else {
							var display_wordcount = 255 - len +" Characters Remaining";
							$('#charNum').text(display_wordcount);
						}
					};
					</script>
		    	<div class="control">
		    		<!-- <input class="input" type="text" placeholder="&#x21AA;" name="content"> -->
		    		<label class="label">Post Text</label>
		    		<p class="control">
    					<textarea class="textarea" type="text" placeholder="&#x21AA; (maximum 255 characters)" name="text" onkeyup="countChar(this)"></textarea>
							<p style="text-align: right" id="charNum"></p>
  					</p>
		    	</div>
		    	<br>
		    	<label class="label">Post Tag</label>
		    	<div class="control"><input class="input" type="text" placeholder="&#x21AA; (not required)" name="tag"></div>
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

		// search posts in from most to least recent
		$query = "SELECT * FROM `posts` ORDER BY `posts`.`id` DESC";
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
					$fixed_hour = date("h",$row[4]) + 6;
					$date = date("Y-m-d",$row[4]);
					$min = date("i:s",$row[4]);
    			$tagText = "";
					//$sql = mysqli_query($connection,$query) or die ("Error in query: $query. ".mysqli_error());
					$pic_query = "SELECT pic FROM users where username = '$usr'";
					$pic_query_result = mysqli_query($connection,$pic_query) or die ("Error in query: $pic_query. ".mysqli_error());
					$pic_query_result_row = mysqli_fetch_row($pic_query_result);
					$current_pic_link = $pic_query_result_row[0];
					if ($current_pic_link == null){
						$current_pic_link = "img/user.png";
					}

    			// if there is a tag, create a button for it.
    			if ($tag != "") {
    				$tagText = '<a href="tag.php?'.$tag.'"><span class="tag is-primary is-small">'.$tag.'</span></a><br>';
    			}
				?><div class="column is-half is-offset-one-quarter"><div class="box"><article class="media">
  						<figure class="media-left">
    						<p class="image is-64x64">
						      <img src="<?=$current_pic_link?>" alt="<?$usr?>">
						    </p>
						</figure>
						<div class="media-content">
						 	<div class="content">
						      	<p>
						        <strong><a href="user.php?<?=$usr?>"><?=$usr?></a></strong> <small>ID: <?=$id?></small> <small><?=$date?> <?=$fixed_hour?>:<?=$min?></small>
						        <br>
						       	<?=$tagText?><?=$text?>
						      	</p>
						    </div>
						    <nav class="level is-mobile">
						    	<div class="level-left">
						        	<a class="level-item">
												<form action="index.php" method="POST">
													<button type="submit" style="padding-top:18px;background: none; border:none;" value="like" name="like">
														<?php
															if($_POST['like']) {
																$like_query = "SELECT postid, userid FROM likes where postid = $id and userid = $clientid";
																$like_result = mysqli_query($connection,$like_query) or die ("Error in query: $like_query. ".mysqli_error());
																$like_count = "SELECT count(userid) FROM likes where postid = $id";
																$like_count_result = mysqli_query($connection,$like_count) or die ("Error in query: $like_count. ".mysqli_error());
																$likes_number = mysqli_fetch_row($like_count_result);
																if (mysqli_num_rows($like_result) > 0) {
																	$like_delete_query = "DELETE FROM likes WHERE postid = $id and userid = $clientid";
																	$like_result = mysqli_query($connection,$like_delete_query) or die ("Error in query: $like_delete_query. ".mysql_error());
																	echo '<i class="fa fa-thumbs-up" aria-hidden="true" style="color:#3273DC;"></i>';
																}else{
																	$like_add_query = "INSERT INTO likes(userid, postid) VALUES ($clientid,$id)";
																	$like_result = mysqli_query($connection,$like_add_query) or die ("Error in query: $like_add_query. ".mysql_error());
																	echo '<i class="fa fa-thumbs-o-up" aria-hidden="true" style="color:#3273DC;"></i>';
																}
															}else{
																echo '<i class="fa fa-thumbs-o-up" aria-hidden="true" style="color:#3273DC;"></i>';
															}
														?>
													</button>
												</form>
						        	</a>
											<a class="level-item">
												<p style="font-size: 20px;"><?=$likes_number[0]?></p>
											</a>
											<a class="level-item">
												<i class="fa fa-comment" aria-hidden="true" style="color:#3273DC;"></i>'
											</a>
											<a class="level-item">
												<p style="font-size: 20px;"><?=$likes_number[0]?></p>
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
		$postTime = time();

		// check to see if user has entered anything
		if ($postText != "") {
	 		// build SQL query
			$query = "INSERT INTO posts (tag, content, username, time) VALUES ('$postTags', '$postText', '$clientname', '$postTime')";
			// run the query
     		$result = mysqli_query($connection,$query) or die ("Error in query: $query. ".mysql_error());
			// refresh the page to show new update
	 		echo "<meta http-equiv='refresh' content='0'>";
		}
		mysqli_close($connection);

	?>

	</body>
</html>
