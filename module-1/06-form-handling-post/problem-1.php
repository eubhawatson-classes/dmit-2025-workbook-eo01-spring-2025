<?php

$title = "Problem 1";
include 'includes/header.php';

/*

    Write a program that takes a numerical value from the user and determines whether the number is even or odd.

*/

// For debugging purposes, if you ever need to check what values are being stored inside of an array, you can use ...

// foreach ($_POST as $key => $value) {
//     echo "<p>$key : $value</p>";
// }

// ... or you can use a simple var_dump().

// var_dump($_POST);

// Instead of using the following if/else structure to initialise our variable ...

// if (isset($_POST['number'])) {
//     $number = $_POST['number'];
// } else {
//     $number = '';
// }

// ... we can use a ternary statement. 

$number = isset($_POST['number']) ? $_POST['number'] : '';

$message = '';

?>

<p class="lead mb-5">Enter a whole number below and hit "Submit" to see whether it is an odd or even number.</p>

<!-- 
    htmlspecialchars() -> This method strips out any syntax that could potentially be used for something malicious (like a XSS attack or a SQL injection).
-->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="mb-3">
        <label for="number" class="form-label">Enter a Number:</label>
        <input type="number" name="number" id="number" step="1" class="form-control" required>
    </div>

    <div class="mb-3 d-flex justify-content-center gap-2">
        <a href="problem-1.php" class="btn btn-outline-primary">Clear Form</a>
        <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">
    </div>
</form>

<?php

if (isset($_POST['number'])) {
    // First, let's double-check that the user gave us something.
    if ($number === '') {
        $message = "<p class=\"fs-2 text-danger\">Please enter a value.</p>";
    } 
    
    // We're using elseif here because we don't want to continue if the user didn't give us a value. We're also checking to see if $number is an integer using a language-defined method.
    elseif (filter_var($number, FILTER_VALIDATE_INT) == TRUE) {

        // Next, before we do any maths, we will typecast the user's number into an integer. If we don't do this, cases like '0' won't work.

        $number = (int) $number;

        if ($number % 2 == 0) {
            $message = "<p class=\"fs-2\">$number is an <strong>even</strong> number.</p>";
        } else {
            $message = "<p class=\"fs-2\">$number is an <strong>odd</strong> number.</p>";
        }
    } else { // If the number is not an integer (i.e. it failed the filter_var), we'll say this.
        $message = "<p class=\"fs-2\">$number is not a numeric value.</p>";
    }
}

if ($message != '') {
    echo $message;
}

echo '<a href="index.php" class="btn btn-outline-primary my-5">Return to Table of Contents</a>';

include 'includes/footer.php';

?>