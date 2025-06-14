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

-- If we wanted to match a single character, we could use _ instead of %.

-- We can also string together our conditions with the AND operator.
SELECT * FROM cities WHERE province = 'ON' AND population > 1000000;

-- And we can list our results any way we like. Here, we're listing them in descending order (largest to smallest).
SELECT * FROM cities WHERE province = 'ON' ORDER BY population DESC;

-- What if we want to know which city has the smallest population? 
SELECT city_name, population FROM cities ORDER BY population ASC LIMIT 1;
-- By limiting our result to 1, we're fetching a single result. This will be handy when we want to start doing pagination later. 

-- We can also offset our limit. What if I - instead of the top three most populated cities -- wanted the NEXT GROUP of three cities? 
SELECT city_name, population FROM cities ORDER BY population DESC LIMIT 3, 3;
-- By adding a comma and number after the limit, the system knows to start getting its records from that point. 

/*
    Cities, towns, and villages are defined by the following population requirements: 

    1. City - 10,000 people or greater
    2. Town - 1,000 people or greater
    3. Village - 300 people or greater
*/

-- So, how might we select only cities? 
SELECT city_name, population FROM cities WHERE population >= 10000;

-- What about only towns? 
SELECT city_name, population FROM cities WHERE population >= 1000 AND < 10000;

-- Only villages? 
SELECT city_name, population FROM cities WHERE population >= 300 AND < 1000;