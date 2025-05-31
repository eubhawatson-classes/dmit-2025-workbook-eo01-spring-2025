<?php
    require('includes/validation-functions.php');
    require('includes/process-form.php');
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Evil Corp.&trade; Henchmen Application</title>

    <!-- BS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <!-- Custom JS for Range Slider -->
     <script src="js/main.js" defer></script>
  </head>
  <body class="bg-black container px-3 py-5">
    <main class="row justify-content-center align-items-center min-vh-100">
        <section class="col-md-10 col-lg-9 col-xl-8 col-xxl-7 p-5 rounded border border-secondary bg-dark text-light">
            <h1 class="fw-light text-center">Evil Corp.&trade; Henchmen Application</h1>
            <p class="lead text-center">Welcome to Evil Corp.&trade;, where dastardly dreams meet career opportunities!</p>
            <p class="mb-5">We understand that being a henchperson is more than just a job - it's a calling. Whether you're a master of mischief, a pro at pushing big red buttons, or someone who just wants to look cool guarding a secret lair, we want you on our team.</p>

            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <section class="my-5">
                    <h2 class="fw-light">Account Creation</h2>

                    <!-- Text Input (Full Name) -->

                    <!-- Email Input -->

                    <!-- Phone Input -->

                    <!-- Date Input -->

                    <!-- Password Input -->

                    <!-- Password Check -->
                </section>

                <section class="my-5">
                    <h2 class="fw-light">Qualifications</h2>

                    <!-- Number Input (Years Experience) -->

                    <!-- Datalist -->

                    <!-- Radio Buttons (which Department) -->

                    <!-- Checkboxes (Occupation Hazard Training) -->

                    <!-- Range Slider (Likert Scale) -->

                    <!-- Select/Option (Dropdown) -->

                </section>

                <section class="my-5">
                    <h2 class="fw-light">Long Answer Question</h2>
                    <!-- Textarea -->
                </section>

                <!-- Submit -->
                <div class="my-4">
                    <input type="submit" id="submit" name="submit" value="Create Account & Apply" class="btn btn-warning">
                </div>

                <!-- Disclaimer -->
                 <p class="form-text text-light">Evil Corp.&trade; prides itself on being an equal opportunity employer. All goons, mooks, minions, lackeys, grunts, and flunkies are encouraged to apply. Remember: just because we're evil doesn't mean we can't be equal.</p>
            </form>
        </section>
    </main>
  </body>
</html>