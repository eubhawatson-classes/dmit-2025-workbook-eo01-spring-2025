<?php

$title = "Problem 3";
include 'includes/header.php';

/*
    ### Problem 3: Vowel Counter

    Write a program that takes a string input from the user and counts the number of vowels (a, e, i, o, u) in it.


    #### Bonus Question

    Some English words do not have any of the standard vowels (a, e, i, o, u), but do have a 'y' (ex. any, why, my, sky ...).

    Extend your program so that it looks for each word that contains no standard vowel, counts every 'y' in that word, and prints the total number vowels with 'y' words added. 
*/

// This is the syntax for our ternary shorthand: 
// $variable = condition ? if true : else false;

$user_text = isset($_POST['user-text']) ? $_POST['user-text'] : '';
$standard_count = 0;
$y_count = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Our first step is normalisation. We'll convert everything to lowercase so that our script doesn't discriminate between cases (ex. e and E, or a and A).
    $text = mb_strtolower(trim($user_text), 'UTF-8'); // trim() removes leading and trailing whitespace.

    // str_split() -> converts each character in a string to an item within a simple indexed array.
    $char_array = str_split($text);
    $vowels = ['a', 'e', 'i', 'o', 'u'];

    foreach ($char_array as $char) {
        // in_array() -> looks for a needle (a value) in a haystack (an array). In this case, we are checking to see whether or not every single character in our user-provided phrase is a vowel or not (i.e. if it's in our vowel list).
        if (in_array($char, $vowels, TRUE)) {
            // If the character in question is a vowel, we'll increase our vowel counter.
            $standard_count++;
        }
    }

    // Okay, great -- we've got our vowel count! Now, we've got to figure out the number of y-words. Let's start by splitting our user-provided text into words.

    // str_word_count() -> This can do a couple of things, including taking a string and returning the number of words in it ($text, 0) or taking a string and returning an array where each item is a word ($text, 1). We are doing the latter.
    $words = str_word_count($text, 1);

    /**
     * Now, we've got to check two things: 
     * 
     * 1) Is there a vowel (a, e, i, o, u) in each word?
     * 2) If not (if FALSE), is there a 'y'?
     */

     // This loops through our array of words and lets us examine one word at a time.
     foreach ($words as $word) {

        // Let's start by defining a boolean. This will act as a switch for us.
        $has_vowel = FALSE;

        // Now, let's look at each individual character inside of our word.
        foreach ($vowels as $v) {
            if (strpos($word, $v) !== FALSE) {
                // If we find a vowel in our word, we exit the inner loop and move onto the next word.
                $has_vowel = TRUE;
                break;
            }
        }

        // If there is no vowel found in our word ... 
        if (!$has_vowel) {
            // ... we will take that word and see how many times 'y' appears in it. We'll then add this to our overall y-count.
            $y_count += substr_count($word, 'y');
        }
     }
}

?>

<p class="lead mb-5">Enter a word, phrase, or block of text below to count how many vowels appear in it.</p>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="mb-5">
    <div class="mb-3">
        <label for="user-text" class="form-label">Your text:</label>
        <textarea name="user-text" id="user-text" class="form-control"><?php echo $user_text; ?></textarea>

        <!-- 
            It's important that our forms retain user input, especially if the user needs to return to the form or correct anything for whatever reason. In order to do this, we can echo out their previously-submitted value into a `value` attribute.

            <input type="text" name="text" id="text" value="<?php echo $user_text; ?>">
        -->
    </div>

    <div class="mb-3">
        <input type="submit" name="submit" id="submit" value="Check Vowel Count" class="btn btn-primary">
    </div>
</form>

<?php if ($user_text != '') : ?>

    <div class="row row-cols-2 mb-5">
        <!-- Standard Vowel Count -->
        <div class="alert alert-success col" role="alert">
            <p class="mb-0"><strong>Standard Vowels</strong>: <?php echo $standard_count; ?></p>
        </div>
        <!-- Y-Words Count -->
        <div class="alert alert-warning col" role="alert">
            <p class="mb-0"><strong>Y-Words</strong>: <?php echo $y_count; ?></p>
        </div>
    </div>

<?php endif;

echo '<a href="index.php" class="btn btn-outline-primary my-5">Return to Table of Contents</a>';

include 'includes/footer.php';