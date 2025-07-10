<?php

$title = "Delete a City";
$introduction = "To remove a record from our database, click 'Delete' beside the city you would like to remove. You will then be taken to a confirmation page where you can complete the deletion process.";
include 'includes/header.php';

echo "<h2 class=\"fw-light mb-3\">Current Cities in Our Database</h2>";

// We've modified this function so that we can include a callback function. This will allow us to generate all of the unique links and query strings we need to take the user to the delete-confirmation page with the information for the city they would like to delete.
generate_table(function($city) {
    // These variables will only have values assigned to them when the parent function, generate_table(), is called. This is because they are assigned by extracting each record in the foreach() loop.
    $cid = $city['cid'];
    $city_name = $city['city_name'];
    return "<a href=\"delete-confirmation.php?city=" . urlencode($cid) . "&city_name=" . urlencode($city_name) . "\" class=\"btn btn-danger\">Delete</a>";
});

include 'includes/footer.php';

?>