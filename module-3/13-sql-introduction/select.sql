/*
    The SELECT command is what allows us to 'read' or retrieve data. 

    SELECT column_name FROM table_name ...
*/

-- This would return all of the names of our cities but nothing else.
SELECT city_name FROM cities;

-- What if we want the complete record for only three cities? The * reads as 'all' or 'grab every column from this table'.
SELECT * FROM cities LIMIT 3;

-- Now, what if we know the PK of the record we want to retrieve? 
SELECT * FROM cities WHERE cid = 4;

-- We could select every city from Ontario using a similar technique (just for strings).
SELECT * FROM cities WHERE province = 'ON';

-- We could select all of the capital cities also in the same way; however, because it's a BOOLEAN value, we do not need the single quotes.
SELECT * FROM cities WHERE is_capital = TRUE;

-- ... but BOOLEAN values can be represented as TRUE/FALSE or as integers.
SELECT * FROM cities WHERE is_capital = 1;

-- LIKE let us look for a pattern in our data. The % is a wildcard character. It allows us to match any string of any length (including zero). 
SELECT * FROM cities WHERE city_name LIKE '%john%';

-- If we wanted to match a single character, we could us _ instead of %.