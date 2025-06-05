<?php

// We're initialising our variables first to avoid any error messages.

// Account Creation

// trim() => removes any leading or trailing white space (spaces); only works on strings.
$name = (isset($_POST['name'])) ? trim($_POST['name']) : "";
$email = (isset($_POST['email'])) ? trim($_POST['email']) : "";
$phone = (isset($_POST['phone'])) ? trim($_POST['phone']) : "";
$dob = (isset($_POST['dob'])) ?? "";
$password = (isset($_POST['password'])) ? trim($_POST['password']) : "";
$password_check = (isset($_POST['password-check'])) ? trim($_POST['password-check']) : "";

// Qualifications
$experience = (isset($_POST['experience'])) ? trim($_POST['experience']) : "";
$region = (isset($_POST['region'])) ?? "";
$department = (isset($_POST['department'])) ?? "";
// Because training will be checkboxes and the user may select multiple values, its default value is an empty array, not an empty string. 
$training = (isset($_POST['training'])) ?? [];
$loyalty = (isset($_POST['loyalty'])) ?? "";
$referral = (isset($_POST['referral'])) ?? "";

// Long Answer Question
$evil_plan = (isset($_POST['evil-plan'])) ? trim($_POST['evil-plan']) : "";

// Error/User Messages
$message_name = "";
$message_email = "";
$message_phone = "";
$message_dob = "";
$message_password = "";
$message_password_check = "";

$message_experience = "";
$message_region = "";
$message_department = "";
$message_training = "";
$message_loyalty = "";
$message_referral = "";

$message_evil_plan = "";

// Validation Boolean: This boolean will keep track of our validation process. It will initially be FALSE; however, when the user submits the form, it will flip to TRUE.
$form_good = (isset($_POST['submit'])) ? TRUE : FALSE;

// If the user does not pass validation in any category, it will go right back to FALSE and they will not be redirected to the thank-you page.

