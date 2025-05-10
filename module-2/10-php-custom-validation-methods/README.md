# Validation

## Why do we validate?

We should never blindly trust user-provided data. Our applications have data requirements. Not only could it be the wrong length or have the wrong format, it could be missing a value altogether. Our job is to write code that reinforces these requirements for the user. 


## How does it work? 

Form validation is usually handled on the front-end first. There are a few reasons for this: 

1. HTML form validation is reasonably good and can be coupled with Regualar Expressions in the pattern attribute. 

2. If common errors can be caught immediately, it saves your server the burden of repeatedly processing the same form data. 

However, in the real world, we will want to do validation on the back-end, too. Not only might you be looking for specific formats or data, but the user might be using an old browser or have JavaScript disabled. You want to be as thorough as possible.

*Note*: Because this is a PHP course, we will _not_ be using front-end validation. From this point onwards, we will _not_ use JavaScript or even HTML attributes like `required` or specific input types because we want to practice doing it all in PHP.


## Common Validations

Data validations can be unique to each project, but there are a few things that we will find ourselves validating over and over again, such as:

1. Presence. Is data present or not? Is a particular variable or value set? 

2. (String) Length. We can make sure that a string is how long we expect it to be (i.e. not too short or not too long).

3. Type. We can make sure that data is the correct type. For example, if we want to use math, we need to make sure that we have a number, not a string. 

4. Format. We can see if something follows a particular pattern or format. Usually, we can achieve this by using regular expressions (RegEx). 

5. Allowed Sets and Range. We can check to see if data is between a set of expected values. This can include numbers (ex. between 0 and 9), letters (ex. between 'A' and 'F'), or if the user has to respond with 'yes' or 'no' (i.e. the allowed set only has two possibilities).

6. Uniqueness. We can make sure that something is singular or unique, such as when a user is signing up for a service. In that example, both their email address and their username has to be unique. 

*Note*: This is something that we will need some sort of saved information, like a database, to check against. 


## Checking for Empty Input

We can use a very simple `empty()` function to see if something isn't filled in.

```PHP
    <?php 
        if ( isset($_POST['name']) && empty($_POST['name'])) {
            echo "<p>Do not leave this field blank.</p>";
        }
    ?>
```

However, this will still let just spaces pass validation. We need a `trim()` as well, which will remove spaces from the beginning and the end of an entry.

```PHP
    <?php 
        if ( isset($_POST['name']) && empty(trim($_POST['name']))) {
            echo "<p>Do not leave this field blank.</p>";
        }
    ?>
```

## RegEx

Regular expressions are a set of characters that describe what specific strings should look like. By comparing our inputs against RegEx, they can help us make sure that the data submitted is appropriate data. 

Here's an example of a RegEx for email. It's looking for any alpha-numeric string, followed by an at symbol, followed by another alphanumeric string with at least one dot. 

```RegEx
    '^[\w\.=-]+@[\w\.=-]+\.[\w]{2,3}$^'
```
