<?php

$title = "Problem 2";
include 'includes/header.php';

/*

    Write a program that converts a temperature from Celsius to Fahrenheit or Fahrenheit to Celsius based on user input.

*/

// trim() -> Removes any leading or trailing whitespace (commonly left by autocorrect / touch typing).

$temperature = isset($_POST['temperature']) ? trim($_POST['temperature']) : '';
$direction = isset($_POST['direction']) ? $_POST['direction'] : '';
$message = '';

?>

<p class="lead mb-5">Use the form below to convert temperatures between Celsius and Fahrenheit.</p>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="mb-5">
    <!-- Temperature (Number) -->
     <div class="mb-4">
        <label for="temperature" class="form-label">Temperature:</label>
        <input type="number" name="temperature" id="temperature" class="form-control" placeholder="Enter a Number" required>
     </div>

    <!-- Direction (C to F || F to C) -->
    <fieldset class="mb-4 text-start">
        <legend class="fw-normal fs-6">Conversion Type</legend>

        <div class="form-check">
            <input type="radio" name="direction" id="c-to-f" value="c-to-f" class="form-check-input">
            <label for="c-to-f" class="form-check-label">Celsius to Fahrenheit</label>
        </div>
        
        <div class="form-check">
            <input type="radio" name="direction" id="f-to-c" value="f-to-c" class="form-check-input">
            <label for="f-to-c" class="form-check-label">Fahrenheit to Celsius</label>
        </div>
    </fieldset>

    <!-- Submit -->
     <div class="mb-4">
        <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">
     </div>
</form>

<?php

if (isset($_POST['submit'])) {
    if ($temperature === '') {
        $message = "<p class=\"text-danger\">Please enter a temperature value.</p>";
    } elseif (!is_numeric($temperature)) {
        $message = "<p class=\"text-danger\">Please enter a valid number for temperature.</p>";
    } elseif (!in_array($direction, ['c-to-f', 'f-to-c'])) {
        $message = "<p class=\"text-danger\">Please select a conversion type.</p>";
    } else {
        $temperature = (float) $temperature;

        if ($direction == 'c-to-f') {
            $result = ($temperature * 9 / 5) + 32;
            $message = "<p class=\"fs-2\">$temperature &deg;C is <strong>" . number_format($result, 2) . "&deg;F</strong>.</p>";
        } else {
            $result = ($temperature - 32) * 5 / 9;
            $message = "<p class=\"fs-2\">$temperature &deg;F is <strong>" . number_format($result, 2) . "&deg;C</strong>.</p>";
        }
    }
}

if ($message != '') {
    echo $message;
}

echo '<a href="index.php" class="btn btn-outline-primary my-5">Return to Table of Contents</a>';

include 'includes/footer.php';

?>