# Comparison Operators, Logical Operators, Control Structures, & Loops

## Comparison Operators

Determining whether something is TRUE or FALSE is the root of all decision making in programming languages. Comparison operators, also known as boolean operators, allow us to compare variables or other values and evaluate them.

<br>

### Equality

We can evaluate equality with `==`. This will check to see whether the values on either side of the operator are equivalents. 

```PHP
    42 == 42; // This would evaluate as TRUE.
    2 + 2 == 5; // This would evaluate as FALSE.
    '1' == 1; // This would evaluate as TRUE.
```

In our last example, we compared a character to an integer; because PHP is a weak-typed language, they would be considered equal and the statement would evaluate as true.

So, what if we want to avoid that? We can use an identical comparison operator, or `===`, which will also check for data types.

```PHP
    1 === 1; // This would evaluate as TRUE.
    '1' === 1; // This would evaluate as FALSE.
```

<br>

### Greater Than & Less Than

When dealing with numbers, we can also compare their sizes.

| Operator | Meaning                  |
|:--------:|--------------------------|
|     >    | greater than             |
|     <    | less than                |
|    >=    | greater than or equal to |
|    <=    | less than or equal to    |

Let's look at a few examples.

```PHP
    2 > 2; // This would evaluate as FALSE.
    2 >= 2; // This would evaluate as TRUE.
```

<br>

### NOT or Negation

We can also check to see if two values are not equal with the negation or not operator. 

| Operator | Meaning                          |
|:--------:|----------------------------------|
|    !=    | not equal                        |
|    !==   | not identical                    |
|    <>    | alternative syntax for not equal |

Let's look at an example.

```PHP
    7 != 7; // This would evaluate as FALSE.
```

We can also negate statements within parentheses. 

```PHP
    !(7 == 7); // This is looking to see if what's inside of the () is NOT TRUE, or FALSE.
```

<br>

## Logical Operators

Logical operators combine comparison statements and try to evaluate their overall truthfulness. 

No matter how many comparison statements are included, this will still result in only one final boolean evaluation (TRUE or FALSE).

| Operator | Meaning                                                    |
|:--------:|------------------------------------------------------------|
|    &&    | AND (all parts of the statements must be TRUE)             |
|   \|\|   | OR (at least one of the statements must be TRUE)           |
|    XOR   | EXCLUSIVE OR (one or the other must be TRUE, but not both) |

Note that you can use `AND` and `OR` as logical operators in PHP; however, their precedence is _lower than_ `=`, meaning assignment statements will be evaluated first, so this can lead to some unintended results. 

<br>

## Control Structures

Control structures are the backbone of decision-making in programs. They will execute certain parts of the code only if certain conditions are met.

An IF statement is one of the most common control structures. It will check to see if a certain condition is TRUE; if it is, it will execute a block of code. 

```PHP
    if ($name == "Honey") {
        echo "Honey, I'm home!";
    }
```

In this case, nothing will happen if the condition evaluates as FALSE. Here, we can add an ELSE statement. If the first condition is not met, the second block of code will be executed. 

```PHP
    if ($name == "Honey") {
        echo "Honey, I'm home!";
    } else {
        echo "Who are you, and what are you doing in my house?";
    }
```

If we want to add a little more complexity, we could add an nested IF statement. This will only execute if both conditions are met (i.e. evaluated as TRUE).

```PHP
    if ($name == "Honey") {
        echo "Honey, I'm home!";
        // This is one level in. We know the $name is "Honey".
        // Notice the negation just outside of the parenthesis.
        if !($face == "Dirty") {
            echo "Who's a good girl?";
        } else {
            echo "Have you been digging again?";
        }
    // We're back to the outermost level. The $name is NOT "Honey".
    } else {
        echo "Who are you, and what are you doing in my house?";
    }
```

<br>

### Yoda Conditions

Although they're a little harder to read, some developers like to write something called 'Yoda Conditions'. This means that when writing a condition, the value goes on the left-hand side and the variable goes on the right-hand side. 

```PHP
    if ("Honey" == $name) {
        echo "Honey, I'm home!";
    }
```

This is flipped around from when we assign values to a variable -- much like speaking backwards. This is to help prevent you from accidentally assigning a value rather than evaluating it. 

<br>

### Switch Statements

Another way of structuring our decisions is through switch statements. Switch statements allow you to do multiple things based upon the value of a single variable, not just one or the other thing (like if and else).

```PHP
    $total = 42;

    switch ($total) {
        case 1:
            echo 'The total is 1.';
            break;
        case 2:
            echo 'The total is 2.';
            break;
        default:
            echo 'The total is less than 1 or greater than 2.';
    }
```

Every time we use the keyword `case`, we're really evaluating a single statement and seeing if it's true. If it is true, we'll carry on the instructions immediately underneath; if it's not true, we'll look at the next `case`. If none of these cases are true, the `default` case will be executed. 

Unlike `if` statements, a `switch` statement will not terminate upon finding a true statement. Because of this, we need `break` statements in order to exit out of the switch statement for us. 

    Note: You do not need a `break` for the `default` case, as it's the last statement before exiting out of the switch entirely.

`switch` statements also have fall-through cases (where multiple cases can be evaluated at once by not including a `break`) and an alternative syntax that doesn't require curly braces.

```PHP
    $total = 8;

    switch ($total) {
        case 1:
        case 2:
        case 3:
            echo 'The total is less than 4.';
        default:
            echo 'The total is equal to or greater than 4.';
    }
```

<br>

## Loops

Loops allow you to do the same thing over and over again. They will repeatedly execute a block of code some condition becomes FALSE. 

There are a few different types of loops, but while come condition is TRUE, they will continue to execute a block of code. All loops must have a condition that moves towards being false, or else you will get caught in an *infinite loop*. An infinite loop will crash your application because it will never allow the program to exit and move on.

<br>

### Do / While Loops

A general purposes loop, this structure will *do* a certain thing *while* a condition is still TRUE.

```PHP
    $i = 0;

    do {
        echo "<p>The current loop number is $i.</p>";
        $i++;
    } while ($i < 10);
```

What is `i`? It's an integer that counts the number of times a loop has been executed. Put simply, it's the 'iteration' that the loop is currently on. There must be a change to this counter (in this case, we increment it by one every time the loop is executed), or else it will never move towards FALSE and the program will never exit out of the loop.

<br>

### For Loops

`for` loops are specifically made for enumeration. They're especially helpful if you know exactly how many times you want the loop to be executed. Here's the above loop, rewritten as a `for` loop.

```PHP
    for ($i = 0; $i < 10; $i++){
        echo "<p>The current loop number is $i.</p>";
    }
```

This has all of the same components compressed into a single line. 

`$i = 0` is the starting assignment, or the number we want to start our counter at.

`$i < 10` is the test or condition. If this is evaluated as FALSE, the program exits the loop; if it evaluates as TRUE, the loop continues.

`$i++` is the change (incrementer, if we want the counter to increase, or decrementer, if we want the counter to decrease). Without this change, we would be caught in an infinite loop. 

<br>

### For Each Loops

These loops are made specifically for working with arrays. They will go through each item in an indexed array or each key and value in each associative array and do something with the entry. 

With these loops, we don't have to worry about a change, because they simply stop when the program reaches the end of the array. 