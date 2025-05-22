# Form Handling (via the POST Method)

Processing forms is extremely common. They allow us to capture some sort of data with the user and _do something_ with it. For many websites and web applications, forms (and, as we'll cover later, databases) are the backbone for dynamic functionality. 

Each form has two important attributes, which we'll cover much more in depth: `action` and `method`.

---

## Form Actions

The `action` attribute specifies what will handle or process the data once the form is submitted. It can be a separate file (ex. `process.php`), or the same page as the form.

If we want the page with the form on it to handle everything, we can use the following value:  

```PHP
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>">
``` 

Keep in mind that if we `include()` a separate script that will handle our data, PHP will act as if it's on the same page.


### $_SERVER

So, what is `$_SERVER`? It's something called a _superglobal variable_, which is a predefined array that any part of our script can access (i.e. it has a global scope). 

Specifically, `$_SERVER` provides information about the server and the current request. This can include server and execution environment details, such as URL paths, request method, IP address, and more.


## Form Methods

The `method` value of a form specifies the way (i.e. the HTTP method) that the data will be sent. It can take two possible values: "GET" and "POST".

It's important to choose the appropriate method based on the intended functionality and security requirements of your form. 


### GET

`GET` is the default method if no method attribute is specified. It is commonly used for performing searches or saving the state of a website or application (ex. which page of results you're on). 

`GET` transmits data from one page to another by sending it as part of the URL, called the `query string`. This means that a specific state can be bookmarked, shared, or saved just by saving the URL; however, this also means that the user can directly manipulate things by changing the URL.

Because all of the submitted data is visible in the URL, never use the `GET` method if the form handles any sensitive or personally identifying information, such as email addresses, date of birth, passwords, credit card information, and so forth.


### POST

When the form is submitted using the `POST` method, the form data is not directly visible in the URL. Instead, it is sent in the body of the HTTP request.

This method is commonly used for sending sensitive or large amounts of data to the server, such as submitting forms with passwords or uploading files. However, the data is not bookmarkable or shareable directly through the URL.


### $_GET and $_POST

Whenever a form is submitted, the data is assigned to either the $_GET or $_POST superglobal variable. It is an associative array, where each key is the `name` of an input and each value is whatever the user submitted. 

We access these values in the same way that we would access any array's stored values.

If we want to access data sent via `GET`, we could access it this way:

```PHP
    $username = $_GET['username'];
    echo "Welcome, $username!";
```

Accessing data sent by `POST` works in the same way:

```PHP
    $username = $_POST['username'];
```

However, it's a good idea to put these assignments behind an `if` statement. If we do not check to see whether or not the superglobal variable _has_ any values in it yet -- that is, if we don't check to see if the form has been submitted -- we will be inviting a whole host of errors to our application. 

We can do this by checking to see if the value for the submit button has been set (i.e. if the user has clicked it), or checking to see if any data was sent using `POST`: 

```PHP
    // Is there a value for something with a name of 'submit'?
    if (isset($_POST['submit'])) { ... }

    // Did we get here using the POST method?
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { ... }
```

---


## Ternary Operators

If we want to use variables anywhere in our page, we must initialise them -- and, when we're writing these assignment statements, they're often based upon some condition. In the case of forms, this is usually whether or not the form has been submitted. 

For example, if we have a form where someone is filling out their job title or position, we might have something like this:

```PHP
    if (isset($_POST['job'])) {
        $job = $_POST['job'];
    } else {
        $job = "Placeholder";
    }
```

In this case, if the user filled out a value for the `job` field (that is, the input with a name of job) and submitted the form, we'll assign that value to a new variable; if not, we'll use a placeholder value. 

But what if you initialising a whole field of variables? Using this if/else structure takes up multiple lines and a lot of space, making the code cumbersome to read. Instead, we might use a ternary statement, which looks like this:

```PHP
    $job = isset($_POST['job']) ? $_POST['job'] : 'Placeholder';
```

Here, the first clause (after the `=`) is our condition. After the `?`, we put whatever value we want to assign to `$job` if the condition is met. Finally, after the `:`, we put whatever we want to assign to `$job` if the condition is not met.

This syntax can be a little hard to read at first, but will make initialising multiple variables much quicker.


---


## Today's Problems

Just like our last round of exercises, these will be algorithmic (i.e. they will follow a series of logical steps); however, instead of 'hard-coding' our values, we will write these problems to take form data from the user and do something with it. 

---

### Problem 1: Even or Odd

Write a program that takes a numerical value from the user and determines whether the number is even or odd.

---

### Problem 2: Temperature Converter

Write a program that converts a temperature from Celsius to Fahrenheit or Fahrenheit to Celsius based on user input.

---

### Problem 3: Vowel Counter

Write a program that takes a string input from the user and counts the number of vowels (a, e, i, o, u) in it.


#### Bonus Question

Some English words do not have any of the standard vowels (a, e, i, o, u), but do have a 'y' (ex. any, why, my, sky ...).

Extend your program so that it looks for each word that contains no standard vowel, counts every 'y' in that word, and prints the total number vowels with 'y' words added. 