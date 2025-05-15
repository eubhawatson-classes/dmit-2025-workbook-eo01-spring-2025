<?php

$title = "Problem 2";
include 'includes/header.php';

/*

    Write a program that takes a numerical value and prints its multiplication table.

*/

// First, we need to initialise a value. This prevents program errors later on.
if (isset($_POST['number'])) {
    $number = $_POST['number'];
} else {
    $number = "";
}

?>

<h2>Pick a Number!</h2>
<p class="lead">Please enter a number to view its multiplication table.</p>

<!-- Form -->

<!-- 
    There are two things a form MUST have in order to function properly:

        1. action -> What happens when the user hits the submit button? Where does the data go?
        2. method -> What HTTP method is used to transport the data there (i.e. HOW do we send the data)?
-->

<form action="problem-2.php" method="POST">
    <div class="my-3">
        <label for="number" class="form-label">Your Number: </label>
        <input type="number" id="number" name="number" class="form-control" required>
    </div>

    <input type="submit" id="submit" name="submit" value="Generate Table" class="btn btn-primary mb-5">
</form>

<?php 

// This is the alternative syntax for an IF statement. It must be paired with an `endif;`. This is an alternative to using: if (condition) { ... }

if ($number != "") : 

?>

<!-- Table -->
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

    endif;

echo '<a href="index.php" class="btn btn-outline-primary my-5">Return to Table of Contents</a>';

include 'includes/footer.php';

?>