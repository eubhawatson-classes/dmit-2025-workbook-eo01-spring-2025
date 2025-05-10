# Pagination 

Pagination is a way of organising long lists or results into distinct pages. This helps prevent the user from being visually overwhelmed, helps things fit within your layout, and requires the server to do less work all at once. 

It is used all over the web, including things like Google Search results. For example, if you search for a common concept or phrase like 'puppy dogs', you will get upwards of 653,000,000 results. Since Google couldn't funciton if it were constantly churning out 653M results to its users for simple queries, it paginates the results. 

Note: If the server only has to retrieve 25 results at a time rather than hundreds or even thousands, then it's quicker for the end user and the server can spend all of that processing power on handling multiple requests instead. 


## Finding Pagination Values

In order to write our code for pagination, we need: 

1. The current page. This is usually handled in the query string (i.e. the address of the page). 

```PHP
	// We're using the null coalesce operator (??), which gives our current page a default value of 1 if it isn't set.

	$current_page = (int) ($_GET['page'] ?? 1);

	// Since anything in a query string will always be a string, we're using typecasting to sure that the variable is an integer. We want this so that we can compare values, or increment / decrement to get the next and previous pages.

	$next_page = $current_page + 1;
	$previous_page = $current_page - 1;

	// And because we're using a query string, we should make sure that the page is within reasonable bounds, or isn't a negative number. 

	if ($current_page < 1 || $current_page > $total_pages) {
		$current_page = 1;
	}
```

2. the number of records per page

```PHP
	// There's no set standard for how many variables you show per page. It depends on the layout and your server. 
	$per_page = 20;

	// We can also calculate our offset number, which is the number of records that we need to skip over in order to get to the current page. 
	$offset = $per_page * ($current_page - 1);
```

3. the total record count

```PHP
	// If our records are being stored in an array, we can use the count() function. 
	$total_count = count($array_name);
	// We'll use the ceiling function to count the total number of pages because it will round up if it returns a decimal (ex. 25 / 20 == 1.25, so we'd need two pages).
	$total_pages = ceil($total_count / $per_page);

	if ($current_page == $total_pages) {
		// If this condition is met, then we know that we're on the final page. Then, we can get rid of the 'next' button or disable it altogether. 
	}
```

```SQL
	-- However, if the records are being stored in a database, we'll need to write a query to ask the database how many there are. 
	SELECT COUNT(*) FROM happiness_index;
	-- This only counts the records and returns the total number of them. It does not actually retrieve them. You will need a separate statement for that.
```


## SQL LIMIT and OFFSET

When working with pagination and data from a database, we should limit the number of records that our query returns. This makes sure that we aren't retrieving any more records than we need.

```SQL
	SELECT * FROM happiness_index LIMIT 30;
```

But how can we work with records *after* the thirtieth? 

```SQL
	SELECT * FROM happiness_index LIMIT 30 OFFSET 30;
```

This will skip the first 30 records and grab the next 30 (i.e. the second page).

When using these conditions, `LIMIT` and `OFFSET` always go at the end. Also, `LIMIT` must always come before `OFFSET`. 