<?php
// generic header for all pages
// has logout or login button depending on the string passed in

function makeHeader($type) {
    if ($type == "loggedIn") {
$header = '
<header class="site-header">
    <div class="logo-area">
        <a href="../index.php" class="site-logo">
        <img src="../css/assets/calendar-dots.svg" alt="" class="site-logo-icon" />
        <h1 class="site-logo-text">Burvents</h1>
        </a>
    </div>
    <nav class="account-actions" id="nav-header">
        <li> <a href="../pages/account.php"> Account </a> </li>
        <li> <a href="../helpers/logout.php"> Logout </a> </li>
    </nav>
</header>
';
}
else if ($type == "loggedOut") {
    $header = '
    <header class="site-header">
    <div class="logo-area">
        <a href="../index.php" class="site-logo">
        <img src="../css/assets/calendar-dots.svg" alt="" class="site-logo-icon" />
        <h1 class="site-logo-text">Burvents</h1>
        </a>
    </div>
    <nav class="account-actions" id="nav-header">
        <li> <a href="../pages/account.php"> Account </a> </li>
        <li> <a href="../pages/login.php"> Log In </a> </li>
    </nav>
</header>
';
}
return $header;
}
?>