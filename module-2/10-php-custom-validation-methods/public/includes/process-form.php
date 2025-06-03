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

}

if ($form_good == TRUE) {
    header("Location: thank-you.php");
}

?>