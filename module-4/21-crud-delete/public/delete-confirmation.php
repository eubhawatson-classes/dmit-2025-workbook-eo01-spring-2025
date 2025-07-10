<?php

// Because we're using the GET method, remember that the user can muck around with the query string. To prevent any weirdness, we'll check to make sure the city ID is valid.
$city_id = filter_input(INPUT_GET, 'city', FILTER_VALIDATE_INT);
$city_name = filter_input(INPUT_GET, 'city_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$title = "Deletion Confirmation";
$introduction = "";
include 'includes/header.php';

$message = "";

include 'includes/footer.php';

?>