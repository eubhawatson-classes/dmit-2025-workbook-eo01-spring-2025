<?php

$title = "Add a City";
$introduction = "To add a city to our database, simply fill out the form below and hit 'Save'.";
include 'includes/header.php';

// If nothing is selected for whether or not the city is a capital, we'll default to 'no'.
$capital = isset($_POST['capital']) ? $_POST['capital'] : '0';
$message = "";

if (isset($_POST['submit'])) {

    $alert_class = "alert-danger";

    // We'll call our validation function here. Remember that the array with the provincial abbreviations is in the validation script.
    $validation_result = validate_city_input($_POST['city-name'], $_POST['province'], $_POST['population'], $capital, $_POST['trivia'], $provincial_abbr);

    if ($validation_result['is_valid']) {
        $data = $validation_result['data'];

        if (insert_city($data['city_name'], $data['province'], $data['population'], $data['capital'], $data['trivia'])) {
            // If we're successful, we'll print a message telling the user as much and make the alert box green.
            $message = "Your city was successfully added to our database.";
            $alert_class = "alert-success";

            // We can also clear our input here to prevent duplicate entries.
            // $city_name = $province = $population = $trivia = "";

        } else {
            $message = "There was a problem adding your city: " . $connection->error;
        }

    } else {
        // If the data is invalid, we'll implode our array of error messages. Because of the way things are printed in the alert box (and the fact that each error is just a string with no HTML syntax), we are separating each message with a closing and opening paragraph tag.
        $message = implode("</p><p>", $validation_result['errors']);
    } // end of validation handling
} // end of 'if the user submitted the form'

if ($message != "") : ?>

    <div class="alert p-3 <?= $alert_class ?? 'alert-danger'; ?>" role="alert">
        <p><?= $message; ?></p>
    </div>

<?php endif;

include 'includes/form.php';

include 'includes/footer.php';

?>