<!doctype html>
<html lang="en">

<head>
  <!-- Required Meta Tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Comparison Operators, Logical Operators, Control Structures, &amp; Loops</title>

  <!-- BS CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body class="container text-center">
  <main class="row justify-content-center align-items-center min-vh-100">
    <h1 class="display-4">Comparison Operators, Logical Operators, Control Structures, &amp; Loops</h1>

    <section class="col-lg-8">
      <h2 class="display-5 mb-4">Comparison &amp; Logical Operators</h2>

      <h3 class="display-6">Comparison Operators</h3>

      <?php

      // A single = is an assignment operator. We're saying 'this thing will now have this value'.
      $x = 6;

      // With the == sign, we're evaluating something (i.e. checking to see whether two things are equal, or if something is true, or if something is false).
      if ($x == 6) {
        echo "<p>X is equal to 6.</p>";
      }

      // With the === sign, we're checking for the value AND ALSO the data type.
      if ($x === 6) {
        echo "<p>X has the same value and the same data type as 6.</p>";
      }

      // This is negative logic (checking to see if a value is NOT something).
      if ($x != 5) {
        echo "<p>X is not equal to 5.</p>";
      }

      // This is different syntax, but the same thing as above.
      if ($x <> 4) {
        echo "<p>X is not equal to 4.</p>";
      }

      if ($x > 5) {
        echo "<p>X is greater than 5.</p>";
      }

      if ($x >= 6) {
        echo "<p>X is greater than or equal to 6.</p>";
      }

      if ($x <= 7) {
        echo "<p>X is less than or equal to 7.</p>";
      }

      if ($x < 10) {
        echo "<p>X is less than 10.</p>";
      }

      ?>

      <h3 class="display-6">Logical Operators</h3>

      <?php

      /**
       * Logical Operators
       * 
       * &&   ->  AND (all parts of the statement must be TRUE)
       * ||   ->  OR (at least one part of the statement must be TRUE)
       * XOR  ->  EXCLUSIVE OR (one or the other must be TRUE, but NOT both)
       * NOT  ->  alternative syntax for !=, or <>
       * 
       */

      if ($x > 2 && $x < 10) {
        echo "<p>X is greater than 2 <strong>and</strong> less than 10. (Both parts must be true.)</p>";
      }

      if ($x > 2 || $x < 4) {
        echo "<p>X is greater than 2 <strong>or</strong> less than 4. (Only one part of this compound statement must be true.)</p>";
      }

      // This should not print, as the condition is not met. Because $x is BOTH greater than 2 and less than 10, the XOR operator makes the overall statement evaluate as FALSE.
      if ($x > 2 xor $x < 10) {
        echo "<p>X is greater than 2 <strong>exclusively or</strong> less than 10. (One part of this compound statement - and only one part - must be true.)</p>";
      }

      // Presence check: does this value exist yet? Has it been set? 
      if (isset($x)) {
        echo "<p>$x has been initialised and is not an empty value.</p>";
      }

      ?>
    </section>

    <section class="col-lg-8">
      <h2 class="display-5 mb-4">Control Structures</h2>

      <h3 class="display-6">Nested If-Statements</h3>

      <?php

      if ($x > 2 xor $x < 10) {
        echo "<p>X is greater than 2 <strong>exclusively or</strong> less than 10. (One part of this compound statement - and only one part - must be true.)</p>";
      } else {
        echo "<p>If the condition for an if-statement is not met, an else can be executed instead. This is good practice for error handling, fall-backs, and default scenarios.</p>";
      }

      $x = "This variable is a string now.";

      if (is_numeric($x)) {
        echo "<p>X is a number.</p>";
      } elseif (!is_numeric($x)) {
        echo "<p class=\"text-success\">X is <strong>not</strong> a number anymore.</p>";
      } else {
        echo "<p>X is not a number and not <em>not</em> a number.</p>";
      }

      ?>

      <h3 class="display-6">Switch Statements</h3>

      <?php
      
      switch (TRUE) {

        case $x === 5:
          $message = "<p>X is 5.</p>";
          break;

        case $x === 6:
          $message = "<p>X is 6.</p>";
          break;

        case $x < 10:
        case $x < 12:
          $message = "<p>X is less than 10 or less than 12.</p>";
          break;

        default: 
          $message = "<p>X was not found.</p>";
          break;
      }

      echo $message;
      
      ?>

      <h3 class="display-6">PHP 8+ Alternative: <code>match</code> Expression</h3>

      <?php
      
      /**
       * This is a match expression. It returns a value, uses strict comparisons, and has concise syntax; however, it is functionally the same as nested-ifs and switch statements. 
       * 
       * Whatever you put in the parenthesis is the thing you're 'matching' against each arm. It could be variable, the literal TRUE, or even a functional call. 
       * 
       * Each line inside of the braces is called an arm. An arm has two parts, separated by the arrow => : 
       * 
       * 1. condition (or pattern) on the left
       * 2. result expression on the right
       * 
       * As soon as PHP finds the first arm whose condition "matches", it returns that arm's result and exits the structure. 
       * 
       */
      $message = match (TRUE) {
        $x === 5         => "<p>X is 5.</p>",
        $x === 6         => "<p>X is 6</p>",
        $x < 10, $x < 12 => "<p>X is less than 10 or less than 12.</p>",
        default          => "<p>X was not found.</p>",
      };

      echo $message;

      ?>
    </section>

    <section class="col-lg-8">
      <h2 class="display-5 mb-4">Loops</h2>

      <h3 class="display-6 mb-4">While Loops</h3>
      <?php
        /**
         * Loops need at least three things to work properly (and not get stuck in an infinite loop):
         * 
         * 1. An initial value. This usually counts how many times we've gone through a loop.
         * 
         * 2. Some sort of exit condition. If this condition is met, the interpreter will exit the loop. 
         * 
         * 3. Some sort of change where the condition can approach FALSE. This is usually an increment (++) or decrement (--).
         */

         $counter = 1;

        // This is a test-first (or pre-test) loop. This means that if the condition is already fulfilled, the loop will never be executed. 
         while ($counter <= 5) {
            echo "<p>Times through the loop: $counter</p>";
            $counter++;
         }
      ?>

      <h3 class="display-6 mb-4">Do/While Loops</h3>
      <?php
        // This is a test-last (or post-test) loop. This means that, no matter what, the loop will be executed at least once. 
        do {
          echo "<p>Times through the loop: $counter</p>";
          $counter++;
        } while ($counter <= 10);

      ?>

      <h3 class="display-6 mb-4">For Loops</h3>
      <?php
        // In a for loop, all three 'ingredients' required by a loop are in the first line. This is a test-first loop.
        for ($i = 5; $i < 10; $i++) {
          echo "<p>Counter value: $i</p>";
        }
      ?>

      <h3 class="display-6 mb-4">For Each Loops</h3>

      <?php
      
      // For Each loops are special: they're made to work specifically with arrays. Here, we're going to use a superglobal array called $_SERVER. This array keeps tonnes of information about the server, its state, and other things related to PHP. While it should never be echoed out to the user, we will use some of its values later on in the course.

      foreach ($_SERVER as $key => $value) {
        echo "<p>$key : $value</p>";
      }

      ?>
    </section>
  </main>
</body>

</html>