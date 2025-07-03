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

/**
 * This function grabs only the records we need for one page of paginated results.
 * 
 * @param int $limit
 * @param int $offset
 * @return bool|mysqli_result
 */
function find_records($limit = 12, $offset = 0) {
    global $connection;
    $sql = "SELECT `rank`, `country` FROM happiness_index"; // Make sure you don't terminate the statement yet!

    if ($limit > 0) {
        $sql .= " LIMIT ?";

        if ($offset > 0) {
            // We may or may not have an OFFSET (ex. if we're on page 1). If we do, we'll add it in here, along with an additional parameter for our prepared statement. 
            $sql .= " OFFSET ?;";

            // In this case, we have two parameters (both integers).
            $statement = $connection->prepare($sql);
            $statement->bind_param("ii", $limit, $offset);
        } else {
            // If there is no OFFSET (ex. if we're on page 1), we will have just the one parameter (LIMIT).
            $statement = $connection->prepare($sql);
            $statement->bind_param("i", $limit);
        }
    }

    $statement->execute();
    return $statement->get_result();
}

/**
 * This function builds a full URL, including a query string with any additional values the user would like to add. This prevents us from losing our application state upon triggering a new HTTP request.
 */
function build_query_url($base_url, $filters, $filter, $value) {
    // Let's start by copying the existing filters into a new variable, $updated_filters. This will allow us to work by passing by reference.
    $updated_filters = $filters;

    /*
        We need to check to see if the user has already clicked on this particular filter (and value.)

        isset($updated_filters[$filter]: checks if the filter key exists in the array (so, if the user has clicked on anything from this category yet);

        in_array($value, $updated_filters[$filter]): checks if the value is already present for that filter (so, if the user has clicked on this specific value);

        If the filter (the thing the user is clicking on) exists and already includes the value, we need to remove (toggle OFF) that value.
    */
    if (isset($updated_filters[$filter]) && in_array($value, $updated_filters[$filter])) {

        /*
            array_diff(): This function returns all the elements in the first array that are not present in the second array. Here, it removes $value from the array of values for the specified filter (or category).
        */
        $updated_filters[$filter] = array_diff($updated_filters[$filter], [$value]);

        /*
            We can also remove the category if there are no values / filters currently selected for it.
        */
        if (empty($updated_filters[$filter])) {
            unset($updated_filters[$filter]);
        }

    } else {
        // If the user has clicked on something that is NOT currently active (i.e. in the query string), we need to add it (toggle it ON).
        $updated_filters[$filter][] = $value;
    }

    // http_build_query(): This method takes our array of selected filters and turns it into a query string.
    return $base_url . '?' . http_build_query($updated_filters);

}

?>