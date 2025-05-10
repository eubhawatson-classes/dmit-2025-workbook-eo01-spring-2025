# PHP Database Interaction

There are five basic steps to getting PHP to work with a database: 

1. Create a database connection. This is akin to logging in.

2. Performing a database query.

3. Use the returned data (if any) in some way.

4. Release the returned data.

5. Close the database connection. This is akin to logging out.

The first and last step should only happen once per PHP page.

---

## PHP APIs

PHP offers three different ways to connect to the MySQL database. API is the technical term for each of these connection options. 

Note: API stands for application programming interface, and an API is just a set of functions, which define the way we use the software. 

The three APIs are: 

1. MySQL. This is just the original MySQL API, the most basic way that we can connect to MySQL. As of version 7.0 of PHP, it's deprecated and no longer used.

2. MySQLI, where the "I" stands for improved. 

3. PDO, which is an abbreviation for PHP data objects. 

All three of these are extremely similar. We'll be using MySQLi for this course.

---

## Creating a Connection

The function to create a connection accepts the following arguments:

```PHP
    mysqli_connect($host, $user, $password, $database);
```

It returns a *connection handle*. This is a unique identifier for each connection. We will want to assign it to a variable so that we can use it to make our queries across this open connection. 


## Closing a Connection

When closing a connection, we need to take that handle and pass it into the following function:

```PHP
    mysqli_close($connection);
```

Open MySQL connections are automatically closed when the PHP script finishes execution. So, while you don't technically have to close them yourself, it's recommended (best practice) because it will return resources back to PHP and MySQL (which will improve overall site performance). 


---

## Setting Up on the dmitstudent Server

We're going to create a `connect.php` file that we can use over and over again. 

```PHP
    $connection = mysqli_connect("localhost", "vwatson", "pass", "vwatson_2025_e01", "3306");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
```

Because this is something that we never, ever want the public to have access to, we're going to put it in the data folder. This puts it outside of `public_html` and any other subdirectories that our users might see.

```PHP
    include "/home/vwatson/data/data.php";
```

---

## Exercise

After setting everything up so that you can establish a connection handle to the database, we will go through the following problems and solve them using PHP/SQLi. 

1. Retrieve the names of all cities in the table.
2. Find the city with the highest population.
3. List the cities located in the province of "QC" (Quebec).
4. Count the number of cities in each province.
5. Retrieve the city names and populations for cities with a population greater than 500,000.
6. Sort the cities in alphabetical order by their names.
7. Calculate the average population of all cities.
8. Find the city with the smallest population.
9. List the cities located in provinces starting with the letter "N".
10. Retrieve the city names and populations for cities with populations between 100,000 and 500,000.
11. Retrieve the total population for each province in the "cities" table.