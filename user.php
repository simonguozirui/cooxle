<html>
	<?php include_once("required/head.php") ?>
	<body>
	<?php require("required/common.php"); ?>
	<?php include_once("required/nav.php") ?>
	<div class="post-container">
		<center>
			<?php
				if(empty($_SESSION['user'])) {

					// If they are not, we redirect them to the login page.
					$location = "http://" . $_SERVER['HTTP_HOST'] . "/login.php";
					echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.$location.'">';
					//exit;

			       	// Remember that this die statement is absolutely critical.  Without it,
			       	// people can view your members-only content without logging in.
			       	die("<center><div class='notification is-danger'>
		              		Redirecting to login
		            		</div></center>");
			   	}
			?>
			<h1 class="title">
				<?php

					$clientname = $_SERVER['QUERY_STRING'];
					if (strlen($clientname)< 1) {
						$location = "http://" . $_SERVER['HTTP_HOST'] . "/index.php";
						echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.$location.'">';
					}
					echo "User: $clientname";

				?>
			</h1>
			<hr>
		</center>
	</div>
	<?php

		if(empty($_SESSION['user'])) {

			// If they are not, we redirect them to the login page.
			$location = "http://" . $_SERVER['HTTP_HOST'] . "/login.php";
			echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.$location.'">';
			//exit;

        	// Remember that this die statement is absolutely critical.  Without it,
        	// people can view your members-only content without logging in.
        	die("Redirecting to login.php");
    	}

		// To access $_SESSION['user'] values put in an array, show user his username

		// open connection
		$connection = mysqli_connect($host, $username, $password) or die ("Unable to connect!");

		// select database
		mysqli_select_db($connection, $dbname) or die ("Unable to select database!");

		// create query
		$search = $_POST["search"];

		$query = "SELECT * FROM symbols WHERE username = '$clientname' ORDER BY `symbols`.`id` DESC";

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
    				$tagText = '<a href="tag.php?'.$tag.'"><span class="tag is-primary is-small">'.$tag.'</span></a>';
    			}
    			// post html using css classes and string concatnation
    			echo '<div class="column is-half is-offset-one-quarter"><div class="box"><article class="media">
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
					</article></div></div></div>';
    		}
		    echo "</div></div>";
		} else {

    		// print status message
    		echo '<div class="columns is-mobile"><div class="column is-half is-offset-one-quarter"><div class="notification is-danger">No posts found</div></div></div>';
		}

		// free result set memory
		mysqli_free_result($connection,$result);
		mysqli_close($connection);
		?>
		<?php include_once('required/footer.php'); ?>
	</body>
</html>