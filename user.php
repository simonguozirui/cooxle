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
							if ($current_pic_link == null){
								$current_pic_link = "img/user.png";
							}

							//get user's post number
							// To access $_SESSION['user'] values put in an array, show user his username


							$post_count = "SELECT count(id) FROM posts where username = '$clientname'";
							$post_count_result = mysqli_query($connection,$post_count) or die ("Error in query: $post_count. ".mysqli_error());
							$post_num = mysqli_fetch_row($post_count_result);

							$arr = array_values($_SESSION['user']);
							$clientid = $arr[0];
							$clientid_name = $arr[1];

							$follower_count_query = "SELECT count(followerid) FROM follow where followingid = '$clientid'";
							$follower_count_query_result = mysqli_query($connection,$follower_count_query) or die ("Error in query: $follower_count_query. ".mysqli_error());
							$follower_num = mysqli_fetch_row($follower_count_query_result);

							$following_count_query = "SELECT count(followingid) FROM follow where followerid = '$clientid'";
							$following_count_query_result = mysqli_query($connection,$following_count_query) or die ("Error in query: $following_count_query. ".mysqli_error());
							$following_num = mysqli_fetch_row($following_count_query_result);

						?>
						<p class="image is-128x128">
							<img src="<?=$current_pic_link?>" alt="<?$usr?>">
						</p>
						<br>
						<h1 class="title is-1"><?=$clientname?></h1>
						<h3 class="subtitle is-4"><?=$post_num[0]?> Posts | <?=$follower_num[0]?> Followers | <?=$following_num[0]?> Following</h3>
						<p><?=$bio?></p>
						<br>

						<?php

							if ($clientid_name !== $clientname){

									// if($_POST['like']) {
									// 	$follow_status_query = "SELECT postid, userid FROM likes where postid = $id and userid = $clientid";
									// 	$like_result = mysqli_query($connection,$like_query) or die ("Error in query: $like_query. ".mysqli_error());
									// 	$like_count = "SELECT count(userid) FROM likes where postid = $id";
									// 	$like_count_result = mysqli_query($connection,$like_count) or die ("Error in query: $like_count. ".mysqli_error());
									// 	$likes_number = mysqli_fetch_row($like_count_result);
									// 	if (mysqli_num_rows($like_result) > 0) {
									// 		$like_delete_query = "DELETE FROM likes WHERE postid = $id and userid = $clientid";
									// 		$like_result = mysqli_query($connection,$like_delete_query) or die ("Error in query: $like_delete_query. ".mysql_error());
									// 		echo '<i class="fa fa-thumbs-up" aria-hidden="true" style="color:#3273DC;"></i>';
									// 	}else{
									// 		$like_add_query = "INSERT INTO likes(userid, postid) VALUES ($clientid,$id)";
									// 		$like_result = mysqli_query($connection,$like_add_query) or die ("Error in query: $like_add_query. ".mysql_error());
									// 		echo "hello";
									// 		echo '<i class="fa fa-thumbs-o-up" aria-hidden="true" style="color:#3273DC;"></i>';
									// 	}
									// }
								echo '<input type="submit" name="follow" class="button is-primary is-medium" value="follow"/>';
								//echo $cleintid;
								//$follower_count = "SELECT count('followerid') FROM likes where 'followingid' = $cleintid";
							}else{
								echo '<a class="button is-primary is-medium modal-button" id="edit">Edit</a>';
							}
						?>

						<br><br>
						<script>
							$(document).ready(function(){
							    $("#edit").click(function(){
							        $("form#edit_info").show();
							    });
							});
						</script>
						<div class="columns is-mobile">
							<div class="column is-2"></div>
  						<div class="column is-8">
							<form id="edit_info" action="user.php" method="post" style="display:none;">
				        <div class="field">
				          <p class="control has-icons-left has-icons-right">
				            <input type="text" name="pic" value="" class="input is-primary" placeholder="Profile Picture Link">
				            <span class="icon is-small is-left">
											<i class="fa fa-user-circle-o" aria-hidden="true"></i>
										</span>
				          </p>
				        </div>
				        <div class="field">
				          <p class="control has-icons-left has-icons-right">
				            <input type="text" name="bio" value="" class="input is-primary" placeholder="A Short Bio about yourself">
				            <span class="icon is-small is-left">
											<i class="fa fa-pencil" aria-hidden="true"></i>
				            </span>
				          </p>
				        </div>
			        	<center><button type="submit" class="button is-primary is-medium">Save Changes</button></center>
			        </form>
							</div>
							<div class="column is-2"></div>

						</div>
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
