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

?>