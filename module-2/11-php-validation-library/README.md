# Validation via Open Source Libraries

While we've gone through a few ways to validate user-submitted form data using built-in PHP methods, there are other ways of approaching validation. 

One way is by using open-source validation libraries. 


## Why use a validation library?

Generally, using a robust library to validate your code is more secure than writing your own validation scripts. The reason for this is because as a lone developer, your code is prone to bugs and oversights; with an open-source library, many developers maintain the code base, which means anyone report an issue and/or suggest a solution.

There are many validation libraries available for PHP, such as Valitron, Respect Validation, Particle\Validator, Symfony Validator, Rakit\Validation, Laravel Validation (Standalone), Aura.Filter, CakePHP Validation, and more.

We will use Valitron for our purposes.


## Valitron

### What is Valitron?

Valitron is a PHP library designed to simplify and streamline form input validation. It uses simple syntax to define validation rules, supports multiple data sources (e.g., `$_POST`, `$_GET`, or custom arrays), and allows you to define custom validation rules. By default, it also includes rules for common validation needs like required fields, email validation, regex matching, and more.

Unlike many PHP libraries, Valitron does not have dependencies, making it lightweight and easier for us to set it up and use it.


---

### Setting Up Valitron

Valitron suggests setting it up by using Composer, a common PHP package manager. However, we can also download and include Valitron manually.

1. **Download Valitron**
   - Go to the [Valitron GitHub Repository](https://github.com/vlucas/valitron).
   - Click on **Code** > **Download ZIP**.
   - Extract the ZIP file into your project directory.

   Alternatively, you can clone the repository if you have Git installed:

   ```bash
   git clone https://github.com/vlucas/valitron.git
   ```

2. **Move the `src` Folder**
   - Inside the extracted files, locate the `src` folder.
   - Copy the `src` folder to a location accessible by your project (e.g., `/home/username/data/Valitron/`).

3. **Include Valitron in Your Project**
   - Use PHP's `require` to include Valitron.
   - Point to the main `Validator.php` file inside the `src` folder.

   ```php
   require '/home/username/data/Valitron/Validator.php';

   use Valitron\Validator;
   ```

---

### Using Valitron

Valitron uses objects, which means we need to use Object Oriented Programming (OOP) techniques when validating our code. For a refresher on OOP and some of the terms we'll be using, please see `oop-notes.md`.

1. **Initialize a Validator**
   - Pass your data (e.g., `$_POST`) to the `Validator` constructor.
     ```php
     $v = new Validator($_POST);
     ```

2. **Define Validation Rules**
   - Use `rule()` to add validation rules for your fields.
     ```php
     $v->rule('required', ['name', 'email', 'comments']);
     $v->rule('email', 'email');
     $v->rule('regex', 'name', '/^[a-zA-Z\s]+$/')->message('Name can only contain letters and spaces.');
     ```

3. **Validate Data**
   - Call `validate()` to check if the input is valid.
     ```php
     if ($v->validate()) {
         echo "Validation passed!";
     } else {
         print_r($v->errors()); // Shows an array of validation errors
     }
     ```

4. **Custom Error Messages**
   - Custom messages can be added with the `message()` method:
     ```php
     $v->rule('required', 'name')->message('Your name is required.');
     ```

---


#### **Practical Example**

Here’s a quick example using Valitron for a simple contact form:

```php
<?php

require 'Valitron/Validator.php';

use Valitron\Validator;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $v = new Validator($_POST);

    // Validation rules
    $v->rule('required', ['name', 'email', 'message']);
    $v->rule('email', 'email');
    $v->rule('lengthMax', 'message', 500)->message('Message cannot exceed 500 characters.');

    // Validate and process
    if ($v->validate()) {
        echo "Form submitted successfully!";
    } else {
        // Display errors
        print_r($v->errors());
    }
}
?>

<form method="POST">
    <input type="text" name="name" placeholder="Your Name">
    <input type="text" name="email" placeholder="Your Email">
    <textarea name="message" placeholder="Your Message"></textarea>
    <button type="submit">Submit</button>
</form>
```
