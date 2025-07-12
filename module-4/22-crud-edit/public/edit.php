<?php

$title = "Edit a City";
$introduction = "To edit a record in our database, click 'Edit' beside the city you would like to change. Next, add the updated information into the form and hit 'Save'.";
include 'includes/header.php';

// We need to initialise a bunch of variables because we're dealing with multiple sets of data! We'll start by checking to see if there's a primary key in the query string.
$city_id = $_GET['city_id'] ?? $_POST['city-id'] ?? "";

// If there's a primary key (i.e. the user has chosen a city to edit), we need to fetch the details for that record (i.e. the values that already exist in the database).
$city = $city_id ? select_city_by_id($city_id) : NULL;

// Next, we'll define variables for all of the pre-existing values for the city.
$exisiting_city_name = $city['city_name'] ?? "";
$exisiting_province = $city['province'] ?? "";
$exisiting_population = $city['population'] ?? "";
$exisiting_capital = $city['is_capital'] ?? '0';
$exisiting_trivia = $city['trivia'] ?? "";

// Finally, we'll initialise variables for all of the values from the user (i.e. whatever they give us in the form).
$user_city_name = $_POST['city_name'] ?? "";
$user_province = $_POST['province'] ?? "";
$user_population = $_POST['population'] ?? "";
$user_capital = isset($_POST['is_capital']) ? $_POST['is_capital'] : '0';
$user_trivia = $_POST['trivia'] ?? "";

$message = "";
$alert_class = "alert-danger";

// If the user has chosen a city and submitted the form, we will process it here.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // TO DO: Add validation and update logic.
}

// If there is a message for the user (either about validation, an error, or successful submission), we'll show it here.
if ($message != ""): ?>
    <div class="alert <?= $alert_class; ?>" role="alert">
        <p><?php echo $message; ?></p>
    </div>
<?php endif;

// If the city ID is set (i.e. the user chose a city to edit), we'll show the user the form. This should high up enough on the page for the user to immediately see (and avoid confusion).
if ($city_id) : ?>

    <h2 class="fw-light mb-3">Editing <?= $exisiting_city_name; ?></h2>
    <?php include 'includes/form.php'; ?>

<? endif;

echo "<h2 class=\"fw-light mb-3 mt-5\">Current Cities in Our Database</h2>";

generate_table(function($city) {
    $cid = $city['cid'];
    return "<a href=\"edit.php?city_id=" . urlencode($cid) . "\" class=\"btn btn-warning\">Edit</a>";
});

include 'includes/footer.php';

?>