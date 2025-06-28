<?php

$title = "Browse by Filters";
include 'includes/header.php';

// Now, we'll see if the user chose any filters (i.e. if any filters are active). We'll start by initialising the array that will hold everything.
$active_filters = [];

include 'includes/filter-results.php';

/*
    All of our filter values are being stored in the query string. This loop processes everything in the query string ($_GET) to:

    1. Extract each filter and its value.

    2. Ensure all values are stored in an array (even if there's only one value).

        Note: Why? So that we can use methods meant for arrays down below and don't have worry about other data types. 

    3. Sanitise the values to make them safe for display by preventing malicious input. 
*/

foreach ($_GET as $filter => $values) {
    // If any of the values are not arrays, let's convert them into one.
    $values = is_array($values) ? $values : [$values];

    // Now, let's sanitise the values and add them to $active_filters.
    $active_filters[$filter] = array_map(fn($v) => htmlspecialchars($v, ENT_QUOTES | ENT_HTML5, 'UTF-8'), $values);
}

?>

<h2 class="display-5">Filter the Data</h2>
<p class="lead mb-5">Select any combination of the buttons below to filter the data.</p>

<?php

// Let's generate all of the filter buttons for the user to click on. The first (outer) for each loop will take us through all of the different categories available.

foreach ($filters as $filter => $options) {
    // Let's create some headings from our category names. Our categories currently match the column names, however, which makes them unsuitable for heading output. str_replace() will remove all underscores, while ucwords() will capitalise each word.
    $heading = ucwords(str_replace("_", " ", $filter));
    echo "<h3 class=\"fw-light mt-5 mb-2\">" . htmlspecialchars($heading) . "</h3>";

    echo '<div class="btn-group mb-3" role="group" aria-label="' . htmlspecialchars($heading) . ' Filter Group">';

        // Now, let's do our inner for each loop. This will generate all of the buttons for the category using all of the key => value pairs.
        
        foreach ($options as $value => $label) {
            // First, let's see whether or not this specific filter/button is active (if the user has pressed it).
            $is_active = in_array($value, $active_filters[$filter] ?? []);
        }

    echo "</div>";
}

// If there are any active filters, we'll also give the user a 'clear filters' button. This literally just links to the same page without the query string.

if (!empty($active_filters)) : ?>
    <div class="my-5">
        <a href="filters.php" class="btn btn-secondary">Clear Filters</a>
    </div>
<?php endif;

include 'includes/footer.php'

?>