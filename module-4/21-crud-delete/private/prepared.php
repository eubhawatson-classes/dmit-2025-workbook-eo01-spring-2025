<?php

/*
    This script will use prepared statements, which adds a layer of abstraction between our user's (potentially dangerous) input and the SQL statements that we're executing. 

    NOTE: If we're only reading out data to the user and not accepting any input from something like a web form, we don't really need to use prepared statements because everything is procedural at that point; however, we're going to use this method for all of the other pages in our CRUD application, so we'll try to get in the habit of using it now (and set up this file for later additions). 

    Just like our simple MySQLi methods, using prepared statements for our queries means we need to follow a certain series of events. 

    1. Make sure we're connected to the database (this is in our included header.php file).
    2. Write the SQL query with placeholders (?) for each parameter.
    3. Prepare the query using $connection->prepare($query) while handling any errors if this fails.
    4. Bind the input values to the placeholders in the query using $statement->bind_param() and specify the data type of each parameter.
    5. Pass the variables or values as arguments to bind_param().
    6. Call $statement->execute() to execute the query with the bound parameters.
    7. For SELECT queries, retrieve the result set using $statement->get_result().
    8. Close the prepared statement after finished to free up server resources.
*/

function execute_prepared_statement($query, $params = [], $types = "") {
    global $connection;

    $statement = $connection->prepare($query);

    // If our preparations fail, we need to handle the error and quit this function.
    if (!$statement) {
        die("Preparation failed: " . $connection->error);
    }

    // If we need to bind any parameters (i.e. if we're adding, editing, or deleting), we'll do so here. 
    if (!empty($params)) {
        $statement->bind_param($types, ...$params);
    }

    // This executes the statement right from within our IF condition. If it's FALSE or doesn't work for whatever reason, we'll handle the error and quit the function.
    if (!$statement->execute()) {
        die("Execution failed: " . $connection->error);
    }

    // If it's a SELECT query, we should return the results so that we can print them out for the user. 
    if (str_starts_with($query, "SELECT")) {
        return $statement->get_result();
    }

    // If it's NOT a SELECT query and we successfully executed our prepared statement, we'll just return TRUE to indicate it was successful.
    return TRUE;
}

/**
 *  This function retrieves all cities using a simple SELECT statement.
 *  There are no user-provided values or ?s required here.
*/
function get_all_cities() {
    $query = "SELECT * FROM cities;";
    $result = execute_prepared_statement($query);

    return $result->fetch_all(MYSQLI_ASSOC);
}

/**
 * INSERT (i.e. create or add) a new city into the database; used in the Add page.
 * 
 * @param string $city_name 
 * @param string|ENUM $province 
 * @param int $population
 * @param int|BOOL $is_capital
 * @param string|NULL $trivia
 * 
 * @return BOOL Whether or not the prepared statement was properly exectued (from execute_prepared_statement()).
 */
function insert_city($city_name, $province, $population, $is_capital, $trivia) {
    // If the user did not make a selection for whether or not the city is a capital, we'll default to 'No'.
    if (!isset($is_capital)) {
        $is_capital = 0;
    }

    // Trivia is optional and may be left empty; if it is, we'll set it to NULL.
    if (empty($trivia)) {
        $trivia = NULL;
    }

    $query = "INSERT INTO cities (`city_name`, `province`, `population`, `is_capital`, `trivia`) VALUES (?, ?, ?, ?, ?);";
    return execute_prepared_statement($query, [$city_name, $province, $population, $is_capital, $trivia], "ssiis");
}

?>