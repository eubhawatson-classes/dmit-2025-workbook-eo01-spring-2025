<?php

$title = "Problem 3";
include 'includes/header.php';

/*
    Write a program that checks the day of the week using the `date()` function.

        Hint: You can get the name of the day of the week by passing in "l".

    Print a message telling the user what day it is. Next, using a switch statement, check the day of the week and tell the user what day it would correspond to in the Old Norse calendar. 

    Here are the names of the days of the week in the Old Norse calendar, along with the gods and goddesses they were named after:

        Sun's Day (Sunnudagr) - named after the goddess Sunna
        Moon's Day (Mánadagr) - named after the god Máni
        Tyr's Day (Týsdagr) - named after the god Tyr
        Odin's Day (Óðinsdagr) - named after the god Odin
        Thor's Day (Þórsdagr) - named after the god Thor
        Freyja's Day (Freyjudagr) - named after the goddess Freyja
        Saturn's Day (Laugardagr) - named after the planet Saturn


        There are tonnes of ways we can represent a date: 

        British / European Notation 
        14 May 2025
        14 05 2025
        14 05 25

        American (US) Notation
        May 14 2025
        May 14th 2025
        05 14 2025
        05 14 25

        Japanese (JP) Notation
        2025 May 14
        2025 05 14
        25 05 14

        ... and even more!

        But how does a Linux server calculate the time? 

        It counts the number of seconds that have passed since 01 January 1970 @ 00:00. This is called Unix Time (or the Unix Epoch).
*/

// We're going to pass in a lowercase "L", which stands for "longform day of the week" (ex. Wednesday).
date_default_timezone_set("America/Edmonton");
$day = date("l");

echo "<p>Today is $day.</p>";

echo "<p>In the Old Norse calendar, today was named ";

switch ($day) {
    case "Sunday":
        echo "Sun's Day (Sunnudagr) - named after the goddess Sunna.</p>";
        break;
    case "Monday":
        echo "Moon's Day (Mánadagr) - named after the god Máni.</p>";
        break;
    case "Tuesday":
        echo "Tyr's Day (Týsdagr) - named after the god Tyr.</p>";
        break;
    case "Wednesday":
        echo "Odin's Day (Óðinsdagr) - named after the god Odin.</p>";
        break;
    case "Thursday":
        echo "Thor's Day (Þórsdagr) - named after the god Thor.</p>";
        break;
    case "Friday":
        echo "Freyja's Day (Freyjudagr) - named after the goddess Freyja.</p>";
        break;
    case "Saturday":
        echo "Saturn's Day (Laugardagr) - named after the planet Saturn.</p>";
        break;
    default: 
        echo "... actually, I'm not sure what days of the week it is!</p>";
}

echo '<a href="index.php" class="btn btn-outline-primary my-5">Return to Table of Contents</a>';

include 'includes/footer.php';

?>