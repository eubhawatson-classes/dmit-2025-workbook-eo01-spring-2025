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



?>