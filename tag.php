<html>
	<?php include_once("head.php") ?>
	<body>
	<?php require("common.php"); ?>
	<?php include_once("nav.php") ?>

	<center>
		<?php
			if(empty($_SESSION['user'])) {

				$location = "http://" . $_SERVER['HTTP_HOST'] . "/login.php";
				echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.$location.'">';
				//exit;

		       	die("<center><div class='notification is-danger'>
	              		Redirecting to login
	            		</div></center>");
		   	}
		?>
		<h1 class="title">
			<?php

				$curTag = $_SERVER['QUERY_STRING'];
				echo '<span class="tag is-primary is-large">'.$curTag.'</span>';
			?>
		</h1>
		<hr>
	</center>
	<?php

		if(empty($_SESSION['user'])) {

			$location = "http://" . $_SERVER['HTTP_HOST'] . "/login.php";
			echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.$location.'">';
			//exit;

        	die("Redirecting to login.php");
    	}


		$connection = mysqli_connect($host, $username, $password) or die ("Unable to connect!");

		mysqli_select_db($connection, $dbname) or die ("Unable to select database!");

		$search = $_POST["search"];

		$query = "SELECT * FROM symbols WHERE country = '$curTag'";

		$result = mysqli_query($connection,$query) or die ("Error in query: $query. ".mysql_error());

		if (mysqli_num_rows($result) > 0) {

    		// print them one after another
    		echo '<div class="post-container">';
    		while($row = mysqli_fetch_row($result)) {
    			$tag = $row[1];
    			$id = $row[0];
    			$text = $row[2];
    			$usr = $row[3];
    			$tagText = "";
    			if ($tag != "") {
    				$tagText = '<a href="tag.php?'.$tag.'"><span class="tag is-primary is-small">'.$tag.'</span></a>';
    			}
    			echo '<div class="box"><article class="media">
  						<figure class="media-left">
    						<p class="image is-64x64">
						      <img src="http://bulma.io/images/placeholders/128x128.png">
						    </p>
						</figure>
						<div class="media-content">
						 	<div class="content">
						      	<p>
						        <strong>'.$usr.'</strong> <small>ID: '.$id.'</small>
						        <br>
						        '.$text.' <br>' . $tagText.'
						      	</p>
						    </div>
						    <nav class="level is-mobile">
						    	<div class="level-left">
						        	<a class="level-item">
						          		<span class="icon is-small"><i class="fa fa-reply"></i></span>
						        	</a>
						        	<a class="level-item">
						        	  	<span class="icon is-small"><i class="fa fa-heart"></i></span>
						        	</a>
						      	</div>
						    </nav>
						</div>
					</article></div>';
    		}
		    echo "</div>";

		} else {

    		echo '<div class="columns is-mobile"><div class="column is-half is-offset-one-quarter"><div class="notification is-danger">No posts found</div></div></div>';
		}

		mysqli_free_result($connection,$result);
		mysqli_close($connection);
		?>
		<?php include_once('required/footer.php'); ?>
	</body>
</html>