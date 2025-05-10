# DMIT2025: PHP/MySQL Student Workbook

## Introduction to Your Workbook

This workbook is designed to work with specific extensions for Visual Studio Code. Before beginning, download and install them by following the links below.

<br>

### SFTP

[Link to SFTP on Extension Marketplace](https://marketplace.visualstudio.com/items?itemName=Natizyskunk.sftp "SFTP on Extension Marketplace")

This extension creates an action where, upon saving a project with an `sftp.json` file in the `.vscode/` workspace settings subdirectory, the saved file will be automatically uploaded to a remote server via FTP.

<br>

#### Configuration 

First, make sure that you have a directory called `dmit2025` inside of `public_html` on the `dmitstudent` web server. 

Next, make sure that the `sftp.json` file in `.vscode/` has *your dmitstudent server username* on Line 5, such as:

```JSON
    "username": "jsmith2",
```

You may also choose to hard code your password; this way, you won't be prompted to type your password whenever you connect. To do this, add the following line inside of the curly braces:

```JSON
    "password": "your-password",
```

Please note that if this is the final key-value pair within the curly braces, you should not end the line with a comma.

<br>

### PHP Tools

[Link to PHP Tools on Extension Marketplace](https://marketplace.visualstudio.com/items?itemName=DEVSENSE.phptools-vscode "PHP Tools on Extension Marketplace")

This package will install a variety of tools and extensions to help PHP developers. These extensions will help extend the functionality of IntelliSense and syntactical highlighting in VS Code and flag common errors. 