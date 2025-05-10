/*
    This script will create a table in our database and add some data to it. Even if you use the GUI to create tables and records in PHPMyAdmin, it's a good idea to keep a copy of your original script, just in case something happens and you have to drop the table and start again.
*/

-- All queries have a certain order to them. This one, which you'll complete with your instructor, creates a table, defines all of its columns, and determines which data type each column will be. We also have to decide whether a column allows null data and what the primary key is. 

CREATE TABLE cities (
    
);

/*
    In this statement:

    1. The cid column is defined as an integer (INT) and marked as the primary key (PRIMARY KEY). It also has the AUTO_INCREMENT attribute, which means the values will automatically increment for each new row inserted.
    
    2. The city_name column is defined as a variable-length string (VARCHAR) with a maximum length of 36 characters. The NOT NULL constraint ensures that this column must have a value and cannot be left empty.

        Note: Why 36 characters? The longest location name in Canada is 'Pekwachnamaykoskwaskwaypinwanik Lake', which is 36 characters long. 
    
    3. The province column is defined as a variable-length string (VARCHAR) with a length of 3 characters. The NOT NULL constraint is applied to enforce that this column must have a value.
    
    4. The population column is defined as an integer (INT) with a length of 10 digits. The NOT NULL constraint is applied to ensure this column must have a value.

    5. The is_capital column is BOOLEAN value, which can be TRUE or FALSE, or a 0 or 1. Each city either is (TRUE or 1) or isn't (FALSE or 0) a capital of its province or territory. 

    By including the NOT NULL constraint for each column, you enforce that none of the columns can be left empty when inserting data into the table. However, the sixth column is unique. 

    6. The trivia column can be NULL, which means there may be a fun fact about the city or it may be left empty. When we handle this later on, in our CRUD application in Module 4, we need to be careful that we check to see if there is a value in this column before doing anything with it.
*/

-- After running this (in PHPMyAdmin, selecting the database, going to the 'SQL' tab, pasting it into the text box, and hitting 'Go'), let's add some data.

INSERT INTO cities (city_name, province, population, is_capital, trivia) VALUES
('Toronto', 'ON', 2731571, TRUE, 'Home to the iconic CN Tower'),
('Ottawa', 'ON', 1013242, FALSE, 'Features the scenic Rideau Canal, a UNESCO World Heritage Site'),
('Mississauga', 'ON', 717961, FALSE, NULL),
('Hamilton', 'ON', 569353, FALSE, NULL),
('London', 'ON', 422324, FALSE, NULL),
('Sudbury', 'ON', 166004, FALSE, 'Known for its unique mining history'),

('Montreal', 'QC', 1780000, FALSE, 'Renowned for its vibrant arts and festival scene'),
('Quebec City', 'QC', 549459, TRUE, 'One of the oldest cities in North America with rich French heritage'),
('Laval', 'QC', 437413, FALSE, NULL),
('Gatineau', 'QC', 291041, FALSE, NULL),
('Sherbrooke', 'QC', 172950, FALSE, NULL),

('Vancouver', 'BC', 662248, FALSE, 'Surrounded by mountains and water, a hub for film and outdoor activities'),
('Victoria', 'BC', 92441, TRUE, 'Charming city known for its historic architecture and gardens'),
('Surrey', 'BC', 568322, FALSE, NULL),
('Kelowna', 'BC', 144576, FALSE, NULL),

('Calgary', 'AB', 1306784, FALSE, 'Famous for its annual Calgary Stampede'),
('Edmonton', 'AB', 1057790, TRUE, 'Home to one of North America''s largest mall complexes'),
('Red Deer', 'AB', 106736, FALSE, NULL),

('Saskatoon', 'SK', 273010, FALSE, 'Nicknamed the "Paris of the Prairies" for its vibrant culture'),
('Regina', 'SK', 226404, TRUE, 'Known as the "Queen City" with beautiful parks'),

('Winnipeg', 'MB', 749607, TRUE, 'Home to The Forks, a historic meeting place'),
('Brandon', 'MB', 51424, FALSE, NULL),

('Halifax', 'NS', 439819, TRUE, 'Famous for its maritime history and seafood cuisine'),

('Fredericton', 'NB', 63116, TRUE, 'A picturesque city along the St. John River'),
('Moncton', 'NB', 79470, FALSE, NULL),
('Saint John', 'NB', 69375, FALSE, NULL),

('Charlottetown', 'PE', 39285, TRUE, 'Birthplace of Canadian Confederation'),

('St. John\'s', 'NL', 110525, TRUE, 'Known for its jellybean-colored row houses'),

('Whitehorse', 'YT', 28376, TRUE, 'Gateway to Canada''s vast wilderness'),

('Yellowknife', 'NT', 20116, TRUE, 'Famous for aurora viewing and located on the edge of the Canadian Shield'),

('Iqaluit', 'NU', 7740, TRUE, 'Home to unique Arctic culture and scenic landscapes');


/* We'll go over INSERT statements and even write some of our own in our next file. */