<?php

// Let's define our custom function. We need to do this before we call (use) the function.
function palindrome_check($string) {
    // Comparisons are case-sensitive and can be thrown off by capital letters and/or spaces. So, let's convert everything to lowercase and remove the spaces before checking to see if it's a palindrome. 
    $string = strtolower($string);

    // This accepts a search character (a thing we are looking for), what we want to replace it with, and the string we're modifying.
    $string = str_replace(' ', '', $string);

    // We are checking to see if $string is equivalent to itself (but in reverse). This means that the function will return either a TRUE or a FALSE.
    return $string == strrev($string);
}

$user_phrase = isset($_POST['palindrome']) ? $_POST['palindrome'] : '';

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Palindrome Checker</title>

    <!-- BS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body class="container">
    <header class="row justify-content-center my-5">
        <section class="col-lg-6 col-md-8 text-center">
            <h1 class="display-6">Palindrome Checker</h1>
            <p class="lead">Use the form below to check to see whether or not your word or phrase is a palindrome.</p>
            <hr class="my-5">
        </section>
    </header>
    <main class="row justify-content-center my-5">
        <section class="col-lg-6 col-md-8">
            <!-- Definitions -->
            <h2>What is a palindrome?</h2>
            <p>A palindrome is a word, phrase, or sequence that reads the same backwards as forwards. Some examples include: madam; racecar; level; civic; nurses run; noon; radar ... </p>
            <p>... and many more!</p>

            <!-- Form -->
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="border border-secondary rounded shadow-sm p-5 my-5">
                <div class="mb-3">
                    <label for="palindrome" class="form-label">Your word or phrase:</label>
                    <input type="text" id="palindrome" name="palindrome" class="form-control" value="<?= $user_phrase; ?>" required>
                </div>

                <input type="submit" value="Is this a palindrome?" name="submit" id="submit" class="btn btn-primary">
            </form>
        </section>


        <?php if (isset($_POST['palindrome'])) : ?>
            <!-- Result -->
            <section class="col-lg-6 col-md-8">
                <h2>Your Result</h2>
                <p>Your phrase was: <span class="text-primary"><?= $user_phrase; ?></span></p>

                <?php
                    if (palindrome_check($user_phrase)) {
                        echo "<p class=\"text-success\">Your phrase is a palindrome!</p>";
                    } else {
                        echo "<p class=\"text-danger\">Your phrase is <strong>not</strong> a palindrome.</p>";
                    }   
                ?>
            </section>
        <?php endif; ?>
    </main>
</body>

</html>