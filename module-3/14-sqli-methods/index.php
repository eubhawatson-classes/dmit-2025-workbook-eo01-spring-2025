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

                <h3 class="mt-4">Question 2: What are the names of all of the cities stored in our database, in alphabetical order?</h3>

                <h3 class="mt-4">Question 3: Which cities are located in the province of "QC" (Quebec)?</h3>

                <h3 class="mt-4">Question 4: Count the number of cities in each province.</h3>

                <h3 class="mt-4">Question 5: Retrieve the city names and populations for cities with a population greater than 500,000.</h3>

                <h3 class="mt-4">Question 6: Sort the cities in alphabetical order by their names.</h3>

                <h3 class="mt-4">Question 7: Calculate the average population of all cities.</h3>

                <h3 class="mt-4">Question 8: Find the city with the smallest population.</h3>

                <h3 class="mt-4">Question 9: List the cities located in provinces starting with the letter "N".</h3>

                <h3 class="mt-4">Question 10: Retrieve the city names and populations for cities with populations between 100,000 and 500,000.</h3>

                <h3 class="mt-4">Question 11: Retrieve the total population for each province in the "cities" table.</h3>

            </section>
        </main>
    </body>
</html>