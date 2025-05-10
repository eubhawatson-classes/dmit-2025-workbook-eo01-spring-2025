# Advanced Search Features

## Search Bars

A search bar is a simple form that lets users look for information within a website or a database. They commonly appear in top-level navigations, but can be included anywhere on a page. 

On the front-end, things are relatively simple: 

```HTML
    <form class="d-flex" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
        <label for="query" class="sr-only">Search</label>
        <input type="search" class="form-control" id="query" name="query" placeholder="Search Our Website" aria-label="Search">
        <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Search">
    </form>
```

On the back-end, after sanitising and validating our inputs, all we need is a simple SQL `SELECT` statement that uses `LIKE` to match the user's input to our records. 

```PHP
    $query = "SELECT * FROM table_name WHERE column_name LIKE CONCAT('%', ?, '%')";
```

Searching for a single phrase is straightforward enough – but what about advanced search forms, where the user is given any number of additional options or ways to narrow down their search?


## Advanced Searches

In an advanced search form, each search option the user chooses adds a new condition to our SQL query. However, because users can pick any combination of options, we don’t always know how many conditions there will be. To handle this, we build **dynamic queries**. 

### Dynamic Queries

With a dynamic query, we:

- Start with a basic query structure.

- Check each search field that the user has filled out.

- Add each selected condition to the query, piece by piece.


However, this makes the programming logic a little more complicated, since there can be so many different combinations of things that the user can do and, ultimately, it all has to be 'translated' into a single SQL statement. 

### WHERE 1 = 1

SQL requires `WHERE` conditions to be joined with `AND` or `OR`, but figuring out where these logical operators should go (i.e. if something is an additional clause after the first `WHERE` condition) is a headache. 

Fortunately, we can use a trick to get around this. 

```SQL
    SELECT * FROM table_name WHERE 1 = 1
    AND ...
    AND ...
```

Because `1 = 1` always resolves as `TRUE`, this lets us start every following condition with an `AND` or `OR` operator. This means that we don't have to keep track of which clause is the first or second to appear within this query. 

**tl;dr**: `WHERE 1 = 1` is a syntactical trick we can use to make every condition start with a logical operator and simplify our code.

### Building Dynamic Prepared Statements

However, all of our queries still must be prepared statements, as this is the current best practice. This means that the next thing we need to do when constructing our query is keep track of: 

1. how many placeholders (?s) we need;

2. their data types; and

3. the order in which they will appear.

This approach lets us generate a SQL statement with only the options the user has selected, making the search flexible and avoiding extra, unused conditions.

In this lesson, we will go through a few different types of search parameters, how to handle them, and how to build our dynamic query. 