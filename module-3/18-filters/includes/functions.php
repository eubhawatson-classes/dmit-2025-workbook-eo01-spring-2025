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
    $sql = "SELECT rank, country FROM happiness_index"; // Make sure you don't terminate the statement yet!

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

?>