<?php 

/*
    If we want to do anything on a database, we need to connect to it AND be authorised to use it! 
    Here, we're going to create a connection string. We will include this in every subsequent page in our website.

    Because these credentials are HARD CODED, this is a very dangerous file. We need to make sure that, if this were a live server, that it never goes into public_html/ (only a directory outside of public_html/, like a data/ folder made specifically for this purpose).
*/

// Note: why localhost? If the database is on the same server as the website, it's localhost (i.e. the same computer).
define("DB_SERVER", "localhost");
define("DB_USER", "student");
define("DB_PASS", "student");
define("DB_NAME", "db_name");

function db_connect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } else {
        // There are three places we need to check to make sure we have the correct character encoding: the database, our HTML document, and here, in our MySQLi connection handle. By setting the charset to an extended form of UTF-8, we can make sure that all characters (including accents) display properly.
        $connection->set_charset('utf8mb4');
        return $connection;
    }
}

// This uses $connection as a parameter because it's not in scope. Also, if the connection is never made in the first function and returned, then this won't work. There's no point in closing a connection that doesn't exist.
function db_disconnect($connection) {
    if(isset($connection)) {
        mysqli_close($connection);
    }
}

?>