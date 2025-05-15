<?php

$title = "Problem 1";
include 'includes/header.php';

/*
   Write a program that takes a numerical value and checks to see whether it's positive, negative, zero, or not a number.
*/

$number = 42;

if ($number > 0) {
    echo "<p>$number is a positive number.</p>";
} else if ($number < 0) {
    echo "<p>$number is a negative number.</p>";
} else if ($number == 0) {
    echo "<p>$number is zero.</p>";
} else {
    echo "<p>$number is not a numerical value.</p>";
}

echo '<a href="index.php" class="btn btn-outline-primary my-5">Return to Table of Contents</a>';

include 'includes/footer.php';

?>