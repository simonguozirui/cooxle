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
          <div class="field has-addons" style="padding:10;">
            <p class="control">
              <span class="select">
                <select>
                  <option>User</option>
                  <option>Tag</option>
                </select>
              </span>
            </p>
            <p class="control">
              <input class="input" type="text" placeholder="">
            </p>
            <p class="control">
              <a class="button">
                Search
              </a>
            </p>
          </div>

            <?php $arr = array_values($_SESSION['user']); ?>
            <a class="nav-item is-tab" href="user.php?<?php echo $arr[1];?>">
                <?php echo $arr[1];?>
            </a>
            <a class="nav-item is-tab" href="logout.php">Log Out</a>
        </div>
  </div>
</nav>
<br>
