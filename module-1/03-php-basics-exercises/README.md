# PHP Basics: Exercises

Now that we have the basics tucked away, let's walk through a few exercises together. 

These exercises will be algorithmic (i.e. they will follow a series of logical steps) and will help us solve specific problems through the lense of this new language. 

---

## Problem 1

Write a script that begins with two variables. Each variable should be a number.

Echo out these variables. 

Next, figure out a way to assign the value of the first variable to the second variable and the value of the second variable to the first variable; however, you are not allowed to use numbers at this point, only variable names. 

Hint: Try using a third variable.

Echo out the final output.

---

## Problem 2

This problem is based upon the Pythagorean theorem. 

LaTeX Expression:

$a^2 + b^2 = c^2$


In this theorum:

- a is the length of the adjacent side of a right triangle

- b is the length of the opposite side of a right triangle

- c is the length of the hypotenuse of a right triangle 

Write a script that takes the lengths of the adjacent and the opposite sides of a right triangle and echos out the length of the hypotenuse.

---

## Problem 3

Write a script that begins with a four-digit number. Take each place value (i.e. each individual number) and add them together. 

For example, if you take the number `1234`, then you will need to figute out a way to extract each number and add them together. The expected output would be `1 + 2 + 3 + 4 = 10`.

Finish by echoing out the sum. 

---

## Using `include()`

Today's lesson follows the same format as yesterday's lesson; however, this is a bit cumbersome because we need to deal with so much HTML before moving onto the actual PHP and solving our problems.

Fortunately, there's a better way! We can save snippets of code that we want to use over and over again as its own separate file. So, for example, let's say we want to use the `<head>` and the first few lines of the `<body>` over and over again. It might look like this:

```HTML
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PHP Basics: Exercises</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>
    <body class="container text-center">
        <section class="row min-vh-100 align-items-center justify-content-center">
        <div class="col-lg-8">
```

We could save this as a file called `header.html` and import it into our PHP by using one of PHP's language-defined functions.

```PHP
    include('header.html');
```

Of course, in HTML, everything that opens must also close, so we can include a footer as well.

```HTML
            </div>
        </section>
    </body>
    </html>
```

```PHP
    include('footer.html');
```

## Including Other File Types

When including an HTML file, the data inside that file is imported as-is (i.e. the data is immutable). However, if you would like to use variables, such as something to store a unique `<title>` for each page, you can include a `.php` file instead.

Here's an example of what that might look like inside of a `header.php`:

```PHP
     <title>PHP Basics: <?php echo $title; ></title>
```

Because this file now echoes out the value of a variable, we need to initialise or define that variable before our `include` statement. 

```PHP
    $title = "Table of Contents";
    include('includes/header.php');
```
