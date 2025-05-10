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

?>