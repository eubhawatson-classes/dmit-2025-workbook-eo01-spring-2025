<?php
    // Let's start with a simple variable.
    $name = "Your Name";
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo "Hello, world!"; ?></title>

    <!-- BS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body class="container text-center">
    <section class="row min-vh-100 align-items-center justify-content-center">
        <div class="col-lg-8">
            <h1 class="display-5 mb-4">
                <?php
                    echo "Hello, world!";
                ?>
            </h1>

            <?php
                // Variables are called ... well, variables, because they can vary. We can reassign their values throughout the program flow. 
                $name = "Val";

                // The backslash character is our escape character. This tells PHP that whatever comes immediately after it is actually part of the string, not part of PHP syntax.
                echo "<p class=\"lead\">It's good to see you, $name!</p>";
                echo "<p>Did you know that you can hop back and forth between PHP and HTML within a .php file? Neat!</p>";

            ?>
            
            <a href="index.php" class="btn btn-outline-primary my-5">Return to Table of Contents</a>
        </div>
    </section>
</body>

</html>