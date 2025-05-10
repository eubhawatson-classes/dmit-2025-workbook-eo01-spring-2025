# Working With Email in PHP

Many years ago, generating an email in PHP was an incredibly simple task. In fact, PHP has a language-defined function just for this very purpose.

```PHP
    mail();
```

However, any email created via the `mail()` function is now blocked by most modern mail clients. The reason is that because it is so incredibly easy for developers to use, it is also so incredibly easy to create prolific amounts of spam.

Instead, most PHP frameworks have there own workarounds for sending mail and making sure it arrives in its intended recipient's inbox. There are also many libraries, such as PHPMailer, that can help solve this problem. 


## PHPMailer

[Link to PHPMailer GitHub Repository](https://github.com/PHPMailer/PHPMailer)

PHPMailer is a library the helps PHP developers use certain features when creating emails, such as encryption, authentication, HTML messages, and attachments. While you can install it with a package manager like Composer, you can also simply download the repository and make sure that certain files are available on your server space.

Note: This library is updated and functional as of late 2023; however, in future years, another library or method might be necessary as this one becomes obsolete. Such is the way of the web.


## Setting up

For our demonstration, we'll be using a simplified form that asks for the user's name, email address, and a message. Keep in mind that any text input is potentially dangerous and should be sanitised and validated accordingly. 

1. After downloading the library from GitHub, unzip it and upload it to the public_html directory on your student server space. This will make the library accessible to all of your future projects. 

2. Next, we'll bring in some of the scripts from the src/ directory using `require`. This is just like `include`, except the page will stop processing / loading if the file cannot be found (whereas `include` will throw a warning and try its best to carry on).

```PHP
    require "/home/vwatson/public_html/PHPMailer-master/src/Exception.php";
    require "/home/vwatson/public_html/PHPMailer-master/src/PHPMailer.php";
    require "/home/vwatson/public_html/PHPMailer-master/src/SMTP.php";
```

Note: If you are usign XAMPP or a local host, your path will be different. 

3. We also want to include some `use` statements. This gives us access to the namespace inside of the files that we're using (i.e. all of the variables and functions that we otherwise wouldn't have access to in our own codebase.)

```PHP
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
```

4. The rest of our code comes right of the documentation (under 'A Simple Example' in the README.md file). We will be taking this and tweaking it to our liking in our own demonstration.

```PHP
<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'user@example.com';                     //SMTP username
    $mail->Password   = 'secret';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
    $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
```

5. In order to prevent spam, we need to set up authentication for this application. In our demo, I will be using Google's mail services (GMail); however, you will be able to follow similar steps with other mail providers. 

If you are using GMail to send your messages, you will need to create a unique Application Password. This will allow your message to bypass your spam filter and make it through. 

To generate a new Application Password, sign into your Google Account and go to: https://myaccount.google.com/apppasswords

Note: You will not be able to use this if you do not have two-step verification turned on.

When generating the password, make sure to give it an identifiable custom name, such as 'Web Form Demo'. When you are finished testing the application (or take an application online, or change how it handles mail), make sure that you remove the access code that was generated for it. 