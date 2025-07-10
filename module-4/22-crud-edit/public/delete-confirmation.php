<?php

// Because we're using the GET method, remember that the user can muck around with the query string. To prevent any weirdness, we'll check to make sure the city ID is valid.
$city_id = filter_input(INPUT_GET, 'city', FILTER_VALIDATE_INT);
$city_name = filter_input(INPUT_GET, 'city_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$title = "Deletion Confirmation";
$introduction = "";
include 'includes/header.php';

$message = "";

// This checks to see if there is any information missing from the query string.
if (!$city_id || !$city_name) {
    $message = "<p>Please return to the <a href=\"delete.php\" class=\"link-danger\">delete page</a> and select an option from the table.</p>";
}

// If there's a query string and the user confirms that they want to delete their chosen city, we'll run this block. Remember that the query string is wiped after the user hits the submit button.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Even though these values are hidden from the user, we are sanitising them because they are coming from $_POST and they can be altered in the browser console before submission.
    $hidden_id = filter_input(INPUT_POST, 'hidden_id', FILTER_VALIDATE_INT);
    $hidden_name = filter_input(INPUT_POST, 'hidden_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($hidden_id) {
        delete_city($hidden_id);
        $message = "<p>" . urldecode($hidden_name) . " was deleted from the database.</p>";
        $city_id = NULL; // This is to make sure the confirmation / delete form doesn't appear again.
    }
}

// If a message is defined (and there should be if the query string is invalid or if the user has just finished deleting something!), we'll print it out for the user here.
if ($message) : ?>

<div class="alert alert-danger text-center" role="alert">
    <?= $message; ?>
</div>

<?php endif;

// When the user first arrives from delete.php and has something in the query string, we'll prompt them to confirm whether or not they really want to get rid of their chosen city.
if ($city_id) : ?>

<p class="text-danger lead mb-5 text-center">Are you sure that you want to delete <?= urldecode($city_name); ?>? There is no undo action.</p>

<!-- Deletion Confirmation Form -->
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="text-center">
    <!-- Hidden Values -->
    <input type="hidden" name="hidden_id" id="hidden_id" value="<?= $city_id; ?>">
    <input type="hidden" name="hidden_name" id="hidden_name" value="<?= $city_name; ?>">

    <!-- Submit Button -->
    <input type="submit" name="confirm" id="confirm" value="Yes, I'm sure." class="btn btn-danger">
</form>

<?php endif; ?>

<!-- No matter what state the page is in, we'll make sure this link is here so the user can navigate back. -->
<p class="text-center mt-5">
    <a href="delete.php" class="text-link link-dark">Return to 'Delete a City' Page</a>
</p>

<?php

include 'includes/footer.php';

?>