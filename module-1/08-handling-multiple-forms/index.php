<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required Meta Tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mean, Median, &amp; Mode Calculator</title>

        <!-- BS Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>

    <body>
        <main class="container mt-5">
            <section class="row justify-content-center">
                <div class="col-md-10 col-lg-9 col-xxl-8">
                <h1 class="mb-5 text-center">Mean, Median, &amp; Mode Calculator</h1>

                    <div class="row">
                        <div class="col-md-6">
                            <aside class="card">
                                <div class="card-header bg-info">
                                    <h2 class="card-title">What are Mean, Median, and Mode?</h2>
                                </div>
                                <div class="card-body">
                                    <p class="mb-4 text-body-secondary">The mean, median, and the mode are different ways of figuring out the 'centre', or a 'typical' data point, in a given set of numbers.</p>
                                    
                                    <dl>
                                        <dt>Mean</dt>
                                        <dd>The "average" number; found by adding all data points and dividing by the number of data points.</dd>

                                        <dt>Median</dt>
                                        <dd>The middle number; found by ordering all data points and picking out the one in the middle.</dd>

                                        <dt>Mode</dt>
                                        <dd>The most frequent number—that is, the number that occurs the highest number of times.</dd>
                                    </dl>

                                    <p class="mt-4 text-body-secondary">Enter ten numbers into the form to the right -- and, when you're ready, hit 'Calculate' to see the mean, median, and mode of your data set.</p>
                                </div> <!-- end of .card-body -->
                            </aside> <!-- end of .card -->
                        </div>

                        <div class="col-md-6">
                            <!-- Let's do something a little different. Let's start by asking the user how many numbers are in their data set (i.e. how many inputs they need). -->
                            <?php 
                                // Retain the set-length value from either GET or POST
                                $set_length = '';

                                switch (true) {
                                    case isset($_GET["set-length"]):
                                        $set_length = htmlspecialchars($_GET["set-length"]);
                                        break;
                                    case isset($_POST["set-length"]):
                                        $set_length = htmlspecialchars($_POST["set-length"]);
                                        break;
                                }
                                
                                include('process.php'); 
                            ?>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" class="mb-5">
                                <fieldset>
                                    <legend>
                                        Let's start with you.
                                    </legend>
                                    <div class="mb-3">
                                        <label for="set-length" class="form-label">How many numbers are in your data set?</label>
                                        <input type="number" id="set-length" name="set-length" class="form-control" value="<?php echo $set_length; ?>">
                                    </div>
                                </fieldset>
                                <input type="submit" id="submit-get" name="submit-get" value="Generate Form" class="btn btn-info">
                            </form>

                            <?php if ($set_length != '') : ?>

                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <?php
                                // When you submit a form, you wipe out any data that was previously in $_GET or $_POST. One way to make sure you retain a value (like the number of terms in a data set) is to use a hidden input.

                                echo "<input type=\"hidden\" name=\"set-length\" id=\"set-length\" value=\"{$set_length}\">";

                                for ($i = 1; $i <= $set_length; $i++) {
                                    /* 
                                        This is a ternary statement, which is a shorthand for an if/else decision. We're checking to see if the user has given us anything (if there is already an existing value) for each input: if there is, we'll echo it out into the input; if not (else), we'll leave it blank. 
                                        
                                        This is very important for user retention! If, for example, they realise they input something incorrectly or they fail validation, we want to make sure that they don't have to fill an entire form again. 
                                    */
                                    $value = isset($_POST["num{$i}"]) ? htmlspecialchars($_POST["num{$i}"]) : '';
                                    echo "<div class='mb-3'>";
                                    echo "<label for='num{$i}' class='form-label'>Enter Number {$i}:</label>";
                                    echo "<input type='number' class='form-control' name='num{$i}' id='num{$i}' value='{$value}' required>";
                                    echo "</div>";
                                }
                                ?>
                                <input type="submit" class="btn btn-info my-4" value="Calculate">
                            </form>

                            <?php endif; ?>
                        </div> <!-- end of form .col -->
                    </div> <!-- end of row -->

                </div> <!-- end of max width col -->
            </section> <!-- end of row -->
        </main>
    </body>
</html>