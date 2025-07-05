<?php

/*
    We're going to build a two-dimensional array for: 

    1. all of the filter categories (i.e. which columns can be queried)
    2. the values for each category.

    We'll use a range for the categories involving numbers.
*/

$filters = [
    "continent" => [
        1 => "Latin America",
        2 => "North America &amp; Oceania",
        3 => "Western Europe",
        4 => "Middle East",
        5 => "Africa",
        6 => "South Asia",
        7 => "Eastern Europe &amp; Central Asia",
        8 => "East Asia"
    ],
    "life_expectancy" => [
        "50-60" => "50-60 years",
        "60-70" => "60-70 years",
        "70-80" => "70-80 years",
        "80-90" => "80-90 years",
    ],
    "wellbeing" => [
        "2-4" => "2-4 out of 10",
        "4-6" => "4-6 out of 10",
        "6-8" => "6-8 out of 10",
    ],
    "eco_footprint" => [
        "0-4" => "0-4 global hectares",
        "4-8" => "4-8 global hectares",
        "8-12" => "8-12 global hectares",
        "12-16" => "12-16 global hectares",
    ]
];

$sql = "SELECT * FROM happiness_index WHERE 1 = 1";
$types = "";
$parameters = [];

foreach ($active_filters as $filter => $filter_values) {

    // Queries that use a range (i.e. looks for something BETWEEN two values) are handled differently than the condition to look at specific continents. We'll store all of them in their own little array. Again, we're using arrays so that we can use array methods and do not accidentally overwrite anything.

    $range_queries = [];

    // Let's see if we have any of the categories that require a range query.
    if (in_array($filter, ["life_expectancy", "wellbeing", "eco_footprint"])) {
        // If we do have any of these categories, we need to now look inside and see what the selected values are.
        foreach ($filter_values as $value) {

            // Although we originally wrote all of these values ourselves, we are using the $_GET method, which can be tampered with. We're checking to see if the values still follow an appropriate format.
            if (!preg_match('/^\d+(\.\d+)?-\d+(\.\d+)?$/', $value)) {
                continue;
            }

            // This makes a list (yet another type of array) out of the user's selected range values. It parses everything before the hyphen and after the hyphen to create a minimum and maximum value.
            list($min, $max) = explode("-", $value, 2);

            // TO DO: This line has an error (there are three E's in BETWEEN).
            $range_queries[] = "$filter BETWEEN ? AND ?";
            $types .= "dd";
            $parameters[] = $min;
            $parameters[] = $max;
        }

        if (!empty($range_queries)) {
            $sql .= " AND (" . implode(" OR ", $range_queries) . ")";
        }

        // This line means: "If the current $filter we're looking at in the query string is NOT one of the range filters, but it DOES exists in the $filters array (which we defined ourselves up above), then we will handle it as a standard categorical filter".
    } elseif (array_key_exists($filter, $filters)) {

        // This line build a string of placeholders (?s) for us in a SQL `IN` clause. So, for example, if the user chooses three continents, this will produce: ?, ?, ?
        $placeholders = str_repeat("?,", count($filter_values) - 1) . "?";

        // This will add a SQL fragment like: AND continent IN (?, ?, ?)
        $sql .= " AND $filter IN ($placeholders)";

        $types .= str_repeat("s", count($filter_values));
        $parameters = array_merge($parameters, $filter_values);
    }
}

// When the user initially loads the page, we don't want to show them any results. We're only going to run a query if the user has selected a filter.
if (!empty($active_filters)) {

   echo "<p>$sql</p>";
   var_dump($parameters);
   echo "<p>$types</p>";

    $statement = $connection->prepare($sql);

    if ($statement === FALSE) {
        echo "<p>Error retrieving data (failed to prepare statement). Please try again later.</p>";
        exit();
    }

    $statement->bind_param($types, ...$parameters);

    if (!$statement->execute()) {
        echo "<p>Error retrieving data (statement failed to execute). Please try again later.</p>";
        exit();
    }

    $result = $statement->get_result();

    echo '<h2 class="display-4 mt-5 mb-3">Results</h2>';

    // Now, let's generate our cards.

    if ($result->num_rows > 0) {
        // If we find anything, we'll let the user know and show it to them.
        echo '<p class="mb-5">Here is what we were able to find: </p>';
        echo '<div class="row">';

        while ($row = $result->fetch_assoc()) {
            echo '<div class="col-md-6 col-xl-4 mb-4">';
            include 'includes/country-card.php';
            echo '</div>'; // Close the columm.
        }

        echo '</div>'; // Close the row.

    } else {
        echo '<p class="mb-5">We were not able to find anything matching your selected filters.</p>';
    }

    $statement->close();
}

?>
