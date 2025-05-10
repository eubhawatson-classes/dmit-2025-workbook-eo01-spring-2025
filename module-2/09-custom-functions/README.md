# Functions

Functions are reusable snippets of code that can be called (used) multiple times. If we find that we have to do the same thing at different points throughout our program, then it makes sense to define it once rather than rewriting it over and over again. 

Functions can:

1. return a variable or a value (which can be assigned to a variable)

2. print something out

But wait – does that mean a function can only do one thing or return one value? 

Well, yes; however, we can sneakily return multiple values by stuffing them into an array. 

## Function Syntax

In PHP, would functions are defined with the keyword *function*, a name, what parameters it accepts, and then something that happens inside.

```PHP
		function hello_world() {
			return 'Hello, world!';
		}

		echo '<p>' . hello_world() . '</p>';
```


## Passing Arguments

When we define our functions, we can make them more dynamic by defining its parameters. This means that we can pass arguments (or values) into the function, which it will then be able to use.

```PHP
		function is_bigger($a, $b) {
			return $a >= $b;
		}

		$bigger = is_bigger(10, 5);
		
		if ($bigger) {
			echo "This number is bigger than or equal to the second number.";
		} else {
			echo "This number is not bigger than the second number.";
		}
```


## Union Typing

We can explicitly define which data types we will accept in a function. With the pipe character (|), we can list as many types as we'd like.

Union typing allows you to make your functions more explicit when defining variables, allows you to enforce typing, and catches typing errors earlier in the coding process.

Note: The boolean values 'true' and 'false' are pseudo-types. If you pass one of these into a function that accepts a number, it will convert them into the appropriate type (i.e. 1 or 0).

```PHP
		function double(int|float|null $a) {
			return $a * 2*;
		}

		echo double(true);
```


## Default Values (Optional or Named Arguments)

We can assign fallback or default values to our parameters. This means that when we're passing arguments into our functions, we do not have to explicitly define every one of them.

In the example below, `$b` has a default value of `2`. If we only pass in one value, it will go to `$a`.

```PHP
		function times($a, $b = 2) {
			return $a * $b;
		}

		echo times(2);
```


## Anonymous Functions (AKA Closures, Callback Functions)

Another way to write functions is anonymously. This means that they don't get a name and are often created at runtime to perform a specific task. This is _slightly_ more efficient than defining a function (if you are only going to use it once).
