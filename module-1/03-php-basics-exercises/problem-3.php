<?php

$title = "Problem 3";
include 'includes/header.php';

/*
    Write a script that begins with a four-digit number. Take each place value (i.e. each individual number) and add them together. 

    For example, if you take the number `1234`, then you will need to figute out a way to extract each number and add them together. The expected output would be `1 + 2 + 3 + 4 = 10`.

    Finish by echoing out the sum. 

    ... but do we really have to do the maths?

    PHP is a weak-typed language. We can get away with treating our user input as a string. And since PHP treats strings as an array of characters, we can actually just grab each character from that array and sum them up.
*/

$string = "1234";

$total = $string[0] + $string[1] + $string[2] + $string[3];

echo "<p>The sum of each number in $string is $total.</p>";


echo '<a href="index.php" class="btn btn-outline-primary my-5">Return to Table of Contents</a>';

include 'includes/footer.php';

?>