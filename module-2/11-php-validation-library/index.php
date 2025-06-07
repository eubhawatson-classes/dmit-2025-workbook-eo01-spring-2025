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

    
}

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

        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <!-- Name -->
             <div class="mb-4">
                <label for="name" class="form-label">Your Name:</label>
                <input type="text" id="name" name="name" class="form-control">
             </div>

            <!-- Email -->
             <div class="mb-4">
                <label for="email" class="form-label">Email Address:</label>
                <input type="email" id="email" name="email" class="form-control">
             </div>

            <!-- Radio Buttons (Gender) -->
             <fieldset class="mb-4">
                <legend>Your Gender:</legend>

                <div class="form-check">
                    <input type="radio" id="female" value="female" name="gender" class="form-check-input">
                    <label for="female" class="form-check-label">Female</label>
                </div>

                <div class="form-check">
                    <input type="radio" id="male" value="male" name="gender" class="form-check-input">
                    <label for="male" class="form-check-label">Male</label>
                </div>
                
                <div class="form-check">
                    <input type="radio" id="other" value="other" name="gender" class="form-check-input">
                    <label for="other" class="form-check-label">Other</label>                    
                </div>
             </fieldset>

            <!-- Checkboxes (Hobbies) -->
            <fieldset class="mb-4">
                <legend>Hobbies:</legend>

                <div class="form-check">
                    <input type="checkbox" id="reading" name="hobbies" value="reading" class="form-check-input">
                    <label for="form-check-label" class="form-check-label">Reading</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" id="traveling" name="hobbies" value="traveling" class="form-check-input">
                    <label for="form-check-label" class="form-check-label">Traveling</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" id="gaming" name="hobbies" value="gaming" class="form-check-input">
                    <label for="form-check-label" class="form-check-label">Video Games</label>
                </div>
            </fieldset>

            <!-- Select -->
             <div class="mb-4">
                <label for="country" class="form-label">Country:</label>
                <select name="country" id="country" class="form-select">
                    <option value="">-- Select Your Country --</option>
                    <option value="au">Australia</option>
                    <option value="ca">Canada</option>
                    <option value="gb">United Kingdom</option>
                    <option value="us">United States</option>
                </select>
             </div>

            <!-- Text Area -->
             <div class="mb-3">
                <label for="message" class="form-label">Message:</label>
                <textarea name="message" id="message" maxlength="256" class="form-control"></textarea>
             </div>

            <!-- Submit -->
             <input type="submit" id="submit" name="submit" class="btn btn-primary" value="Send">
        </form>
    </section>
  </body>
</html>