/*
    UPDATE and DELETE are the U and D in CRUD.

    The syntax for UPDATE looks like: 

    UPDATE table_name
    SET column_1 = value_1, column_2 = value_2 ...
    WHERE condition;
*/

-- What if we want to update Toronto so that it is more phoenetic? 
UPDATE cities SET city_name = 'Trana' WHERE cid = 1;

-- Here, we're adding 10000 to the populations of any city in Alberta or Saskatchewan. 
UPDATE cities SET population = population + 10000 WHERE province = 'AB' OR province = 'SK';

/*
    The syntax for DELETE looks like: 

    DELETE FROM table_name WHERE condition; 

    Remember that this operation is permanent. There is no undo. 
*/

-- Here, we're getting rid of Calgary (which has a cid of 16).
DELETE FROM cities WHERE cid = 16;

-- Here, we'll get rid of any 'city' that isn't large enough to be a village. 
DELETE FROM cities WHERE population < 300;