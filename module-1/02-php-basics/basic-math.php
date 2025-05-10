<!doctype html>
<html lang="en">

<head>
    <!-- Required Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Basic Arithmetic</title>

    <!-- BS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body class="container text-center">
    <section class="row min-vh-100 align-items-center justify-content-center">
        <div class="col-lg-8">
            <h1 class="display-5 mb-4">Basic Arithmetic</h1>

            <?php
            
            $number_1 = 7;
            $number_2 = 12;

            // Addition
            $number_3 = $number_1 + $number_2;
            echo "<p>The sum of $number_1 and $number_2 is $number_3.</p>";

            // Subtraction
            $number_3 = $number_1 - $number_2;
            echo "<p>$number_2 taken away from $number_1 is $number_3.</p>";

            // Multiplication
            $number_3 = $number_1 * $number_2;
            echo "<p>$number_1 multiplied by $number_2 equals $number_3.</p>";

            // Exponentiation
            $exponent = 4 ** 2;
            echo "<p>4 raised to the power of 2 is $exponent.</p>";

            // Division
            $number_3 = $number_1 / $number_2;
            echo "<p>$number_1 divided by $number_2 equals " . number_format($number_3, 2) . ".</p>";

            // Modulus (Remainder)
            $modulous = 5 % 2;
            echo "<p>5 divided by 2 has a remainder of $modulous.</p>";

            ?>
            
            <a href="index.php" class="btn btn-outline-primary my-5">Return to Table of Contents</a>
        </div>
    </section>
</body>

</html>