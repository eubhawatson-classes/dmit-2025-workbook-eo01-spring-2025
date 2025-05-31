<?php

/**
 * This file contains a collection of reusable validation helper functions.
 * 
 * BLANKS/PRESENCE: Check whether or not a value is set or exists.
 * EXCLUSIONS/INCLUSIONS: Verify that a value is among a set of allowed values.
 * DATA TYPE - EMAIL: Validation email formatting.
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
 * Validates that a string contains only letters (A-Z, case insensitive) and spaces.
 * 
 * @param string $value The string to check.
 * @return bool  TRUE if $value contains only letters and spaces; FALSE otherwise. 
 */
function is_letters($value) {
    return preg_match("/^[a-zA-Z\s]*$/", $value);
}