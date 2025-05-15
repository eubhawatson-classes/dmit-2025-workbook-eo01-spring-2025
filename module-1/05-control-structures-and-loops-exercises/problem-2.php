<?php

$title = "Problem 2";
include 'includes/header.php';

/*

    Write a program that takes a numerical value and prints its multiplication table.

*/

$number = 5;

?>

<h2>Multiplication Table for <?php $number; ?></h2>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Equation</th>
            <th>Product</th>
        </tr>
    </thead>
    <tbody>

        <?php
        
        for ($i = 1; $i <= 10; $i++) {
            echo "<tr> \n";
            echo "<td>$number * $i</td> \n";
            echo "<td>" . ($number * $i) . "</td> \n";
            echo "</tr> \n";
        }

        ?>

    </tbody>
</table>


<?php

echo '<a href="index.php" class="btn btn-outline-primary my-5">Return to Table of Contents</a>';

include 'includes/footer.php';

?>