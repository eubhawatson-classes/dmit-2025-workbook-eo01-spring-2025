<?php

$title = "Search";
include 'includes/header.php';

// Variable Initialisation
$continents = array(
    1 => "Latin America",
    2 => "North America &amp; Oceania",
    3 => "Western Europe",
    4 => "Middle East",
    5 => "Africa",
    6 => "South Asia",
    7 => "Eastern Europe &amp; Central Asia",
    8 => "East Asia"
);

// Country Name Search
$country_search = isset($_GET['country-search']) ? trim($_GET['country-search']) : "";

// Selected Continents
$selected_continents = isset($_GET['continents']) ? $_GET['continents'] : array();

// Wellbeing Variables
$wellbeing_score = isset($_GET['wellbeing-score']) ?? "";
$wellbeing_value = isset($_GET['wellbeing-value']) ?? "";

// Life Expectancy Variables
$min = isset($_GET['life-expectancy-min']) ?? 50;
$max = isset($_GET['life-expectancy-max']) ?? 90;

?>

<!-- Introduction Area -->
<h2 class="display-5">Browse Our Data</h2>
<p class="mb-5">Explore our data below by country name, continents, wellbeing score, and average lifespan. To get started, pick the options you'd like to use and click the 'Search' button. This will show you the filtered results based upon what you selected.</p>

<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET" class="mb-5 border border-success p-3 rounded shadow-sm">
    
    <h3 class="display-6">Advanced Search</h3>

    <!-- Country Name Search -->
     <fieldset class="my-5">
        <legend class="fs-5">Search By Country</legend>

        <div class="mb-3">
            <label for="country-search">Enter country name:</label>
            <input type="text" id="country-search" name="country-search" value="<?= $country_search; ?>" class="form-control">
        </div>
     </fieldset>

    <!-- Continents -->
     <fieldset class="my-5">
        <legend class="fs-5">Filter By Continent</legend>

        <div class="mb-3">

        </div>
     </fieldset>

    <!-- Wellbeing -->
     <fieldset class="my-5">
        <legend class="fs-5">Search By Wellbeing</legend>

        <div class="mb-3">

        </div>
     </fieldset>

    <!-- Average Life Expectancy -->
     <fieldset class="my-5">
        <legend class="fs-5">Search By Life Expectancy</legend>

        <div class="mb-3">

        </div>
     </fieldset>

    <!-- Submit -->
     <div class="mb-3">
        <input type="submit" id="submit" name="submit" class="btn btn-success" value="Search">
     </div>
</form>

<!-- Results -->

<?php

include 'includes/footer.php';

?>