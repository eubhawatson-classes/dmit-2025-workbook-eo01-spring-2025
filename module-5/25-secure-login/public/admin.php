<?php

require_once '../private/authentication.php';

// If the user is not logged in, this function will redirect them to the login page.
require_login();

$title = 'Private Page (Admin)';
$introduction = "Welcome to the admin area! The page is only accessible to authenticated users. If you reached this page, you are successfully logged in. If you log out, you will be redirected to the home page.";
include 'includes/header.php';

include 'includes/footer.php';

?>