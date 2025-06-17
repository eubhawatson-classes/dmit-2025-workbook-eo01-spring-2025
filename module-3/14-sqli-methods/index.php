<?php

// These two lines of code import our credentials (i.e. the things MySQL needs to have in order to be authenticated and access the database) and create a connection handle. We use 'require' rather than 'include' here because if the file cannot be found or if PHP can't login to the database, the engine will throw a fatal error and the page won't load. 
require_once '/home/vwatson/data/connect-eo01.php';
$connection = db_connect();

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Canadian Cities Queries</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body class="container p-3">
    <header class="text-center row justify-content-center my-5">
        <section class="col col-md-10 col-xl-8">
            <h1 class="display-3">Canadian Cities Queries</h1>
            <p class="lead">The answers to all of the following questions are being pulled from the records we currently have stored in our database, one query at a time. This is done programatically, using MySQLi to fetch the records and PHP to display the results to the user. Every single time this page is loaded (or reloaded), the queries are run again.</p>
        </section>
    </header>

    <main class="row justify-content-center">
        <section class="col col-md-10 col-lg-8 col-xxl-6">
            <h2 class="display-4">Questions and Answers</h2>

            <h3 class="mt-4">Question 1: Which city has the highest population?</h3>

            <?php
            // This is SQL query we'd like to run in order to find the answer to our question.
            $sql = "SELECT city_name, population FROM cities ORDER BY population DESC LIMIT 1;";

            // Let's run the query and store the result in a PHP variable.
            $result = mysqli_query($connection, $sql);

            // We don't always know whether or not the query was successful or if any data was returned. Let's check to make sure we have at least one record before trying to show it to the user.
            if (mysqli_num_rows($result) > 0) {
                // If there is at least one record, we need to extract it from the associative array that it arrived in so that we can work with it. 
                $row = mysqli_fetch_assoc($result);
                echo "<p>The city with the highest population is " . $row['city_name'] . " with a population of " . number_format($row['population']) . ".</p>";
            } else {
                echo "<p>No cities found.</p>";
            }
            ?>

            <h3 class="mt-4">Question 2: What are the names of all of the cities stored in our database, in alphabetical order?</h3>

            <?php

            // When ordering a column of strings, it will be in alphabetical order (not numeric). ASC will be A-Z, while DESC will be Z-A.
            $sql = "SELECT city_name FROM cities ORDER BY city_name ASC;";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) > 0) {
                // When we retrieve records from the database, they're returned in an associative array. Let's create a simple indexed array to store everything inside of instead.
                $cities = array();

                // We're going to loop through each row of results to map all the names we need to our new array.
                while ($row = mysqli_fetch_assoc($result)) {
                    // If we use the special [] syntax, we can append each item onto the end of the array rather than overwriting it entirely. This only works with arrays (not any other data type).
                    $cities[] = $row['city_name'];
                }

                // Finally, we can output our results to the user. Here, we're using an array implosion method that takes all of the items in the $cities[] array that we just made and separates them with the syntax of our choosing. 
                echo "<p>The following cities are currently stored in our database: " . implode(', ', $cities) . ".</p>";
            } else {
                echo "<p>No cities found.</p>";
            }
            ?>

            <h3 class="mt-4">Question 3: Which cities are located in the province of "QC" (Quebec)?</h3>

            <?php

            $sql = "SELECT city_name FROM cities WHERE province = 'QC';";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<p>The following cities are located in Quebec:</p>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<p>" . $row['city_name'] . "</p>";
                }
            } else {
                echo "<p>No cities found in Quebec (QC).</p>";
            }

            ?>

            <h3 class="mt-4">Question 4: Count the number of cities in each province.</h3>

            <?php

            $sql = "SELECT province, COUNT(*) AS city_count FROM cities GROUP BY province;";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) > 0) : ?>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Province or Territory</th>
                            <th>Number of Cities</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?= $row['province']; ?></td>
                                <td><?= $row['city_count']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

            <?php else : ?>

                <p>No cities found.</p>

            <?php endif; ?>

            <h3 class="mt-4">Question 5: Retrieve the city names and populations for cities with a population greater than 500,000.</h3>

            <?php

            $sql = "SELECT city_name, population FROM cities WHERE population > 500000;";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<p>" . $row['city_name'] . "'s population is " . number_format($row['population']) . ".</p>";
                }
            } else {
                echo "<p>No cities found.</p>";
            }

            ?>

            <h3 class="mt-4">Question 6: Calculate the average population of all cities.</h3>

            <?php

            $sql = "SELECT AVG(population) AS average_population FROM cities;";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) > 0) {
                // We should only have a single result, which means we don't need to use a while loop to go through each returned row.
                $row = mysqli_fetch_assoc($result);

                echo "<p>The average population of all cities in our database is " . number_format($row['average_population']) . ".</p>";
            } else {
                echo "<p>No cities found.</p>";
            }

            ?>

            <h3 class="mt-4">Question 7: Find the city with the smallest population.</h3>

            <?php

            $sql = "SELECT city_name, population FROM cities ORDER BY population ASC LIMIT 1;";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo "<p>The city with the smallest population in our database is " . $row['city_name'] . ", with a population of " . number_format($row['population']) . ".</p>";
            } else {
                echo "<p>No cities found.</p>";
            }

            ?>

            <h3 class="mt-4">Question 8: List the cities located in provinces starting with the letter "N".</h3>

            <?php

            $sql = "SELECT city_name FROM cities WHERE province LIKE 'N%';";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) > 0) {
                /*
                            Instead of printing out each name on a separate line or having just a list of the city names, we're going to try to put it into a sentence that makes sense for the user: St. John's, Halifax, Yellowknife, and Fredericton are all in provinces starting with the letter 'N'.

                            ... but how do we do the ', and ' before the last item on our list?

                            1. Instead of printing them immediately, map the results to an array.
                            2. Pop the last city (the last item in the array) using the array_pop() method. This removes the last city from the array and stores it separately. 
                            3. Using implode(), the remaining cities can be joined with commas and printed.
                            4. Finally, we can use a little bit of branching logic to account for a case where there's only one city (so we can print it without the extra formatting).
                        */

                $cities = array();

                while ($row = mysqli_fetch_assoc($result)) {
                    $cities[] = $row['city_name'];
                }

                $last_city = array_pop($cities);
                $city_list = implode(", ", $cities);

                echo "<p>";

                // There may be a case where there's only one city. This control structure accounts for that scenario.
                if (!empty($city_list)) {
                    echo $city_list . ", and " . $last_city . " are all cities in a province or territory starting with the letter 'N'.</p>";
                } else {
                    echo $last_city . " is in a province or territory starting with the letter 'N'.</p>";
                }
            } else {
                echo "<p>No cities found.</p>";
            }

            ?>

            <h3 class="mt-4">Question 9: Retrieve the city names and populations for cities with populations between 100,000 and 500,000.</h3>

            <?php

            $sql = "SELECT city_name, population FROM cities WHERE population BETWEEN 100000 AND 500000;";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<p>" . $row['city_name'] . " has a population of " . number_format($row['population']) . ".</p>";
                }
            } else {
                echo "<p>No cities found.</p>";
            }

            ?>

            <h3 class="mt-4">Question 10: Retrieve the total population for each province in the "cities" table.</h3>

            <?php

            $sql = "SELECT province, SUM(population) AS total_population FROM cities GROUP BY province;";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<p>" . $row['province'] . "'s cities have a total population of " . number_format($row['total_population']) . ".</p>";
                }
            } else {
                echo "<p>No cities found.</p>";
            }

            ?>

        </section>
    </main>
</body>

</html>

<?php

db_disconnect($connection);

?>