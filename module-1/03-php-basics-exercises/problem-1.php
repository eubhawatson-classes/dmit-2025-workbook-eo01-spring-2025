<?php

$title = "Problem 1";
include 'includes/header.php';

/*
    Write a script that begins with two variables. Each variable should be a number.

    Echo out these variables. 

    Next, figure out a way to assign the value of the first variable to the second variable and the value of the second variable to the first variable; however, you are not allowed to use numbers at this point, only variable names. 

    Hint: Try using a third variable.

    Echo out the final output.
*/

$number_1 = 7;
$number_2 = 4;

echo "<p>The first number is: $number_1; the second number is: $number_2.</p>";

$number_3 = $number_1;
$number_1 = $number_2;
$number_2 = $number_3;

echo "<p>After reassignment, the first number is: $number_1; the second number is: $number_2.</p>";

echo '<a href="index.php" class="btn btn-outline-primary my-5">Return to Table of Contents</a>';

include 'includes/footer.php';

?>