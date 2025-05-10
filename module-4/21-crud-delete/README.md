# CRUD Applications: Delete

So far, we've covered how to read information in a table and display it to the user, as well as how to add new information. In this lesson, we'll cover how to delete records from a table through a web interface. 

## Delete Basics

Deletions are inherently risky, especially if your database and its information isn't regularly backed up and maintained. Because of this, it's important that we prompt the user to confirm that they want to delete a specific record. 

There are many ways of doing this, including: 

    - Using a JavaScript Alert window to confirm or cancel the deletion
    - Using a modal window to confirm with the user
    - Changing the language in a button that the user clicks (ex. 'Delete' might become 'Really delete?'), making them click it twice. 
    - Redirecting the user to a confirmation page. 

Because we want to use as little JS as possible and we're already comfortable with redirects, we will go over how to implement a delete functionality with a confirmation page together. 

---

## Callback Functions

In order to send our user from the delete page to the confirmation page (where we'll be checking to make sure they really wanted to delete that record), we'll need our table to generate an Actions column with some links. We will want this for our edit page as well, meaning the links will have to vary based upon the page.

We'll do this with a callback function. 


### What's a Callback Function?

A 'callback function' is a function that you pass as an argument to another function (known as a parent or caller function), so it can be called executed later, _inside_ of the parent function.

Here's a quick example:

```PHP
function say_hello($name) {
    return "Hello, $name!";
}

// Here, the parent function is greet(), while the callback function is something the user determines when they make their initial call.
function greet($callback, $name) {
    // Calls the function (callback) that was passed
    return $callback($name);
}

// We're echoing out the results of the parent function, greet(), while the callback function is say_hello().
echo greet('say_hello', 'Alice'); // Output: Hello, Alice!
```

## Getting Started  

Before beginning today's lesson, follow these steps:  

1. **Copy and Paste Previous Files**  
   - Locate the `private` and `public` directories from the previous lesson.  
   - Copy and paste them into your working directory for this lesson.  

2. **Upload Files to the Server**  
   - Use an FTP client (e.g., FileZilla) to upload the copied files to the server.  
   - Verify that all files are successfully transferred before proceeding.  

### Files to Modify Today  

Today, we'll be making changes to the following files:  

- **`private/functions.php`** – Modify the `generate_table()` function.  
- **`private/prepared.php`** – Add a `DELETE` function.  
- **New File:** `public/delete.php`
- **New File:** `public/delete-confirmation.php`