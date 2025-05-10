# PHP Basics: Additional Notes

PHP is a language that has been in use for 30 years. It has gone through multiple language versions and has been maintained by numerous people and organisations in that time.

Because of this, there are many ways to write the same thing in PHP. We often refer to this as 'syntactical sugar' as it's nice to have, but not strictly necessary for the language to work. However, there are also things that will do very similar things with some key differences; whether you use single-quotes (' ') or double-quotes (" ") is one of these things. 

These notes go over the different ways of writing echo statements and how they are parsed by our interpreter (i.e. the PHP engine, installed on our server).


## PHP Parsing Behavior in `echo` Statements with `"` vs `'`

In PHP, the choice of double quotes (`"`) or single quotes (`'`) in an `echo` statement affects how the contents are parsed. Here's a breakdown:

---

### 1. **Double Quotes (`"`)**
Double quotes allow for **variable interpolation** and parsing of certain escape sequences.

- **Variable Interpolation**:
  - PHP parses variables inside double-quoted strings and replaces them with their values.
  - Example:
    ```php
    $name = "Alice";
    echo "Hello, $name!"; // Outputs: Hello, Alice!
    ```

- **Complex Variables**:
  - For arrays or more complex variable structures, use curly braces `{}` to clarify boundaries.
  - Example:
    ```php
    $user = ['name' => 'Alice'];
    echo "Hello, {$user['name']}!"; // Outputs: Hello, Alice!
    ```

- **Escape Sequences**:
  - PHP recognizes certain escape sequences within double quotes:
    - `\n`: Newline
    - `\t`: Tab
    - `\"`: Double quote
    - `\\`: Backslash
  - Example:
    ```php
    echo "Line 1\nLine 2"; 
    // Outputs:
    // Line 1
    // Line 2
    ```

---

### 2. **Single Quotes (`'`)**
Single quotes **do not allow variable interpolation** or recognize most escape sequences.

- **Literal Strings**:
  - Everything inside single quotes is treated as a literal string.
  - Example:
    ```php
    $name = "Alice";
    echo 'Hello, $name!'; // Outputs: Hello, $name!
    ```

- **Escape Sequences**:
  - The only recognized escape sequences are:
    - `\'`: Single quote
    - `\\`: Backslash
  - Example:
    ```php
    echo 'It\'s a great day!'; // Outputs: It's a great day!
    ```

---

### 3. **When to Use `"` vs `'`**
- Use **double quotes (`"`)** when:
  - You need variable interpolation.
  - You want to include escape sequences like `\n` or `\t`.
  
- Use **single quotes (`'`)** when:
  - You don’t need variable interpolation or escape sequences.
  - The string contains double quotes (`"`) and you want to avoid escaping them.
  - Example:
    ```php
    echo 'She said, "Hello!"'; // Outputs: She said, "Hello!"
    ```

---

### 4. **Performance Consideration**
- Single quotes are **slightly faster** than double quotes because PHP doesn't attempt to parse for variables or escape sequences.
- The performance difference is negligible unless dealing with a very large number of strings.

---

### 5. **Concatenation**
String concatenation works the same regardless of single or double quotes.
- Example:
  ```php
  $name = "Alice";
  echo 'Hello, ' . $name . '!'; // Outputs: Hello, Alice!
  ```

---

## Summary Table

| Feature                | Double Quotes (`"`)      | Single Quotes (`'`)      |
|------------------------|--------------------------|--------------------------|
| Variable Interpolation | &#9989; Yes              | &#10060; No              |
| Escape Sequences       | &#9989; Most             | &#10060; Limited         |
| Performance            | &#10060; Slightly slower | &#9989; Slightly faster  |