<nav class="d-flex align-items-center" style="justify-content: space-between; height: 15vh">
    <div>
        <a class="navbar-brand" href="#" style="margin: 0 50px;">
            <img src="../images/logo.png" alt="e-shop" width="100" height="100">
        </a>
    </div>
    <?php
    if(isset($_SESSION['email'])) {
        echo $_SESSION['email'];
    }
    ?>
    <form action="../action/logout.php">
        <button class="btn btn-danger" style="margin: 0 50px;">Logout</button>
    </form>  
</nav>
<hr style="margin:0;">