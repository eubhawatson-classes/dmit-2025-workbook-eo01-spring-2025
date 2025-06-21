<?php

// NOTE: This file can only be included/used AFTER a query has been made and we already have a results set. Because it uses $row[], we'll include it wherever we want our country card(s) printed.

// All of our continents are stored as a single integer in order to save space. Let's start by creating an array with all of the names of the continents for the user.

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

// Let's 'translate' the integer to the continent's actual name.
$continent = $continents[$row['continent']];

// Next, population is stored in the thousands, so let's make it a nicer number for the user.
$population = number_format($row['population'] * 1000);

// We can also format GDP, which is money, ahead of time.
$gdp = "$" . number_format($row['gdp_per_capita']);

?>

<!-- Card Output -->
<div class="card px-0">
    <div class="card-header text-bg-dark">
        <h3 class="card-title fw-light fs-5"><?= $row['country']; ?></h3>
    </div> <!-- end of .card-header -->
    <div class="card-body">
        <!-- Ranking -->
         <p class="card-text"><span class="fw-bold">Ranking</span>: <?= $row['rank']; ?></p>

        <!-- Continent -->
         <p class="card-text"><span class="fw-bold">Continent</span>: <?= $continent; ?></p>

        <!-- Population -->
         <p class="card-text"><span class="fw-bold">Population</span>: <?= $population; ?></p>

        <!-- Life Expectancy -->
         <p class="card-text"><span class="fw-bold">Life Expectancy</span>: <?= $row['life_expectancy']; ?></p>

        <!-- Wellbeing -->
         <p class="card-text"><span class="fw-bold">Wellbeing</span>: <?= $row['wellbeing']; ?></p>

        <!-- Happy Planet Index -->
         <p class="card-text"><span class="fw-bold">Happy Planet Index</span>: <?= $row['hpi']; ?></p>

        <!-- GDP (per Capita) -->
         <p class="card-text"><span class="fw-bold">GDP (per Capita)</span>: <?= $gdp; ?></p>
        
    </div> <!-- end of .card-body -->
</div> <!-- end of .card -->