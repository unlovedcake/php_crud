<?php

//$currentPage = basename($_SERVER['PHP_SELF']);
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
?>


<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">My Sample Web Site</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="nav-link <?php echo ($action == 'read') ? 'active' : ''; ?>"><a href="index.php?action=read">Home</a></li>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Page 1-1</a></li>
                    <li><a href="#">Page 1-2</a></li>
                    <li><a href="#">Page 1-3</a></li>
                </ul>
            </li>
            <li><a href="#">Page 2</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="nav-link <?php echo ($action == 'register') ? 'active' : ''; ?>"><a href="index.php?action=register"><span class="glyphicon glyphicon-user"></span> Register</a></li>
            <li class="nav-link <?php echo ($action == 'login') ? 'active' : ''; ?>"><a href="index.php?action=login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
    </div>
</nav>

<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php?action=read">MyApp</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?php echo ($action == 'read') ? 'active' : ''; ?>" href="index.php?action=read">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo ($action == 'login') ? 'active' : ''; ?>" href="index.php?action=login">Login</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo ($action == 'register') ? 'active' : ''; ?>" href="index.php?action=register">Register</a>
            </li>
        </ul>
    </div>
</nav> -->