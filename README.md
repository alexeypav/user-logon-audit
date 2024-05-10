# UserLogonAudit

**For logging user logons and logoffs in a Windows environment.** (Created 2017)

This tool audits and tracks user logon and logoff activities, offering a web-based interface to monitor events. It's an upgrade from the original Batch Script Logger and supports Windows 7 and above.

## Web Based Logon Logging Ver 1.0

- **Audit and Track User Logins**: Monitor user logon and logoff activities.
- **Upgraded Technology**: Enhanced from the original Batch Script Logger.
- **Operating System**: Compatible with Windows 7 and newer versions.

## Requirements

### Server

- **Webserver with PHP**: Version 5.x or 7.x.
- **PHP Configuration**: Uncomment these lines in your `php.ini`:`extension=php_sqlite3.dll`

- **PowerShell**: Ensure PowerShell is installed.
- **PSSQLite PowerShell Module**: Available at [PowerShell Gallery](https://www.powershellgallery.com/packages/PSSQLite).

### Clients

- **PowerShell**: Required for executing scripts.

### Browser

- **Supported Browsers**: Google Chrome or Microsoft Edge.
- **Note**: HTML5 Datepicker does not work in Firefox; use manual entry in the format `yyyy-mm-dd` (e.g., 2015-07-30).

## Installation

1. **Prepare Your Server**: Install IIS and PHP. Follow this [Installation Guide](https://technet.microsoft.com/en-us/library/hh994592(v=ws.11).aspx).
2. **Configure PHP**: Uncomment `extension=php_sqlite3.dll` in `php.ini`.
3. **Deploy the Logger**: Copy the `userlogger` directory to your web directory (e.g., `c:\inetpub\`).
4. **Set Permissions**: Grant Read/Write permissions to the local "Users" group on the `userlogger` folder.
5. **Configure the Website**: Set up the website via IIS.
6. **Deploy Scripts**: Download the logon/logoff scripts from the admin page.
7. **Configure Script URL**: Set the website URL in the scripts (e.g., `http://Servername/userlogger`).
8. **Set Up GPO**: Create a new user Group Policy Object (GPO), set the script as a logon script with the parameter `-type Logon`, and as a logoff script with `-type Logoff`.
9. **Test the Setup**: Verify that the logger is capturing logon and logoff events.

## Troubleshooting

- **Permissions**: Ensure the `userlogger` folder has appropriate permissions.
- **SQLite3**: Confirm that the SQLite3 extension is enabled in PHP.
- **PHP Errors**: Enable error reporting in `php.ini` for debugging.
- **Database Issues**: Consider starting with a new database if issues persist. Download from the admin page.
- **Export Data**: You can export the database to CSV via the admin page.

## Known Issues

- **Browser Compatibility**: The HTML5 Date picker is not compatible with Firefox.
