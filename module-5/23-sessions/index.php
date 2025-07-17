<?php

// Any time we want to access, use, or modify session data, we need to call this method. If a session already exists, it will allow us access to it; if not, it will start one. However, if it is not included, you will not be able to access your session.
session_start();

// We need some way for PHP to forget us again.
if (isset($_POST['forget'])) {
    // This method removes all session variables from $_SESSION.
    session_unset(); 
    // This goes one step further and destroys any active session.
    session_destroy();

    // After we're done modifying our session, we can refresh the page.
    header("Refresh: 0"); // The '0' means we do not wait or delay before refreshing.
}

if (isset($_POST['form-submit']) && isset($_POST['username'])) {
    // This takes whatever the user provided us with and stores it in our session.
    $_SESSION['username'] = $_POST['username'];
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sessions</title>

    <!-- BS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>

<body class="bg-secondary">
    <main class="container d-flex justify-content-center align-items-center min-vh-100 p-3">
        <section class="row">
            <div class="col bg-white rounded p-5">
                
                <?php if (!isset($_SESSION['username'])) : ?>
                <!-- Here, we'll present the form to the user if they have not already given us their name. -->
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <h1 class="mb-3 fw-normal">This could be the start of something wonderful.</h1>

                    <div class="my-5">
                        <label for="username" class="form-label">What's your name?</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Jack Pott" required>
                    </div>

                    <input type="submit" name="form-submit" id="form-submit" class="btn btn-primary" value="Let's do it!">
                </form>

                <?php else: ?>
                    <!-- If there use a username in our session, let's greet the user instead. -->
                     <h1 class="mb-3 fw-normal">Hello, <?= $_SESSION['username']; ?>!</h1>
                     <p class="lead text-muted">It's good to see you again.</p>
                     <p>It's currently <?= date("l"); ?> at <?= date("h:i:sa"); ?>.</p>
                <?php endif; 

                if (isset($_SESSION['last-time'])) : ?>
                    <!-- If the user has visited the page before (during an active session), we'll also tell them when that was. -->
                    <p>The last time we saw each other was <?= $_SESSION['last-time']; ?>.</p>

                <?php endif;
                
                // This grabs the current date and time so that we can tell the user this is when they last visited the page.
                $_SESSION['last-time'] = date("Y/m/d h:i:sa");
                
                if (isset($_SESSION['username'])) : ?>

                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <input type="submit" name="forget" id="forget" class="btn btn-danger mt-5" value="Forget me.">
                    </form>

                <?php endif; ?>
            </div> <!-- end of column -->
        </section>
    </main>
</body>

</html>