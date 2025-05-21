# Form Handling (via the GET method) & Query Strings

Working with the `GET` method is extraordinarily similar to working with `POST`; however, one key difference is that all of our data will appear in the address bar (as a query string).

## Query Strings

What is a query string? You may have seen it on the end of a URL before. It begins with a `?`, followed by name-value pairs. Let's look at an example.

```TXT
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

Alternatively, we could also use a more generic way to check if there is a HTTP GET request (i.e. if the page reloaded because the user submitted a form that uses the GET method).

```PHP
    if ($_SERVER['REQUEST_METHOD'] == 'GET') { ... }
```

So, now that we've checked to see whether or not there's anything inside of `$_GET`, what does the data look like inside?

In our example above, our full URL looked like the following:

```TXT
    https://yourpage.example.com/category/homepage.html?searchterm=puppy%20dogs&search=submit
```

`$_GET` array would look like the following: 

```PHP
$_GET = [
  'searchterm' => 'puppy dogs',
  'search'     => 'submit',
];
```

## Additional Considerations

Because using the `GET` method means we're sending parameters in the address bar, there are a few things to keep in mind:

1. **Personally Identifiable Information (PII) should never be sent via GET.** Login information, email addresses, or any other potentially sensitive information should never be included in a query string.

2. **Only text can be sent via GET.** If we have a form that asks a user for things like files or images, we should use POST instead.

3. **Query strings have a limited length.** In theory, URI specification (RFC 2616/RFC 3986) does not impose any maximum on the length of a URL or its query string — but in practice, clients (browsers) and servers have their own limits. To ensure maximum compatibility, try to keep the maximum URL length below ~2,000 characters.

4. **Users can directly manipulate the URL.** This means that they can save the state of the application and even share their results; however, it also means that (without things like authentication and different levels of authorisation) our web application is less secure.

5. **We (as developers) can directly manipulate the URL.** This is handy if we want to link to a specific page in a specific state. 

6. **We cannot blindly trust anything in the URL.** Anyone can tamper with a URL (or disable your HTML form’s controls) to send unexpected values. If we do, it can lead to logic errors or leave us open to security vulnerabilities. 