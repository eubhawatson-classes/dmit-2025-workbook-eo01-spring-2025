/*
    INSERT is the command for the CREATE part of CRUD.

    INSERT INTO table_name (column1, column2, column3, ...) VALUES (value1, value2, value3, ...);
*/

-- Let's enter a new city. We'll use a few unique town names for our examples. This one is the only town in the world with two exclamation points in the name.
INSERT INTO cities (city_name, province, population, is_capital, trivia) VALUES 
('Saint-Louis-du-Ha! Ha!', 'QC', 1311, FALSE, 'A ha-ha is an archaic French word for an impasse, also known as a sunk fence, blind fence, or deer wall.');

-- But what if we wanted to enter multiple cities at once? 
INSERT INTO cities (city_name, province, population, is_capital, trivia) VALUES 
('Happy Adventure', 'NL', 118, FALSE, NULL),
('Flin Flon', 'MB', 5099, FALSE, NULL),
('Vulcan', 'AB', 1769, FALSE, 'Although originally named after the Roman God of Fire (Vulcan), this town features several Star Trek themed attractions.');