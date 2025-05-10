# Password Encryption & PHP Methods

## Hashing & Storing Passwords

The single most important rule about passwords is to *never store them in plain text*. If they aren't hashed, then anyone who has access to the database would have every user's password. 

*Note*: This may include other admins or co-workers, but it could also include hackers. It's also extremely possible that it could be leaked from a backup or from a decommissioned hard drive.

Since users often reuse usernames and passwords, if your organisation is ever the cause of a leak, you will inadvertently compromise the security of other websites. 


### Hashes

A *hashing algoritm* will take a plain text password and turn it into a big long string of characters. It is a one-way operation, so it cannot be reversed or decrypted. 

*Note*: But how could it be only one way? Imagine I took a book, removed all of the spaces and vowels, then alphabetised the remaining glyphs. With so much of the original information discarded, would you be able to figure out how it was originally supposed to look? 

When we register a user, we need to hash their password and then store the hashed value in our database (using the `INSERT` statement). PHP has language-defined functions to do this for us:

```PHP
    // The second argument is which hashing algorithm you'd like to use. PHP's current default is bcrypt.  
    password_hash($password, PASSWORD_DEFAULT);

    // If you prefer, you can specify it, and include options like the cost factor.
    password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
```

If you echo out the result, then refresh, you'll see that the result changes. The reason is that while the hash will always be the same, this function also adds salt. Salt is about 22 characters of randomised data that the algorithm generates. 


### Comparing Hashes

Wait, so how does this work? If the only thing we're storing are hashed versions of a password (which looks like jumbled garbage) and the same password can generate multiple _unique_ hashes, how do we know if the user typed in the correct thing? 

Well, when a user logs in, we hash whatever they typed into the password input. Then, we'll compare that hash to whatever password hash we have stored in the database. It's likely that they will not be identical, but PHP has a built-in function to check if it's possible that two hashes originated from the same source (i.e. the original plain text passwords).

```PHP
    password_verify($login_password, $database_password);
```