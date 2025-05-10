-- We're going to manually create a table to store the login information to an admin account.

CREATE TABLE users (
    account_id INT(3) AUTO_INCREMENT PRIMARY KEY,
    users VARCHAR(16) NOT NULL,
    hashed_pass VARCHAR(72) NOT NULL
);

-- The hash we're using here is BCRYPT, so it is 72 characters in length. 
-- The password is: Password1!

INSERT INTO users (users, hashed_pass)
VALUES ('admin', '$2a$10$xY6.WIZ.Urks9O9rf4JoieOHZovQVDBnvFuXJLg2mmTh29ggBV6U6');

-- Now that we have a username and password in our table, we can try creating a login form and logging in.