<?php

$title = "Problem 2";
include 'includes/header.php';

/*
    Write a script that takes the lengths of the adjacent and the opposite sides of a right triangle and echos out the length of the hypotenuse.

    a^2 + b^2 == c^2

    We need to use a method, sqrt(), for square roots, but we can either use a method, pow(), or an arithmetic operator ( ** ) for the exponents. 

*/

$adjacent = 5;
$opposite = 8;

// When PHP evaluates an arithmetic expression, the order of operations applies (i.e., BEDMAS or PEMDAS).

$hypotenuse = sqrt($adjacent ** 2 + $opposite ** 2);

// The number that PHP gives us isn't terribly user-friendly. We can round the value to two decimal places before we echo it out to the user.

$hypotenuse = number_format($hypotenuse, 2);

echo "<p>The hypotenuse of a right triangle with an adjacent length of $adjacent and an opposite length of $opposite is $hypotenuse.</p>";



echo '<a href="index.php" class="btn btn-outline-primary my-5">Return to Table of Contents</a>';

include 'includes/footer.php';

?>