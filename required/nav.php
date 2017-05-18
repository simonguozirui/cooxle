<nav class="nav has-shadow">
    <div class="container">
        <div class="nav-left">

            <a class="nav-item is-tab" href="index.php">
                <img src="img/logo.png" alt="logo">
            </a>
            <a class="nav-item is-tab" href="index.php">Feeds</a>
            <!-- <a class="nav-item is-tab" href="search.php">Search</a> -->
            <a class="nav-item is-tab" href="about.php" target="_blank">About</a>
        </div>
        <div class="nav-right">
          <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <div class="field has-addons" style="padding:10;">
              <p class="control">
                <span class="select">
                  <select name="search">
                    <option value="user">user</option>
                    <option value="tag">tag</option>
                  </select>
                </span>
              </p>
              <p class="control">
                <input name="search_content" class="input" type="text" placeholder="Search in Cooxle">
                <!-- <input name="user-lookup" class="input" type="text" placeholder="Search in Cooxle"> -->
              </p>
              <p class="control">
                <input class="button" type="submit" name="submit" value="search">
              </p>
            </div>
           </form>

            <?php
              if( isset( $_POST['search'] ) ){
                if( $_POST['search'] === "user" ) {
                    $searchUser = $_POST["search_content"];
                } elseif( $_POST['search'] === "tag" ) {
                    $searchTags = $_POST["search_content"];
                }
              }

          		// if the person looks up a tag
          		if ($searchTags != '') {
          			// redirect them to tag.php with the tag name as the query string
          			$location =  "tag.php?".$searchTags;
                echo "<script>  location.href = '$location'</script>";

                // Calling die or exit after performing a redirect using the header function
                // is critical.  The rest of your PHP script will continue to execute and
                // will be sent to the user if you do not die or exit.
                die("Redirecting to index.php");
          			// echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.htmlentities($location, ENT_QUOTES, 'UTF-8').'">';
          		}
          		// if the person looks up a user
          		elseif ($searchUser != '') {
          			// redirect them to user.php with the username as the query string
          			$location = "user.php?".$searchUser;
                echo "<script>  location.href = '$location'</script>";

                // Calling die or exit after performing a redirect using the header function
                // is critical.  The rest of your PHP script will continue to execute and
                // will be sent to the user if you do not die or exit.
                die("Redirecting to index.php");
          			// echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.htmlentities($location, ENT_QUOTES, 'UTF-8').'">';
                //redirect($location, false);

                // echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.htmlentities($location, ENT_QUOTES, 'UTF-8').'">';
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
