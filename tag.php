<html>
	<?php include_once("required/head.php") ?>
	<body>
	<?php require("required/common.php"); ?>
	<?php include_once("required/nav.php") ?>
	<?php require("required/security.php") ?>

	<center>
	<?php
		// Take the query string from search.php and sanitize it.
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
		// Protection from XSS attacks and inbedded HTML.
		if (strlen($curTag)<= 1) {
			// If there is no query string, redirect to index.php
			$location = "http://" . $_SERVER['HTTP_HOST'] . "/index.php";
			echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.$location.'">';
		}
		// Otherwise print the title
		echo '<span class="tag is-primary is-large">'.$curTag.'</span>';


		$connection = mysqli_connect($host, $username, $password) or die ("Unable to connect!");
		mysqli_select_db($connection, $dbname) or die ("Unable to select database!");
		$search = $_POST["search"];
		$query = "SELECT * FROM posts WHERE tag = '$curTag' ORDER BY `posts`.`id` DESC";
		$result = mysqli_query($connection,$query) or die ("Error in query: $query. ".mysql_error());
		$result_num = mysqli_num_rows($result);
		echo '<br><br>';
		echo '<center><h2 class="title">'.$result_num.' Search Results</h2></center>';

		echo '<br><br>';


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


		mysqli_free_result($connection,$result);
		mysqli_close($connection);
		?>
		</center>
	</body>
</html>
