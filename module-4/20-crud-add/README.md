# CRUD Applications: Add

Allowing our user to add, edit, or delete things in our database via a webform is inherently risky. This is largely due to the way that SQL is syntactically structured -- and how this predictable structure can be easily exploited.

The number one way that a bad actor (either a user with malicious intentions or a script or bot that executes arbitrary code) can ruin our database is through SQL Injections.


## SQL Injections

An SQL Injection is when a hacker is able to execute arbitrary SQL requests. The hacker submits a string that manipulates standard SQL syntax and injects their SQL code into our code.

Any SQL queries that use dynamic data values are vulnerable. 

It doesn't matter where the data originates, either: it can come from URL parameters (a query string), form data, cookies, sessions, or data already in the database. All of these are vulnerable entry points to a hacker.

Because of this, SQL Injections are constantly ranked as the number one security risk on the web by OWASP (Open Web Application Security Project). 


### How do SQL Injections work? 

When data is inserted using SLQ, it's enclosed in single quotes. This can cause bugs in very innocent ways. For example: 

```SQL
	INSERT INTO subjects (menu_name, visible) VALUES ('David's Story', TRUE);
```

In this example, the apostrophe in `David's` causes a syntactical error. SQL expects that a comma should come after `David`, not the rest of the word or phrase.

A hacker can exploit this bug to cause chaos. They can also use semicolons to execute additional SQL commands.

```PHP
	$input = "' INSERT INTO admins (username, password) VALUES ('hacker', 'mypassword1'); --"
```

In this case, a hacker is trying to create a username and password that allows them to login to a new account with administrative privileges. 

*Note*: The double dash (--) at the end of the injection is SQL syntax for a comment. This means that anything following it will be ignored. Often, this will prevent the application from throwing an error.


### How do we prevent SQL Injections? 

Just like we break down `specialchars` (special syntax or characters) that have meaning in HTML to prevent cross-site scripting attacks, we can convert any characters with meaning in SQL to data before sending it off to be executed by MySQLi. 

Simply put? We need to add a backslash `\` before all single quotes in a string. This is how we escape them for SQL. 

Let's take our example from earlier:

```SQL
	INSERT INTO subjects (menu_name, visible) VALUES ('David\'s Story', TRUE);
```

By adding the escape character, SQL no longer things the single quote is part of a statement to be executed. 


### PHP built-in functions

The following functions can help add backslashes before a single quote:

```PHP
	/* This takes a string (generally your user input) and adds slashes before characters that need to be escaped, like single quotes, double quotes, a backslash, and the null character. */

	addslashes($string);

	/* This is part of the MySQLi API and is designed specially for SQL injections. In addition to the method above, it also escapes characters like line return and other weirdness. */

	mysqli_real_escape_string($db, $string);

```

*Note*: More on null characters can be read here: https://owasp.org/www-community/attacks/Embedding_Null_Code

Note that the second method requires the database connection handle, so it will only work when we have an active connection to a database. This is because it takes into account things like the charset the database uses when sanitising the input. 


## Prepared SQL Statements 

Prepared SQL statements in PHP allow you to execute SQL queries with parameters that are provided separately from the query itself. This can help prevent SQL injection attacks, as well as improve performance when executing multiple queries with the same structure.

### Example

```PHP
// Create a new mysqli object with your database credentials
$mysqli = new mysqli("localhost", "username", "password", "database");

// Prepare a statement with a parameter placeholder
$stmt = $mysqli->prepare("SELECT * FROM users WHERE id = ?");

// Bind the parameter to a variable
$id = 123;
$stmt->bind_param("i", $id);

// Execute the statement and get the result set
$stmt->execute();
$result = $stmt->get_result();

// Loop through the result set and fetch each row as an associative array
while ($row = $result->fetch_assoc()) {
    echo $row["name"] . "<br>";
}

// Close the statement and connection
$stmt->close();
$mysqli->close();

```

In this example, we create a mysqli object to connect to the database, and then prepare a statement with a parameter placeholder using the `prepare()` method. We then bind the parameter to a variable using the `bind_param()` method, and execute the statement with the `execute()` method. Finally, we loop through the result set and fetch each row as an associative array using the `fetch_assoc()` method.


### Prepared Statements and SQL Injections

Prepared SQL statements help prevent SQL injection attacks by separating the SQL query from the user-provided input. When using prepared statements, the query is first prepared with placeholders for the input parameters, and then the actual values for the parameters are bound to the placeholders before the query is executed.

This process ensures that the user input is properly sanitized and escaped before being added to the query. The database engine then treats the input as data rather than part of the SQL query, eliminating the possibility of SQL injection attacks.

Here's an example of how prepared statements can prevent SQL injection attacks:

```PHP
// User input
$username = "'; DROP TABLE users; --";

// Prepared statement
$stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ?");

// Bind parameter
$stmt->bind_param("s", $username);

// Execute statement
$stmt->execute();

```

In this example, if we were to concatenate the user-provided $username variable directly into the SQL query, it would cause the users table to be dropped. However, because we're using a prepared statement and binding the parameter, the database engine treats the user input as data rather than as part of the SQL query, preventing the SQL injection attack.


## tl;dr

Prepared statements make web applications safer by separating the SQL query from user input, and properly sanitizing and escaping the input before it is added to the query. This ensures that user input is treated as data rather than as part of the SQL query, eliminating the possibility of SQL injection attacks.


## Getting Started  

Before beginning today's lesson, follow these steps:  

1. **Copy and Paste Previous Files**  
   - Locate the `private` and `public` directories from the previous lesson.  
   - Copy and paste them into your working directory for this lesson.  

2. **Upload Files to the Server**  
   - Use an FTP client (e.g., FileZilla) to upload the copied files to the server.  
   - Verify that all files are successfully transferred before proceeding.  

### Files to Modify Today  

Today, we'll be working with the following files:  

- **`private/functions.php`** – Add a data validation function, plus an array for provinces and territories.  
- **`private/prepared.php`** – Add an `INSERT` function.  
- **New File:** `public/add.php`