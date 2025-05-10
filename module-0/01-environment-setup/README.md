# PHP Environment Setup

In this lesson, we'll be setting up everything we need in order to develop web applications with PHP/MySQL. 

But before we get there, let's go over all of the tools and terminology we'll be using in the rest of the course.

---

## Contents

1. [The LAMP Stack](#the-lamp-stack--related-tools)

1. [The dmitstudent Server](#dmitstudent-web-server)

2. [.htaccess Security](#htaccess-security)

3. [Securing Your Working Directory](#securing-your-working-directory)

---

## The LAMP Stack & Related Tools

### What is a LAMP Stack?

**LAMP** is an acronym for a popular open-source software stack used to build dynamic websites and web applications. 

| Letter | Stands For            | Description                                                                     |
|--------|-----------------------|---------------------------------------------------------------------------------|
| **L**  | **Linux**             | The operating system that runs the server.                                      |
| **A**  | **Apache**            | The web server software that handles HTTP requests and serves web pages.        |
| **M**  | **MySQL**/**MariaDB** | The database engine used to store and retrieve data.                            |
| **P**  | **PHP**               | The server-side scripting language used to build dynamic, data-driven websites. |

All of these components work together to serve full-stack web applications. 

Now, let's go through the programming languages, software, and tools we'll be using in this course. 


### 🐘 PHP
- A **server-side scripting language** used to create dynamic web pages.
- Embedded in HTML and processed by the server before the page is sent to the browser.
- Connects to databases, processes forms, manages sessions, and more.
- Files end with `.php`.


### 🗄️ SQL (Structured Query Language)
- A **language**, not a software program.
- Used to create, read, update, and delete data in **relational databases**.
- Standardized, but specific database systems (like MySQL or MariaDB) have their own "flavour" or dialect.


### 🐬 MySQL
- An **open-source relational database management system (RDBMS)**.
- Developed by Oracle Corporation.
- Uses SQL to store and retrieve data.
- Once the most popular database in the world (now only second to Oracle Database), especially with PHP-based applications.


### 🦭 MariaDB
- A **drop-in replacement for MySQL** — uses the same SQL syntax and commands.
- Created by the original developers of MySQL after Oracle bought it.
- **Open-source and community-driven**, with some performance and feature improvements over MySQL.
- Many hosting environments (including our own) now use MariaDB instead of MySQL.


For this course, we will technically be using **MariaDB** (as it is open source), not MySQL.

### 🧮 phpMyAdmin
- A **web-based interface** for managing MySQL/MariaDB databases.
- phpMyAdmin lets us:
  - Create tables and databases
  - Run SQL queries
  - Import/export data
  - Browse and edit records
- Great for beginners who aren’t ready to write raw SQL in a terminal.


### Other Libraries, Tools, & Languages

We will be using a variety of other libraries, tools, and languages in this course. Many of them will already be familiar to you, while we will be learning others together. These include:

- Hypertext Markup Language (HTML)
- Cascading Stylesheets (CSS)
- JavaScript (JS)
- Bootstrap Front-End Framework
- Valitron Library
- PHP Mailer Library

---

### How It All Fits Together

Here’s what happens when you visit a PHP webpage that uses a database:

1. You visit `mywebsite.com/search.php` in a browser. 
2. Apache receives your request.
3. PHP is executed on the server.
4. PHP code connects to MariaDB and runs an SQL query.
5. The results are turned into HTML.
6. Apache sends the final HTML page to your browser.

---

### tl;dr: What Thing Does What?

| Tool                    | Role                              | Is This Code?    | Interface Type         |
|-------------------------|-----------------------------------|------------------|------------------------|
| **PHP**                 | Server-side logic (backend)       | ✅ Yes           | Code editor            |
| **SQL**                 | Talks to the database             | ✅ Yes           | phpMyAdmin or script   |
| **MySQL** / **MariaDB** | Stores the data                   | ❌ No            | phpMyAdmin or terminal |
| **phpMyAdmin**          | GUI for managing the database     | ✅ Sometimes     | Web browser            |


---

## dmitstudent Web Server

PHP is a server-side language. This means that any PHP script needs to be run by an engine installed on a server before the user can see the output. Because of this, we'll be using the dmitstudent web server extensively. [^1]

Any student registered in this course should have a new account generated for them on this server.



| Login                               |  Temporary Password                       | Admin URL                                                               |
|-------------------------------------|-------------------------------------------|-------------------------------------------------------------------------|
| your student username (ex. jsmith2) | by default, SpringTerm.your-student-id-no   | [https://studentweb2.sicet.ca:10000/](https://studentweb2.sast.ca:10000)|


Please note that if an instructor in a previous level had you change your password, it will no longer be your student ID number; instead, please use whatever password you generally use in order to login to an FTP client like FileZilla.

If you do not have an account or cannot access it, please contact your instructor.  


## .htaccess Security

Since PHP is a server-side language, there are numerous ways that bad actors (hackers, bots, etc.) might exploit things in order to gain access to our server and/or database. Because we are just learning PHP concepts for the first time and will not always be writing secure applications, we need to protect ourselves from this in some way. 

Our dmitstudent server uses Apache, a type of HTTP server software, on a Linux operating system. This means we can use special configuration files called `.htaccess` and `.htpasswd` to secure the directory we'll be working in. [^2]


### What is `.htaccess` and `.htpasswd`?

In short, `.htaccess` creates a password wall. When a user attempts to look at any file within a directory that has an `.htaccess` file, they will be prompted to enter a username and password in order to continue.

However, in order for this to work, we also need a `.htpasswd` file that contains a list of all the authorised users and an encrypted version of their passwords. 

We can't put it inside of `public_html` because we never want someone to be able to see (or modify!) it. Instead, we'll put it out of reach of our users by placing it in the `data` folder.


## Securing Your Working Directory

1. Connect to the student server through an FTP client (such as FileZilla, Transmit, WinSCP, etc.). 

2. Inside of `public_html`, create a new directory called `dmit2025`. This is where you will be uploading all of your work this semester.

3. Open the provided `.htaccess` file in `01-environment-setup` in your workbook. 

4. On Line 04, make sure that your dmitstudent server username is in the provided path.

    **Note**: This line tells the server where to find the `.htpasswd` file.

5. Upload this file to the `dmit2025` directory on the server.

    **Note**: You may not be able to see this file in your Finder (macOS) or File Explorer (Windows) because this is a special configuration file. Normally, these files are hidden by the operating system. 

    **Revealing hidden files on macOS**: In Finder, press the following key combination: `⌘` + `SHIFT` + `.`

    **Revealing hidden files on Windows 11**: In File Explorer, click on `View > Show > Hidden Items`.

6.  Next, edit the provided `.htpasswd` file. While it already has a username and a pasword hash (i.e. encrypted passwords) for your instructor, you will also need your own username and password hash. You can generate the line you need with the following website: https://hostingcanada.org/htpasswd-generator/

7. Save the file and upload it to your `data` folder, immediately inside of the root of your dmitstudent server space.

8. Test to make sure that everything works! On your browser, go to: http://www.yourusername.dmitstudent.ca/dmit2025/ and make sure that you're greeted with the password prompt.


---

### Footnotes

[^1]: An alternative to using the dmitstudent server is to run a local server stack. A server stack, sometimes called a solution stack, is a combination of an operating system, certain server software, a database, and a back-end scripting language engine, which you can run on your own machine. A popular one is [XAMPP](https://www.apachefriends.org/). However, when submitting your homework for the term, you must have a live version of your website up and available on the dmitstudent server. 

[^2]: You can read all about `.htaccess` files in the [Official Apache Documentation](https://httpd.apache.org/docs/2.4/howto/htaccess.html).
