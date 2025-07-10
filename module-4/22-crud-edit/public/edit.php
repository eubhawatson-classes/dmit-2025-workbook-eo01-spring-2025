<?php

$title = "Edit a City";
$introduction = "To edit a record in our database, click 'Edit' beside the city you would like to change. Next, add the updated information into the form and hit 'Save'.";
include 'includes/header.php';

// We need to initialise a bunch of variables because we're dealing with multiple sets of data! We'll start by checking to see if there's a primary key in the query string.
$city_id = $_GET['city_id'] ?? $_POST['city-id'] ?? "";

// If there's a primary key (i.e. the user has chosen a city to edit), we need to fetch the details for that record (i.e. the values that already exist in the database).

// Next, we'll define variables for all of the pre-existing values for the city.

// Finally, we'll initialise variables for all of the values from the user (i.e. whatever they give us in the form).

echo "<h2 class=\"fw-light mb-3\">Current Cities in Our Database</h2>";

generate_table(function($city) {
    $cid = $city['cid'];
    return "<a href=\"edit.php?city_id=" . urlencode($cid) . "\" class=\"btn btn-warning\">Edit</a>";
});

include 'includes/footer.php';

?>