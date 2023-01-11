<?php
echo '
<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
<a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
</a>
<div class="navbar-nav align-items-center ms-auto">
    <div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            <span class="d-none d-lg-inline-flex">'.$_SESSION['username'].'</span>
        </a>
        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
            <a href="account.php" class="dropdown-item">'.$lang['usersettings'].'</a>
            <a href="logout.php" class="dropdown-item">'.$lang['logout'].'</a>
        </div>
    </div>
</div>
</nav>
';
?>