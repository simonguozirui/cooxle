<nav class="nav has-shadow">
    <div class="container">
        <div class="nav-left">

            <a class="nav-item is-tab" href="index.php">
                <img src="img/logo.png" alt="logo">
            </a>
            <a class="nav-item is-tab" href="index.php">Feeds</a>
            <a class="nav-item is-tab" href="search.php">Search</a>
            <a class="nav-item is-tab" href="about.php" target="_blank">About</a>
        </div>
        <div class="nav-right">
          <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <div class="field has-addons" style="padding:10;">
              <p class="control">
                <span class="select">
                  <select>
                    <option>user</option>
                    <option>tag</option>
                  </select>
                </span>
              </p>
              <p class="control">
                <input name="tag-lookup" class="input" type="text" placeholder="Search for tags"> -->
                <!-- <input name="user-lookup" class="input" type="text" placeholder="Search for users"> -->
              </p>
              <p class="control">
                <input class="button" type="submit" name="submit" value="search">
              </p>
            </div>
           </form>

            <?php
          		// Save the POST requests.
          		$searchTags = $_POST["tag-lookup"];
          		$searchUser = $_POST["user-lookup"];

          		// if the person looks up a tag
          		if ($searchTags != '') {
          			// redirect them to tag.php with the tag name as the query string
          			$location = "http://" . $_SERVER['HTTP_HOST'] . "/tag.php?".$searchTags;
          			echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.htmlentities($location, ENT_QUOTES, 'UTF-8').'">';
          		}
          		// if the person looks up a user
          		elseif ($searchUser != '') {
          			// redirect them to user.php with the username as the query string
          			$location = "http://" . $_SERVER['HTTP_HOST'] ."user.php?".$searchUser;
                echo $location;
                echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.htmlentities($location, ENT_QUOTES, 'UTF-8').'">';
          		}
          	?>



            <?php $arr = array_values($_SESSION['user']); ?>
            <a class="nav-item is-tab" href="user.php?<?php echo $arr[1];?>">
                <?php echo $arr[1];?>
            </a>
            <a class="nav-item is-tab" href="logout.php">Log Out</a>
        </div>
  </div>
</nav>
<br>
