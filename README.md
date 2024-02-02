# UserLogonAudit

**For logging user logons/logoffs in a Windows environment**

---

## Web Based Logon Logging Ver 1.0

- Audit and track user logins
- Upgrade from and inspired by the original Batch Script Logger
- OS: Windows 7+

---

## Requirements

### Server:

- Webserver with PHP 5.x and 7.x should work
- Must add/uncomment these lines in your PHP.ini file (modules should come with PHP install): extension=php_sqlite3.dll


### Clients:

- Powershell

### Browser:

- Chrome or Edge ideally

- HTML5 Datepicker doesn't work in Firefox but you can manually enter the date in the format: yyyy-mm-dd (e.g., 2015-07-30)

---

## How to Install

1. Make sure you have a web server and PHP installed. For Windows, use IIS. Any version of PHP 5.x or 7.x should work. Here's how to install IIS and PHP: [Installation Guide](https://technet.microsoft.com/en-us/library/hh994592(v=ws.11).aspx)

2. Uncomment in your php.ini: extension=php_sqlite3.dll


3. Copy the `userlogger` to your web directory (e.g., `c:\inetpub\`).

4. Give the local computer "Users" Group Read/Write permissions on the folder, otherwise, it won't be able to write to the database.

5. Set up the website.

6. Download the logon/logoff script from the admin page.

7. Set the website URL in the script (e.g., `http://Servername/userlogger`).

8. Create a new user GPO, set the script as a logon script, add the parameter: `-type Logon`, then also set the script as a logoff script, add the parameter: `-type Logoff`.

9. The Logger should now work! :)

---

## Troubleshooting

- Check Permissions on the folder. Users need Read/Write access; otherwise, you can move the database to another folder on the server, but you'll have to change all the paths in the files.

- Check SQLITE3 extension is enabled in PHP.

- Enable Errors in your PHP.ini file for testing.

- Start with a new database, download from the admin page.

- You can export the database to CSV on the admin page.

---

## Issues

- HTML5 Date picker doesn't work in Firefox.

