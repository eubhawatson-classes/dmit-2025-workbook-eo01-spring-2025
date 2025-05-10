# PHP Basics

PHP is a programming language that allows you to add back-end functionality to your web applications and to create dynamic websites. It will often work alongside other languages that you have already learned, such as HTML, CSS,  JavaScript, and SQL. 

PHP is a **server-side language**, which means that a server (or a remote computer) runs the PHP script and spits out the results to the user's browser. Because this processing is all done on the 'back-end' (unlike HTML, CSS, and JavaScript), the user cannot see the code and its underlying logic.

This means that we can write more secure code. Because everything is not exposed in the browser, we can start handling things like passwords and sensitive data. It also means that we can start making certain HTML components, like forms, have some sort of functionality. We can finally take user input, process it, and *do something* with it.

## Getting Started

So, what do we need in order to make PHP work? 

1. We need a PHP-enabled server. This means that a PHP engine must be installed on it. 

2. In order for PHP to be processed, it must be written in a file with the `.php` file extension; it will not work inside of a `.html` file.

3. All PHP must go between `<?php ?>` tags; otherwise, it will be treated as HTML.

---

## Variables

Variables are a way of storing something (a value) so that we can reference or do something with it later. In PHP, we can store names, numbers, and all sorts of important data. 

In PHP, all variables must start with a `$`, followed by a letter or an underscore, then an alphanumeric character string.

```PHP
    $name = 'Jack Pott';
    $age = 42;
```

In this example, PHP knows that `$name` is actually `Jack Pott` because it has been **assigned** that value with the equals sign.

We can change or manipulate these values later on in the program, hence the name *variables*; however, PHP also has something called **constants**, which is a variable whose value is immutable or cannot be changed at runtime. 

```PHP
    define('AGE', 42);
```

Note that constants are case-sensitive and must be all uppercase. 

### Reserved Words

When initialising a variable or defining a constant, keep in mind that there's a set of predefined values that developers cannot use. These are known as the language's reserved words or predefined variables. 

[See Reserved Words in PHP](https://www.php.net/manual/en/reserved.constants.php)

---

## Data Types in PHP

Computers are very specific about how different types of data are treated. In some programming languages, when you delare or initialise a variable, you need to explicitly state what type of data you want, how many characters it should be, or sometimes even how much memory should be reserved for it. 

| Data Type  | Definition                                                                                         |
|------------|----------------------------------------------------------------------------------------------------|
| Characters | Single letters, numbers, or symbols (i.e. glyphs).                                                 |
| Strings    | A collection of characters.                                                                        |
| Integers   | Whole number values. Can use math with them.                                                       |
| Floats     | Decimal number values.                                                                             |
| Booleans   | A value that can only be TRUE or FALSE.                                                            |
| Array      | A collection of data that can either be numbered (indexed) or act as key-value pairs (associated). |

Fortunately, PHP handles most of this for us. It will figure out what a variable is and how we want to use it for us. Therefore, we call PHP a **weak type language**. 

---

## Basic Arithmetic 

| Type of Operation | Symbol (Operator) |
|-------------------|-------------------|
| Addition          | +                 |
| Subtraction       | -                 |
| Multiplication    | *                 |
| Division          | /                 |
| Modulus           | %                 |
| Exponentiation    | **                |

### Order of Operations

When evaluating any arithmetic statement, PHP will follow the **order of operations**. 

Depending upon where you learned basic math, you may be familiar with either the acronym 'BEDMAS' or 'PEMDAS'. These acronyms are a way of remembering the steps we have to take in order to solve complex arithmetic equations. 

1. Parenthesis, brackets, and braces.

2. Exponents. 

3. Multiplication and division, including fractions. 

4. Addition and subtraction. 

```PHP
    echo 5 * 6 + 3 - 1; // The output will be 32.
    echo 5 * (6 + 3) - 1; // The output will be 44.
    echo (5 * 6) + 3 - 1; // The output will be 32.
    echo 5 ** 2 * 6 + 3 - 1; // The output will be 152.
    echo 5 ** 2 * (6 + 3) - 1; // The output will be 224.
```

--- 

## Today's Activities

- `phpinfo()`
- `echo` statements and outputting text to the browser
- formatting output
- writing PHP and HTML together
- variables
- data types in PHP
- basic arithmetic