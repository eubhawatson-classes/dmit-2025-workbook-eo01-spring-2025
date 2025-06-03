<?php

/**
 * This file contains a collection of reusable validation helper functions.
 * 
 * BLANKS/PRESENCE: Check whether or not a value is set or exists.
 * EXCLUSIONS/INCLUSIONS: Verify that a value is among a set of allowed values.
 * DATA TYPE - PHONE NUMBER: Normalise phone inputs by stripping syntax.
 * DATA TYPE - STRINGS: Validate string length, character constraints, etc.
 */

/**
 * Determines if a value is blank (unset or empty after trimming whitespace).
 *
 * @param mixed $value The value to check for presence.
 * @return bool TRUE if the value is not set or is an empty string after trim().
 */
function is_blank($value)
{
    return !isset($value) || trim($value) === '';
}

/*
    DATA TYPE - PHONE NUMBERS
*/

/**
 * Normalises a phone number string by stripping out common formatting characters.
 * Removes: +, -, ., (, ), and spaces.
 * 
 * @param string $value The raw phone number input.
 * @return string       The cleaned-up numeric phone string.
 */
function valid_phone_format($value) {
    // We want to remove: + - . ( )
    $value = str_replace("+", "", $value);
    $value = str_replace("-", "", $value);
    $value = str_replace(".", "", $value);
    $value = str_replace("(", "", $value);
    $value = str_replace(")", "", $value);
    $value = str_replace(" ", "", $value);

    return $value;
}

/*
    DATA TYPE - STRINGS
*/

/**
 * Check if the length of a string is less than a maximum number of characters.
 * 
 * @param string $value The string to measure.
 * @param int    $max   The maximum allowed length. 
 * @return bool  TRUE if length($value) < $max; otherwise, FALSE.
 */
function has_length_less_than($value, $max) {
    $length = strlen($value);
    return $length < $max;
}

/**
 * Validates that a string has exactly the specified length.
 * 
 * @param string $value           The value to check. 
 * @param int    $required_length The exact character length required.
 * @return bool  TRUE if $value is exactly $required_length characters long.
 */
function has_length_exactly(string $value, int $required_length) {
    return strlen($value) === $required_length;
}

/**
 * Validates that a string contains only letters (A-Z, case insensitive) and spaces.
 * 
 * @param string $value The string to check.
 * @return bool  TRUE if $value contains only letters and spaces; FALSE otherwise. 
 */
function is_letters($value) {
    return preg_match("/^[a-zA-Z\s]*$/", $value);
}

/**
 * Determines whether a string contains a space character.
 * 
 * @param string $value The string to check. 
 * @return bool  TRUE is no spaces are found; FALSE is there is a space.
 */
function no_spaces($value) {
    return strpos($value, " ") == FALSE;
}