if (isset($_POST['submit'])) {
    /*
        VALIDATION FOR FULL NAME
    */

    if (is_blank($name)) {
        $message_name = "<p class=\"text-warning\">Please enter your name.</p>";
    } elseif (!is_letters($name)) {
        $message_name .= "<p class=\"text-warning\">Your name can only contain letters and spaces.</p>";
    } elseif (no_spaces($name)) {
        $message_name .= "<p class=\"text-warning\">Please enter both your first and last name.</p>";
    } elseif ($name == FALSE) {
        $message_name .= "<p class=\"text-warning\">Please enter a valid name.</p>";
    }

    // If we have a message for the user, it means their input failed at least one test. Here, we'll check to see if there is a message and, if there is, we'll flip our test boolean to FALSE, meaning the user will not get forwarded to the thank-you page until they fix things and pass validation. 
    if ($message_name != "") {
        $form_good = FALSE;
    }

    /*
        VALIDATION FOR EMAIL
    */

    if (is_blank($email)) {
        $message_email = "<p class=\"text-warning\">Please enter your email address.</p>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message_email .= "<p class=\"text-warning\">Please enter a valid email address.</p>";
    }

    if ($message_email != "") {
        $form_good = FALSE;
    }

    /*
        VALIDATION FOR PHONE NUMBER
    */

    $phone = valid_phone_format($phone);

    if (is_blank($phone)) {
        $message_phone = "<p class=\"text-warning\">Please enter your phone number.</p>";
    } elseif (!is_numeric($phone)) {
        $message_phone .= "<p class=\"text-warning\">Please enter a valid phone number, using numbers only.</p>";
    } elseif (!filter_var($phone, FILTER_VALIDATE_INT)) {
        $message_phone .= "<p class=\"text-warning\">Please enter a valid phone number, using numbers only.</p>";
    } elseif (!has_length_exactly($phone, 10)) {
        $message_phone .= "<p class=\"text-warning\">Please enter a 10 digit phone number.</p>";
    }

    if ($message_phone != "") {
        $form_good = FALSE;
    }

    /*
        VALIDATION FOR DATES & DATE OF BIRTH

        We can check to see if a provided value is a date by creating a DateTime object from it. This is because it ensures the provided value is both:

            1. properly formatted (Y-m-d)
            2. a valid calendar date (e.g., it prevents 2025-02-30 from being accepted)
    */

    if (!empty($dob)) {
        // If the user gave us _something_, we'll attempt to create a DateTime object from the user input.
        $dob_object = DateTime::createFromFormat('Y-m-d', $dob);

        // We'll check to see if we were able to create (instantiate) an object from the date the user gave us, that it follows our provided format, and that it's still considered equivalent to the user input.
        if ($dob_object && $dob_object->format('Y-m-d') === $dob) {

            // If the date is valid, we'll check the user's age by comparing today's date and time to their birthday.
            $today = new DateTime();

            // This is an object-oriented way of subtracting 18 years from the current date. We do not have to do the heavy lifting of converting everything to unix time, then subtracting it: PHP does this for us at runtime. 
            $minimum_age = $today->modify('-18 years');

            if ($dob_object > $minimum_age) {
                $message_dob .= "<p class=\"text-warning\">You must be at least 18-years-old to apply.</p>";
            }
        } else {
            $message_dob .= "<p class=\"text-warning\">Please enter a valid date.</p>";
        }
    } else {
        $message_dob .= "<p class=\"text-warning\">Please enter your date of birth.</p>";
    }

    if ($message_dob != "") {
        $form_good = FALSE;
    }

    /*
        PASSWORD

        If we tell the user that we want certain things within a password (ex. minimum length, a special character, an uppcase letter, etc.), we could compare their input to a suitable regular expression (RegEx).

        However, if do it piece by piece, then we can give the user better feedback on what exactly they're missing. 
    */

    if (is_blank($password)) {
        $message_password = "<p class=\"text-warning\">Please provide a password.</p>";
    } elseif (strlen($password) < 8) {
        $message_password = "<p class=\"text-warning\">Your password must be at least 8 characters long.</p>";
    } elseif (!preg_match('/[A-Z]/', $password)) { // uppercase letter
        $message_password = "<p class=\"text-warning\">Your password must include at least one uppercase letter.</p>";
    } elseif (!preg_match('/[a-z]/', $password)) { // lowercase letter
        $message_password = "<p class=\"text-warning\">Your password must include at least one lowercase letter.</p>";
    } elseif (!preg_match('/[0-9]/', $password)) { // number
        $message_password = "<p class=\"text-warning\">Your password must include at least one number.</p>";
    } elseif (!preg_match('/[\W_]/', $password)) { // special character
        $message_password = "<p class=\"text-warning\">Your password must include at least one special character (!@#$%^&*).</p>";
    }

    if ($message_password != "") {
        $form_good = FALSE;
    }

    /*
        PASSWORD COMPARISON

        This is relatively straightforward. Here, we want to see if the value that the user typed in the first password field matches (or is equal to) whatever they typed in the second field.
    */

    if ($password != $password_check) {
        $message_password_check = "<p class=\"text-warning\">This field does not match the response above. Please try typing your password again.</p>";
        $form_good = FALSE;
    }

    /*
        NUMBERS

        For this particular field, we want to make sure: 

        1. It's a number
        2. It's a whole number (integer)
        3. It's within a reasonable range (0-60 years)
    */

    if (is_blank($experience)) {
        $message_experience = "<p class=\"text-warning\">Please provide the number of years of experience you have.</p>";
    } elseif (!is_numeric($experience)) {
        $message_experience = "<p class=\"text-warning\">Please enter a number.</p>";
    } elseif (!is_int($experience)) {
        $message_experience = "<p class=\"text-warning\">Please enter a whole number (an integer).</p>";
    } elseif ($experience < 0 || $experience > 60) {
        $message_experience = "<p class=\"text-warning\">Experience must be between 0 and 60 years.</p>";
    }

    if ($message_experience != "") {
        $form_good = FALSE;
    }

    /*
        DATA LISTS

        For our data list, we're going to make sure:

        1. the user typed something (presence check);
        2. their answer isn't too long; and
        3. it only contains valid characters.
    */

    if (is_blank($region)) {
        $message_region = "<p class=\"text-warning\">Please enter your preferred region for assignments.</p>";
    } elseif (strlen($region) > 255) {
        $message_region = "<p class=\"text-warning\">That region name is a bit too long; try something shorter.</p>";
    } elseif (!preg_match("/^[a-zA-Z0-9 .,'()&\-\/]+$/", $region)) {
        $message_region = "<p class=\"text-warning\">Region name contains invalid characters.</p>";
    }

    if ($message_region != "") {
        $form_good = FALSE;
    }

    /*
        RADIO BUTTONS

        If we give the user radio buttons, checkboxes, a dropdown option (select element), or a range slides, all of the values _should_ be good. 

        However, a bad actor may alter the values of these form controls before submission (or, if we're using the $_GET method, they can muck around with the query string). 

        After our presence check, we're going to see if the value the user submitted is an allowed value.
    */

    // This is a list of all of our allowed values.
    $valid_departments = ['traps', 'doomsday', 'monologue', 'it'];

    if (is_blank($department)) {
        $message_department = "<p class=\"text-warning\">Please select a department.</p>";
    } elseif (!in_array($department, $valid_departments)) {
        $message_department = "<p class=\"text-warning\">Invalid department selection.</p>";
    }

    if ($message_department != "") {
        $form_good = FALSE;
    }

    /*
        CHECKBOXES

        Checkboxes work largely in the same way that radio buttons do, with one key difference: instead of submitting a single value, a user may submit multiple. This means that any time we use checkboxes, we're creating an array. 

        However, we'll throw yet another spanner into the works: this part of the form is optional. This means that if the user hasn't selected anything, they will not fail validation.
    */

    $valid_training = ['lava', 'sharks', 'lifting', 'buttons', 'hostages', 'evacuation', 'retention'];

    // If the user chose something, we will go into a validation block.
    if (!is_blank($training)) {
        // Here, we're checking each value that the user submitted and seeing if it is also inside of our whitelist.
        foreach ($training as $value) {
            if (!in_array($value, $valid_training)) {
                $message_training = "<p class=\"text-warning\">Your value is not allowed. As delightfully evil as that is, please select an answer from the provided list.</p>";
                $form_good = FALSE;
                // The moment we find a value that is NOT allowed, we can assign an error message, flip our test boolean, and exit the loop structure.
                break;
            }
        }
    }

} // end of 'if the user hit submit'

if ($form_good == TRUE) {
    header("Location: thank-you.php");
}
