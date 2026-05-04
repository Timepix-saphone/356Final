<?php
session_start();

$pageTitle = "Speaker Proposal Register";

require_once '../helpers/checkLogin.php';
require_once '../helpers/sessionTimer.php';
require_once '../helpers/header.php';
require      '../vendor/autoload.php';
require_once '../helpers/supabase.php';

//UNCOMMENT FOR PRODUCTION
//checkLogin();
//sessionTimer();

$supabase = initializeSupabase();
$message = null;

function sanitize($value) {
    return htmlspecialchars(stripslashes(trim($value)));
}

if ($_SESSION['is_speaker']) {

    $current_event_query = $supabase->from('event')
                           ->select('event_id')
                           ->execute();

    $current_event = parseQuery($current_event_query);
    $event_id = $current_event['event_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $proposalName  = sanitize($_POST["proposalName"]);
        $proposalTopic = sanitize($_POST["proposalTopic"]);
        $proposalDesc  = sanitize($_POST["proposalDescription"]);

        if (empty($proposalName) || empty($proposalTopic) || empty($proposalDesc)) {
            $message = "All fields required.";
        } else {
            try {
                $response = $supabase->from('proposal')->insert([
                    'speaker_id'           => $_SESSION['user_id'],
                    'event_id'             => $event_id,
                    'proposal_status'      => 'Submitted',
                    'is_approved'          => false,
                    'proposal_name'        => $proposalName,
                    'proposal_topic'       => $proposalTopic,
                    'proposal_description' => $proposalDesc
                ])->execute();

                $message = "Proposal submitted successfully!";
            } catch (Exception $e) {
                $message = "Error submitting form: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link href="../css/main.css"
          type="text/css" rel="stylesheet" />
    <link href="../css/styles.css"
          type="text/css" rel="stylesheet" />
</head>
<body>

<!-- Header -->
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




    <!-- Main page wrapper -->
    <div class="page-container">


        <!-- Navigation / page intro -->
        <main class="main-content">
            <section class="hero-section">
                
            </section>

            <!-- Speaker proposal registration form -->
            <section class="speaker-register-board">
                
                <?php if ($message): ?>
                    <p class="form-message"><?= $message ?></p>

                <?php endif; ?>

                <form action="" method="POST"> 
                    <div class="form-group">
                        <label for="userLastName">Last Name</label>

                        <input type="text" id="userLastName" name="userLastName" required>
                    </div>

                    <div class="form-group">
                        <label for="userEmail">Email</label>

                        <input type="email" id="userEmail" name="userEmail" required>
                    </div>

                    <div class="form-group">
                        <label for="eventName">Event Name</label>

                        <input type="text" id="eventName" name="eventName" required>
                    </div>

                    <div class="form-group">
                        <label for="proposalName">Proposal Name</label>

                        <input type="text" id="proposalName" name="proposalName" required>
                    </div>

                    <div class="form-group">
                        <label for="proposalTopic">Proposal Topic</label>

                        <input type="text" id="proposalTopic" name="proposalTopic" required>
                    </div>

                    <div class="form-group full-width">
                        <label for="proposalDescription">Proposal Description</label>
                        
                        <textarea id="proposalDescription" name="proposalDescription" rows="5" required></textarea>
                    </div>

                    <div class="form-group full-width">

                        <button type="submit" class="btn">Submit Proposal</button>
                    </div>

                </form>
            </section>
            <!-- Placeholder for announcements or future dynamic content -->
            <section class="info-section">
                
            </section>
        </main>
        <!-- Footer -->
        <footer class="site-footer">
            <?php
                include_once '../helpers/footer.html';
            ?>
        </footer>
    </div>
</body>
</html>