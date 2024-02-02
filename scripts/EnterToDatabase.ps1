#Test script to enter data directly


#Path to database
$Database = "C:\logger.sqlite"


Import-Module PSSQLite

$query = "INSERT INTO LOGS (Username, Computername, Type, Time)
                          VALUES (@Username, @Computername, 'Logon', @Time)"




    Invoke-SqliteQuery -DataSource $Database -Query $query -SqlParameters @{
        Username = $env:USERNAME
        Computername = $env:COMPUTERNAME
        Time = (Get-Date -Format u)
    }