# SQL & MySQL Introduction

Databases will allow us to read and write data, store more data, and keep it organised (so that we can access it faster). In this lesson, we'll be setting up our database and go over some basic instructions we can give it so that we can read, add, update, and delete data. 

**Note**: If you are unclear about any of the software or tools we'll be using today and what their role is in our web applications, refer back to the `README.md` for [Lesson 1: PHP Environment Setup](../../module-0/01-environment-setup/README.md).


## Terminology 

---

**Database**: A database is a set of tables. Generally, there is one database per application. A web application usually has permission to access all of the tables in a database. 

**Tables**: Tables are a set of columns and rows. Each table should represent a single concept (i.e. a noun or category). This can include products, customers, and orders. In a relational database, there is a relationship between tables. 

> Example: The customers in our customers table have a relationship to their previous orders. These orders are related to the products table. 

**Column**: A column is a set of data of a single simple data type. This not only keeps the data organised, but it also helps the database allocate an appropriate amount of storage space and allows us to locate the data faster.

> Example: A first_name column would be the CHAR data type. An age column would be the INT data type.

**Row**: Also known as a record, a row is the set of data in each column. 

> Example: If the columns are first_name and age, then the record might be "Jane", "32".

**Field**: The intersection of a row and a column (i.e. a single cell).

**Primary Key**: A primary key is a special type of table column. It provides a unique record identifier. 

> Example: There are thousands of students at NAIT. Many of them have the same first and last names. Therefore, each student is given a student identification number. 

**Foreign Key**: A foreign key is a table column whose values reference another table. This is the foundation of relational databases. 

> Example: If you wanted to look at your grades, your name and student identification number would be on your transcript. These values are stored elsewhere. 

**Index**: A data structure on a table to help improve lookup speed. 

> Example: This is like an index at the back of a textbook, where you can look up a keyword and it will tell you which pages has the topic that you want instead of starting at the beginning of the book and searching page by page.

**CRUD**: An acronym for 'Create, Read, Update, and Delete'. These are the four primary operations that we perform on databases. 


## What is MySQL?

It's an open source, free database solution. Because it's relatively easy to use and so commonly used with PHP, there's extensive support for it. Major online platforms (Wikipedia, Google, Facebook) use MySQL.

> Note: Because it's now maintained by Oracle, there are different editions. Current, the Community Edition is still entirely free. 

> Note 2: MongoDB is another solution, which is dynamic (i.e. it creates things as you need them) and easy to use, but it does not work for large-scale or enterprise applications in the same way that MySQL does. It's part of the MEAN stack (a JavaScript-based framework for developing web applications). MEAN is named after MongoDB, Express, Angular, and Node.

We're going to be using MySQL through phpMyAdmin. This is a web-based interface that will allow us to directly interact with our database and issue SQL commands. 

We will also be learning how to write PHP applications that allow us to access our MySQL databases and issue similar commands. For example, if a user wishes to register, we might allow them to do so through a web form that creates a username, password, and so forth for them to use. 


## How do we use phpMyAdmin?

First, it needs to be installed on a server somewhere. If you successfully installed PHPMyAdmin at the beginning of the term, you've already completed this step.

Next, go to the following URL: [phpMyAdmin](dmitstudent.ca/phpmyadmin)

You will be prompted for your username and the password that you use to access FileZilla. After that, you'll be greeted with our DBMS (Database Management System). On the left-hand side will be a list of all of your databases, with different operations along the top right.

However, you won't be able to do much without first creating a database. To do that, head to [Virtualmin](https://studentweb2.sicet.ca:10000/).

Select the third option down ('Edit Databases'). Next, choose 'Create a new database'. Name this database after the course code and your section number, such as: dmit2025_e01

Now that you've got your first database, head back to PHPMyAdmin to get started with our SQL review.