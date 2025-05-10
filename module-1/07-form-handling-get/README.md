# Form Handling (via the GET method) & Query Strings

Working with the `GET` method is extraordinarily similar to working with `POST`; however, one key difference is that all of our data will appear in the address bar (as a query string).

## Query Strings

What is a query string? You may have seen it on the end of a URL before. It begins with a `?`, followed by name-value pairs. Let's look at an example.

```Plain Text
    https://yourpage.example.com/category/homepage.html?searchterm=puppy%20dogs&search=submit
```

First, let's break down all of the components of this URL.

| URL Fragment     | Component Name           |
|------------------|--------------------------|
| https://         | protocol scheme          |
| yourpage         | subdomain                |
| example          | domain                   |
| .com             | top-level domain         |
| /category/       | filepath                 |
| homepage.html    | file                     |
| ?                | query string operator    |
| searchterm=puppy | query string / parameter |
| %20              | URL encoding             |

What's actually in the query string? It looks like the user submitted a search; their search term was 'puppy dogs' and they pressed the submit button. PHP can now check to see if there are any parameters in the query string and dynamically generate a search page for the user if there are. 

## Accessing Query String Parameters

How can PHP do this? We can access a `$_GET` superglobal array in the exact same way that we access `$_POST`. 

```PHP
    if (isset($_GET['search'])) { ... }
```

This checks to see if the user has hit the submit button (as the name and value of the submit button are also included with the rest of the form).

Because using the `GET` method means we're sending parameters in the address bar, there are a few things to keep in mind:

1. **Users can directly manipulate the URL.** This means that they can save the state of the application and even share their results; however, it also means that (without things like authentication and different levels of authorisation) our web application is less secure.

2. **We can directly manipulate the URL.** This is handy if we want to link to a specific page in a specific state. 


---


## Ternary Operators

If we want to use variables anywhere in our page, we must initialise them -- and, when we're writing these assignment statements, they're often based upon some condition. In the case of forms, this is usually whether or not the form has been submitted. 

For example, if we have a form where someone is filling out their job title or position, we might have something like this:

```PHP
    if (isset($_GET['job'])) {
        $job = $_GET['job'];
    } else {
        $job = "Placeholder";
    }
```

In this case, if the user filled out a value for the `job` field (that is, the input with a name of job) and submitted the form, we'll assign that value to a new variable; if not, we'll use a placeholder value. 

But what if you initialising a whole field of variables? Using this if/else structure takes up multiple lines and a lot of space, making the code cumbersome to read. Instead, we might use a ternary statement, which looks like this:

```PHP
    $job = isset($_GET['job']) ? $_GET['job'] : 'Placeholder';
```

Here, the first clause (after the `=`) is our condition. After the `?`, we put whatever value we want to assign to `$job` if the condition is met. Finally, after the `:`, we put whatever we want to assign to `$job` if the condition is not met.

This syntax can be a little hard to read at first, but will make initialising multiple variables much quicker.