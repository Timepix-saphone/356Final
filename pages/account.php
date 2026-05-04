<?php
//welcome page after logging in
session_start();

require '../helpers/checkLogin.php';
require '../helpers/sessionTimer.php';
require_once '../helpers/header.php';

// checkLogin();
// sessionTimer();
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Account Info</title>

  <link rel="stylesheet" href="../css/styles.css" />
  <link rel="stylesheet" href="../css/main.css" />
  <link rel="stylesheet" href="../css/account.css" />
</head>
<body>
    <?php
    if (array_key_exists('username', $_SESSION)) {
        ?>
            <?=makeHeader("loggedIn");?>
        <?php
    } else {
        ?>
            <?=makeHeader("loggedOut");?> 
        <?php   
    }
    ?>

    <main class="account-page">
        <section class="account-card">
            <div class="account-card-header">
                <div class="account-card-header">
                    <h2 class="account-title">Account Info</h2>
            </div>

            <div class="account-fields">
                <div class="account-field"><span class="field-label">User Name:</span></div>
                <div class="account-field"><span class="field-label">First Name:</span></div>
                <div class="account-field"><span class="field-label">Last Name:</span></div>
                <div class="account-field"><span class="field-label">Email Name:</span></div>
                <div class="account-field"><span class="field-label">Password Name:</span></div>
                <div class="account-field"><span class="field-label">Status Name:</span></div>
            </div>
        </section>
    </main>

</body>
<?php
include_once '../helpers/footer.html';
?>
</html>