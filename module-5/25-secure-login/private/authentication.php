<?php

/**
 * SESSION START & CONNECTION HANDLE
 */

session_start();

require_once dirname(__DIR__, 3) . '/data/connect.php';
$connection = db_connect();

/**
 * Authenticate user based on provided username and password.
 * 
 * @param string $username;
 * @param string $password;
 * @return BOOL returns true or false.
 */

function authenticate($username, $password) {
    global $connection;

    $statement = $connection->prepare("SELECT * FROM users WHERE users = ?;");

    if (!$statement) {
        // We only want to include error codes and stack traces like this when developing, not in production. 
        die("Prepare failed: " . $connection->error);
    }

    $statement->bind_param("s", $username);
    $statement->execute();

    // This mysqli method fetches all of the records that we just grabbed (in this case, it's just one record, but it can be multiple) and stored them into PHP's memory instead of streaming them row by row from the server. PHP's memory is wiped once it's finished executing a script.
    $statement->store_result();

    if ($statement->num_rows > 0) {
        // Because we stashed our result in memory, we can create variables from the column names and use the data with these two methods.
        $statement->bind_result($account_id, $hashed_pass);
        $statement->fetch();

        if (password_verify($password, $hashed_pass)) {
            // If the username is found and the password is verified, we need to set some things up in the browsing session so that we can recognise the user as authenticated (logged in).
            
            // This resets the session ID and data to prevent session hijacking attacks.
            session_regenerate_id(TRUE);

            $_SESSION['user_id'] = $account_id;
            $_SESSION['username'] = $username;
            $_SESSION['last_regeneration'] = time();

            return TRUE;
        }
    }

    return FALSE;
}

/**
 * Checks to see if a user is currently logged in.
 */
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

/**
 * Redirect the user if they're not authenticated (not logged in).
 * 
 * Note: We want to call this function at the top of any page that we want locked-down or secured (i.e. private, not accessible to the public), like our admin area.
 */
function require_login() {
    if (!is_logged_in()) {
        // If the user is not logged in, we'll send them to the login page.
        header("Location: login.php");
        // This kills the rest of the script and prevents anything from rendering client-side (no HTML output for a page the user shouldn't see).
        exit();
    }
}

/**
 * This logs the user out by destroying session data (which we use to see if the user is authenticated).
 */
function logout() {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

?>