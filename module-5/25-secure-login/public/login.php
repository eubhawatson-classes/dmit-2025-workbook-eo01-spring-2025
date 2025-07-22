<?php

/**
 * STEPS FOR LOGGING IN A USER:
 * 
 * 1. The user will provide credentials with a form.
 * 2. Our script will search for the username in the database.
 * 3. If the username is found, our script will compare the submitted password with the stored hash in the database.
 * 4. If the verification is successful, the script will then set a value in the $_SESSION to the user ID and redirects to a post-login page (in our case, admin.php).
 */

require_once '../private/authentication.php';

// If the user is already authenticated, they shouldn't be allowed on this page. They don't need to log in again.
if (is_logged_in()) {
    header("Location: admin.php");
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (authenticate($username, $password)) {
        header("Location: admin.php");
        exit();
    } else {
        // Although it's not best practice to give vague error messages on most web forms, we want to be a little vague here so that the user cannot fish for usernames or email addresses on a secure application. 
        $error = "Invalid username or password.";
    }
}

$title = "Login Page";
$introduction = "Please log in using your provided credentials to access your account. If you enter incorrect details, you will receive an error message. Once logged in, you'll be redirected to the admin area.";
include 'includes/header.php';

// If there are any errors, we'll echo them out to the user at the top.
if (!empty($error)) echo "<p class=\"text-center text-danger\">$error</p>";

?>

<!-- With login forms, we can only use the POST method, not GET, because we don't want PII in the URL. -->
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="border border-secondary-subtle shadow-sm rounded p-3">
    <h2 class="fw-light my-3">Login Form</h2>

    <!-- Username -->
     <div class="mb-3">
        <label for="username" class="form-label">Username:</label>
        <input type="text" name="username" id="username" class="form-control" required>
     </div>

    <!-- Password -->
     <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input type="text" name="password" id="password" class="form-control" required>
     </div>

    <!-- Submit -->
     <input type="submit" id="submit" name="submit" value="Log In" class="btn btn-success my-3">
</form>

<?php

include 'includes/footer.php';

?>