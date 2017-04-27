<nav class="nav has-shadow">
    <div class="container">
        <div class="nav-left">
            <a class="nav-item" href="index.php">
             <img src="http://bulma.io/images/bulma-logo.png" alt="Bulma logo">
            </a>
            <a class="nav-item is-tab is-active" href="index.php">Home</a>
            <a class="nav-item is-tab" href="login.php">Login</a>
            <p class="nav-item">
                <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <p class="control">
                        <input class="input" type="text" placeholder="Text input">
                    </p>
                </form>
            </p>
        </div>
        <div class="nav-right">
            <a class="nav-item is-tab" href="logout.php">Log Out</a>
        </div>
  </div>
</nav>
<br>