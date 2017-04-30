<nav class="nav has-shadow">
    <div class="container">
        <div class="nav-left">

            <a class="nav-item" href="index.php">
                <img src="img/logo.png" alt="logo">
            </a>
        </div>
        <div class="nav-right">
            <?php $arr = array_values($_SESSION['user']); ?>
            <a class="nav-item is-tab" href="user.php?<?php echo $arr[1];?>">


                <?php echo $arr[1];?>

            </a>
            <a class="nav-item is-tab" href="logout.php">Log Out</a>
        </div>
  </div>
</nav>
<br>