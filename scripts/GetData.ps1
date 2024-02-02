#Test Script to read Data from Database

$Database = "C:\logger.sqlite"
$Table = "LOGS"


Import-Module PSSQLite

Invoke-SqliteQuery -DataSource $Database -Query "SELECT * FROM $table" 