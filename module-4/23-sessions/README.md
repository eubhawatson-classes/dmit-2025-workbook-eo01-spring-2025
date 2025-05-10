# Remembering States

By default, PHP doesn't maintain states. If you move from one page to another (unless you do something to explicitly remember what the user did elsewhere on the website), PHP will not remember it for you.

## A Note on Cookies

Cookies are a great way to remember the state of a user's browser (such as whether or not they're logged in). A cookie is a small piece of data sent from a website and stored on the user's computer by the user's web browser while the user is browsing. It will persist as long as a browser stays open. 

Because this is a file on the user's device, it can be deleted or tampered with. This might be alright if you're storing simple data, but what if you're storing shopping cart data, or something else that shouldn't be modified by the user?

Additionally, there are a lot of laws about cookies (particularly in California and the EU). These include informing the user that your website uses cookies, giving them the option to opt in or out of them, and their right to be forgotten. Because of their current legal complexity, we'll focus on sessions.

## Sessions

Like cookies, sessions persist as long as the browser is open (or an expiry date is set); however, it is stored on the server, which users cannot access. Sessions can also be set at any time (unlike cookies, which need to be set before there's any output on the screen).

To begin a new session, we use the following function:

```PHP
    session_start();
```

After, we can assign different values to the superglobal variable `$_SESSION`.

```PHP
    $_SESSION["user"] = "admin";
    $_SESSION["login-time"] = date("H:i:s");
```

If we need to end a session, we can use the session destroy directive:

```PHP
    session_unset(); // removes session variables
    session_destroy(); // destroys the session
```

