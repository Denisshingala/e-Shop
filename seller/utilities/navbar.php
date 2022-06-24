<nav class="d-flex align-items-center" style="justify-content: space-between;">
    <div>
        <a class="navbar-brand" href="#" style="margin: 0 50px;">
            <img src="../images/logo.png" alt="e-shop" width="140" height="120">
        </a>
    </div>
    <form action="../action/logout.php">
    <?php
    if(isset($_SESSION['email'])) {
        echo $_SESSION['email'];
    }
    ?>
        <button class="btn btn-danger" style="margin: 0 50px;">Logout</button>
    </div>
</nav>
<hr style="margin:0;">