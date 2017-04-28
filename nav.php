<nav class="nav has-shadow">
    <div class="container">
        <div class="nav-left">

            <a class="nav-item" href="index.php">
                <img src="img/logo.png" alt="logo">
            </a>
        </div>
        <div class="nav-right">
            <a class="nav-item is-tab">
                <?php
                    $arr = array_values($_SESSION['user']);
                    echo $arr[2];
                ?>
            </a>
            <a class="nav-item is-tab" href="logout.php">Log Out</a>
        </div>
  </div>
</nav>
<br>