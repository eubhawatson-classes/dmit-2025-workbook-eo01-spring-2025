<?php

require '/home/vwatson/data/valitron/src/Valitron/Validator.php';

/*
    This line is telling PHP where to find the Validator class we're using. It essentially means: 

    'Hey PHP, whenever I write Validator, I mean the Validator class inside the Validatron namespace.'

    In PHP, a namespace is like a folder or label or container that help organise code. Just like files can have the same name but live in different folders, classes can share names as long as they're in a different namespace. 

    Namespaces help prevent conflicts when multiple libraries or parts of our code use classes with the same name.
*/

use Valitron\Validator;

// This is an array to hold our validation messages.
$validation_errors = [];

// And this is an array to hold our user's input.
$data = [];

// This will be our success message, which we'll print once the user passes validation.
$pass_message = "";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data = $_POST;

    // This line creates a new Validator object (that's the `new` keyword) and gives it the data we want to validate.
    $v = new Validator($data);

    // Next, let's define some of the basic validation rules we want to use. 

    // For the 'required' rule, each of the listed fields must be present in the input data and cannot be empty (not null, not an empty string, not just whitespace).
    $v->rule('required', ['name', 'email', 'gender', 'country']);

    // The value of the `email` field must conform to a standard email format. Valitron uses PHP's `filter_var($value, FILTER_VALIDATE_EMAIL)` under the hood.
    $v->rule('email', 'email');

    // The submitted gender/country must exactly match one of the listed values. If the user submits anything else, validation fails. 
    $v->rule('in', 'gender', ['female', 'male', 'other']);
    $v->rule('in', 'country', ['au', 'ca', 'gb', 'us']);

    // The message's string length can be no longer than 256 characters. If it exceeds this, it will trigger a validation error in that field.
    $v->rule('lengthMax', 'message', 256);

    // Even with our shiny new library, we may still need to write some custom checks. Let's start by seeing if the user chose a hobby.
    if (!empty($data['hobbies'])) {
        foreach($data['hobbies'] as $hobby) {
            if (!in_array($hobby, ['reading', 'traveling', 'gaming'])) {
                $v->error('hobbies', 'Hobbies contains an invalid value. Please select from the provided options.');
                break;
            }
        }
    } else { // if the user did not select at least one hobby
        $v->error('hobbies', 'At least one hobby must be selected.');
    }

    // Up above, we defined all of our rules (or the things we want to check for when we validate). Now, let's actually validate! This condition first of all executes validation; after that's finished, it also checks to see if there were any errors. 
    if ( $v->validate() && empty( $v->errors() ) ) {
        // After validation, if there are no errors, the user passes. 
        $pass_message = "<p>Form submitted successfully!</p>";

        // Because the user stays on the same page as the form, we may want to wipe out their form values rather than risk them spam-submitting the form data. 
        $data = [];
    } else {
        // However, if there are errors, we'll assign it to a variable here to echo it out to the user.
        $validation_errors = $v->errors();
    }

} // end of 'if the user hit submit'

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PHP Form with Valitron Validation</title>

    <!-- BS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  </head>

  <body class="container my-5">
    <section class="row">  
        <h1>Contact Us</h1>

        <!-- This block prints out any validation messages to the user. -->
         <?php if ($validation_errors) : ?>
            <div class="alert alert-danger">
                <p>There were <strong>validation errors</strong> in your submission:</p>
                <ul>
                    <?php
                        /* 
                            Our validation errors are stored in a multi-dimensional array. 

                            In the first level, we have each field (ex. name, email, gender, etc.) and its errors.

                            In the second level, we have each individual error message.

                            So, for example, name may have multiple error messages. This means that we not only need to loop through the messages for each field, but also each individual error. 
                        */
                        foreach ($validation_errors as $field => $messages) {
                            foreach ($messages as $warning) {
                                echo "<li>$warning</li>";
                            }
                        }
                    ?>
                </ul>
            </div>
         <?php endif; 

            if ($pass_message != "") {
                echo "<div class=\"alert alert-success\">";
                echo $pass_message;
                echo "</div>";
            }
         
         ?>

        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <!-- Name -->
             <div class="mb-4">
                <label for="name" class="form-label">Your Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="<?= $data['name'] ?? ''; ?>">
             </div>

            <!-- Email -->
             <div class="mb-4">
                <label for="email" class="form-label">Email Address:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?= $data['email'] ?? ''; ?>">
             </div>

            <!-- Radio Buttons (Gender) -->
             <fieldset class="mb-4">
                <legend>Your Gender:</legend>

                <div class="form-check">
                    <input type="radio" id="female" value="female" name="gender" class="form-check-input" <?= (isset($data['gender']) == 'female') ? 'checked' : ''; ?>>
                    <label for="female" class="form-check-label">Female</label>
                </div>

                <div class="form-check">
                    <input type="radio" id="male" value="male" name="gender" class="form-check-input" <?= (isset($data['gender']) == 'male') ? 'checked' : ''; ?>>
                    <label for="male" class="form-check-label">Male</label>
                </div>
                
                <div class="form-check">
                    <input type="radio" id="other" value="other" name="gender" class="form-check-input" <?= (isset($data['gender']) == 'other') ? 'checked' : ''; ?>>
                    <label for="other" class="form-check-label">Other</label>                    
                </div>
             </fieldset>

            <!-- Checkboxes (Hobbies) -->
            <fieldset class="mb-4">
                <legend>Hobbies:</legend>

                <div class="form-check">
                    <input type="checkbox" id="reading" name="hobbies" value="reading" class="form-check-input" <?= (isset($data['hobbies']) == 'reading') ? 'checked' : ''; ?>>
                    <label for="form-check-label" class="form-check-label">Reading</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" id="traveling" name="hobbies" value="traveling" class="form-check-input" <?= (isset($data['hobbies']) == 'traveling') ? 'checked' : ''; ?>>
                    <label for="form-check-label" class="form-check-label">Traveling</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" id="gaming" name="hobbies" value="gaming" class="form-check-input" <?= (isset($data['hobbies']) == 'gaming') ? 'checked' : ''; ?>>
                    <label for="form-check-label" class="form-check-label">Video Games</label>
                </div>
            </fieldset>

            <!-- Select -->
             <div class="mb-4">
                <label for="country" class="form-label">Country:</label>
                <select name="country" id="country" class="form-select">
                    <option value="" <?= (isset($data['country']) && $data['country'] == "") ? 'selected' : ''; ?>>-- Select Your Country --</option>
                    <option value="au" <?= (isset($data['country']) && $data['country'] == "au") ? 'selected' : ''; ?>>Australia</option>
                    <option value="ca" <?= (isset($data['country']) && $data['country'] == "ca") ? 'selected' : ''; ?>>Canada</option>
                    <option value="gb" <?= (isset($data['country']) && $data['country'] == "gb") ? 'selected' : ''; ?>>United Kingdom</option>
                    <option value="us" <?= (isset($data['country']) && $data['country'] == "us") ? 'selected' : ''; ?>>United States</option>
                </select>
             </div>

            <!-- Text Area -->
             <div class="mb-3">
                <label for="message" class="form-label">Message:</label>
                <textarea name="message" id="message" maxlength="256" class="form-control"><?= $data['message'] ?? ''; ?></textarea>
             </div>

            <!-- Submit -->
             <input type="submit" id="submit" name="submit" class="btn btn-primary" value="Send">
        </form>
    </section>
  </body>
</html>