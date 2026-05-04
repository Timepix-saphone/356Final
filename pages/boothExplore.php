<?php
session_start();



require_once '../helpers/checkLogin.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once '../helpers/sessionTimer.php';
require_once '../helpers/header.php';
require_once '../helpers/supabase.php';

$pageTitle = "Explore Booths";

$supabase = initializeSupabase();

//checkLogin();
//sessionTimer();

if (array_key_exists('user_id', $_SESSION)) {

    $event_id = $_GET['event_id'] ?? null;

    if (!$event_id) {
        header('Location: observerHome.php');
        exit();
    }

    $booth_query = $supabase->query
        ->from('booth')
        ->select('*')
        ->eq('event_id', $event_id)
        ->execute();

    $booth = parseQueryArray($booth_query);


}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link href="https://nrs-projects.humboldt.edu/~st10/styles/normalize.css"
          type="text/css" rel="stylesheet" />
    <link href="https://nrs-projects.humboldt.edu/~jb715/woops/styles.css"
          type="text/css" rel="stylesheet" />
</head>
<body>

    <!-- Main page wrapper -->
    <div class="page-container">

        <!-- Site header -->
        <header class="site-header">
            <div class="logo-area">
                <h1 class="site-logo">Burvents</h1>
            </div>

            <div class="account-actions">
                <!-- Future PHP login/account status can go here -->
                <a href="create-account.php" class="btn btn-primary">Create Account</a>
            </div>
        </header>

        <!-- Navigation / page intro -->
        <main class="main-content">
            <section class="hero-section">
                <h2>Booth Explore</h2>
                <p>
                    Here are some booths that we are going to have at that **REPLACE WITH PHP events**!
                </p>
                
                <section class="info-section">
                    <p>We are going to be having **PHP CALL TO TOTAL AMOUNT OF BOOTHS** at the event!</p>
                
                </section>
                
            </section>

            <section class = "register-event-btn">

                <a href="event-registration.php" class="btn">Register for the Event</a>
            </section>



            <!-- Main role / feature call's to sql in a table, should have the table grow with the events, will add more css later down week -->
            <section class="event-table">
                
                <!-- added this inline just for display, plz remove later-->
                <table border="1" cellpadding="8" cellspacing="0">
                    


                    <thead>
                        <tr>
                            <th>Booth ID</th>
                            <th>Booth Building</th>
                            <th>Booth Event</th>
                            <th>Booth Number</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr>
                            <!-- Ideally this would be a call to name-->
                            <td>**PHP CALL TOO BOOTH ID**</td>
                            <td><?= htmlentities($event['booth_building']) ?></td>

                            <td>**PHP CALL TOO BOOTH EVENT**</td>
                            <td>?=  htmlentities($event['booth_number'])?></td>
                        </tr>

                    </tbody>
                
                </table>
            
            </section>


        </main>

        <!-- Footer -->
        <footer class="site-footer">
            <nav class="footer-nav">
                <a href="#">Feedback</a>
                <a href="#">Contact Us</a>
                <a href="#">Social Media</a>
            </nav>
        </footer>

    </div>

</body>
</html>