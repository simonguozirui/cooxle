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
							// $profileid = $profile_query_result_row[2];
							// $current_profile_id = (int)$profileid;
							// echo $current_profile_id;

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
								echo '<form action="user.php" method="POST"><input type="submit" name="follow" class="button is-primary is-medium" value="follow"/>';
								if($_POST['follow']) {
									echo '<script>alert("hello");</script>';
									$profile_id_query = "SELECT id FROM users where username = '$clientname'";
									$profile_id_query_result = mysqli_query($connection,$profile_id_query) or die ("Error in query: $profile_id_query. ".mysqli_error());
									$profile_id_query_result_row = mysqli_fetch_row($profile_id_query_result);
									$profileid = $profile_id_query_result_row[0];
									$current_profile_id = (int)$profileid;
									echo $current_profile_id;
									echo $current_profile_id;
									$follow_query = "SELECT followerid, followingid FROM follow where followerid = $clientid and followingid = 5";
									echo $follow_query;
									$follow_result = mysqli_query($connection,$follow_query) or die ("Error in query: $follow_query. ".mysqli_error());
									if (mysqli_num_rows($follow_result) > 0) {
										$follow_delete_query = "DELETE FROM follow WHERE followerid = $clientid and followingid = 5";
										$follow_delete_result = mysqli_query($connection,$follow_delete_query) or die ("Error in query: $follow_delete_query. ".mysql_error());
										echo '<input type="submit" name="follow" class="button is-primary is-medium" value="Followed"/>';
									}else{
										$follow_add_query = "INSERT INTO likes(followerid, followingid) VALUES ($clientid,5)";
										$follow_add_result = mysqli_query($connection,$follow_add_query) or die ("Error in query: $follow_add_query. ".mysql_error());
										echo '<input type="submit" name="follow" class="button is-danger is-medium" value="Unfollow"/>';
									}
								}else{
									echo '<i class="fa fa-thumbs-o-up" aria-hidden="true" style="color:#3273DC;"></i>';
								}
								echo'</form>';
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
			        	<center><button type="submit" class="button is-primary is-medium" name="submit_edit" value="submit_edit">Save Changes</button></center>
			        </form>
							</div>
							<div class="column is-2"></div>
						</div>
						<?php
							if($_POST['submit_edit']) {
								$pic = $_POST["pic"];
								$bio = $_POST["bio"];
								// echo $pic;
								// echo $bio;
								if ($pic != ''){
									$pic_update_query = "UPDATE users SET pic = '$pic' WHERE username = '$clientid_name'";
									$pic_update_result = mysqli_query($connection,$pic_update_query) or die ("Error in query: $pic_update_query. ".mysql_error());
									echo '<center><div class="notification is-success">
			            Your Profile Picture is Updated<br>
			            </div></center>';
								}

								if ($bio != ''){
									$bio_update_query = "UPDATE users SET bio = '$bio' WHERE username = '$clientid_name'";
									$bio_update_result = mysqli_query($connection,$bio_update_query) or die ("Error in query: $bio_update_query. ".mysql_error());
									echo '<center><div class="notification is-success">
									Your Bio is Updated<br>
									</div></center>';
								}
							}
						?>

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

		// free up memory from sql data.
		mysqli_free_result($connection,$result);
		mysqli_close($connection);
		?>

	</body>
</html>
