# Secure Login

Now that we've covered sessions and how password encryption works, we can incorporate it into a website with pages that only logged-in users can see.


## Static Logins

Although this isn't common practice, today we'll be creating a `users` table with an administrative username and password already created for us. Of course, this means we'll need to use a generated password hash and insert it into our table, as there is no registration form. 


## Making Things More Secure

No application is perfectly secure. Even if we follow all of our best practices, there may be bugs or flaws revealed at a later date that cause our application to be vulnerable. However, if we approach security as a multi-layered net rather than one great big wall, we can make our applications more secure.

In the case of logins, we can:

1. Make login sessions expire. After a certain amount of time has elapsed since the last login, we can kick our user out. Banking applications and even Moodle uses this technique.

2. Store session data securely. By default, PHP stores session data on the server-side in a secure manner. Verify that the session files are stored in a secure directory that is not accessible from the web root (i.e. `public_html/`).

3. Use secure connections. Enable HTTPS on your website to encrypt the communication between the server and the client. Make sure the entire login process and authenticated areas of your site are accessed over HTTPS.

4. Validate session data. Ensure that you validate and sanitize any session data before using it in your application to prevent potential security vulnerabilities. Apply appropriate sanitization and validation measures depending on the context in which the session data is used.

5. Store minimal information in sessions. Ensure that you avoid storing sensitive data, such as passwords or personally identifiable information (PII), in sessions. Store only the necessary information required to identify the user's session and retrieve additional information securely from a trusted data source when needed.

6. Protect against session hijacking. Implement additional measures such as IP validation and user-agent validation to detect and prevent session hijacking attacks. Compare the client's IP address and user-agent with the ones stored in the session to check for any discrepancies.

    Note: There are some laws concerning storing user IP information (ex. in the EU and the 'right to be forgotten') and will require a separate page on your website explaining your data governance policies (i.e. what information you collect, why, how it's stored, and how the user can opt-out). 

So, how do we grab that information?

```PHP
    $last_login_device = $_SERVER['HTTP_USER_AGENT'];
    $user_ip = $_SERVER['REMOTE_ADDR'];
```

Keep in mind that these things can be spoofed. A user could be using a VPN, altering their forwarding headers, and so on. 