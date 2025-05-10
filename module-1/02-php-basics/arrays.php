<!doctype html>
<html lang="en">

<head>
    <!-- Required Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Insult Generator</title>

    <!-- BS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body class="container text-center">
    <section class="row min-vh-100 align-items-center justify-content-center">
        <div class="col-lg-8">
            <h1 class="display-5 mb-4">Insult Generator</h1>
            <p class="lead">You're nothing but a ...</p>

            <?php
            
                // We're going to create two indexed arrays. And indexed array keeps track of all of its items by numbering them, starting at 0. 

                $adjectives = array('bloody', 'witless', 'lousy', 'lumpy', 'crusty');
                $nouns = array('gremlin', 'fungus', 'goblin', 'juggler', 'cow');
                
                // Items within an indexed array can be chosen with the following syntax: $nouns[3]

                // rand() - chooses a random number within a given range.

                // If we don't know how many items are in an array, we can use count() to figure it out.

                $first_word = $adjectives[rand(0, count($adjectives) - 1)];
                $second_word = $nouns[rand(0, count($nouns) - 1)];

                echo '<p class="fs-3">' . $first_word . ' ' . $second_word . "</p>";
                
                // We could also write this line as: echo "<p class=\"fs-3\">$first_word $second_word</p>";

            ?>
            
            <a href="index.php" class="btn btn-outline-primary my-5">Return to Table of Contents</a>
        </div>
    </section>
</body>

</html>