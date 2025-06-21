<?php

/**
 * Counts the number of records we currently have in our table (in case any have been added or removed).
 * 
 * @return int|mysqli_result - number of records in the table
 */
function count_records() {
    global $connection;
    $sql = "SELECT COUNT(*) FROM happiness_index;";
    $results = mysqli_query($connection, $sql);
    $fetch = mysqli_fetch_row($results);
    return $fetch[0];
}

?>