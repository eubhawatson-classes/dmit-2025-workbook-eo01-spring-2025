# SFTP Extension Troubleshooting Tips

1. Make sure that your workbook is not inside of another folder. 

With Windows in particular (but sometimes also in macOS or Linux distros), when you unzip the workbook, the filepath will look something like this:

```Shell
	C:/Users/YourUsername/Downloads/dmit-2025-workbook-student-copy/dmit-2025-workbook-student-copy/.vscode/sftp.json
```

Make sure that the `.vscode` folder is _immediately inside of the root project folder_, like so:

```Shell
	dmit-2025-workbook-student-copy/.vscode/sftp.json
```

2. Make sure that you 'trust' the workbook when you bring it into a new window in VS Code for the first time. 

3. Because our server uses secure socks, make sure that your `sftp.json` file looks something like this:

```JSON
{
    "name": "Student Server",
    "host": "dmitstudent.ca",
    "protocol": "ftp",
    // This username and password is the same one you use for FileZilla (as it is trying to push up your PHP files via SFTP).
    "username": "vwatson",
    // You may or you may not include your password in your workbook. If you choose not to, you will be prompted to enter it upon saving.
    "password": "supersecretpassphrase",
    "remotePath": "/public_html/dmit2025/workbook-key/",    
    "uploadOnSave": true,
    "secure": true,
    "secureOptions": {
        "rejectUnauthorized": false
    }
}
```

Remember that your credentials should be the same ones you use for Filezilla.

4. Make sure you've either restarted your extensions or restarted VS Code.

5. Make sure you are manually saving your PHP files, as auto-save may not trigger it properly.

6. As there are multiple versions of the SFTP extension on the VS Code Marketplace, you can try disabling the one you chose, installing another one, restarting VS Code, and trying again. 

7. Try checking the status of your transfer. In the lower left-hand corner of VS Code, there should be an 'SFTP' badge. Upon saving, it should say 'connecting ...' followed by a 'done filename.php' message. If there is an error, try clicking on the badge to bring up the log.

8. If none of these work for you, do not fret: you can always use an FTP Client (ex. FileZilla) to upload your PHP files to the server. 