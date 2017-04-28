<html>
	<?php include_once("head.php") ?>
	<body>
	<?php require("common.php"); ?>
	<?php include_once("nav.php") ?>

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

		    	$arr = array_values($_SESSION['user']);
				$clientname = $arr[1];
				$email = $arr[2];
				echo "Welcome " . $clientname;
			?>
		</h1>
		<hr>
	</center>
	<div class="columns is-mobile">
		<div class="column is-one-quarter is-offset-one-quarter">

			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
		    	<label class="label">Post tag: </label>
		    	<div class="control"><input class="input" type="text" placeholder="&#x21AA;" name="country"></div>

		    	<label class="label">Post text:</label>
		    	<div class="control">
		    		<input class="input" type="text" placeholder="&#x21AA;" name="animal">
		    	</div>
		    	<br>
		    	<input class="button is-primary" type="submit" name="submit">
		    </form>
		</div>
		<div class="column is-one-quarter">
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<label class="label">Search</label>
                <p class="control">
           	        <input name="search" class="input" type="text" placeholder="Search for tags">
                </p>
                <br>
                <input class="button is-primary" type="submit" name="submit">
   	        </form>
		</div>
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

		$query = "SELECT * FROM symbols";
		if ($_POST["search"] != '') {
			echo '<div class="columns"><div class="column is-half is-offset-one-quarter"><div class="notification">Search results for '.$search.'<br><a href="index.php">Back</a></div></div></div>';
			$query  = "SELECT * FROM symbols WHERE `country` = '$search'";
		}

		// execute query
		$result = mysqli_query($connection,$query) or die ("Error in query: $query. ".mysql_error());
		// $result = array_reverse($initial);
		// see if any rows were returned


		if (mysqli_num_rows($result) > 0) {

    		// print them one after another
    		echo '<div class="columns"><div class="column is-half is-offset-one-quarter">';
    		while($row = mysqli_fetch_row($result)) {
    			$tag = $row[1];
    			$id = $row[0];
    			$text = $row[2];
    			$usr = $row[3];
    			$tagText = "";
    			if ($tag != "") {
    				$tagText = '<span class="tag is-primary is-small">'.$tag.'</span>';
    			}
    			echo '<article class="media">
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
					</article><hr><br>';
    		}
		    echo "</div></div>";

		} else {

    		// print status message
    		echo '<div class="columns is-mobile"><div class="column is-half is-offset-one-quarter"><div class="notification is-danger">No rows found</div></div></div>';
		}

		// free result set memory
		mysqli_free_result($connection,$result);

		// set variable values to HTML form inputs
		$postTags = $_POST['country'];
		$postTags = strtolower($postTags);
    	$postText = $_POST['animal'];

		// check to see if user has entered anything
		if ($postText != "") {
	 		// build SQL query
			$query = "INSERT INTO symbols (country, animal, username) VALUES ('$postTags', '$postText', '$clientname')";
			// run the query
     		$result = mysqli_query($connection,$query) or die ("Error in query: $query. ".mysql_error());
			// refresh the page to show new update
	 		echo "<meta http-equiv='refresh' content='0'>";
		}

		// if DELETE pressed, set an id, if id is set then delete it from DB
		// if (isset($_GET['id'])) {

		// 	// create query to delete record
		// 	echo $_SERVER['PHP_SELF'];
  //   		$query = "DELETE FROM symbols WHERE id = ".$_GET['id'];

		// 	// run the query
  //    		$result = mysqli_query($connection,$query) or die ("Error in query: $query. ".mysql_error());

		// 	// reset the url to remove id $_GET variable
		// 	$location = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
		// 	echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.$location.'">';
		// 	exit;

		// }


		// close connection
		mysqli_close($connection);

	?>

	</body>
</html>