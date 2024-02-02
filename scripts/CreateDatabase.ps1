Import-Module PSSQLite

#Path to Database
    $Database = "C:\logger.sqlite"



    $Query = "CREATE TABLE LOGS (
        Username TEXT,
        Computername TEXT,
        Type TEXT,
        Time DATETIME)"

    #SQLite will create Database
    Invoke-SqliteQuery -Query $Query -DataSource $Database

# Show Database
    Invoke-SqliteQuery -DataSource $Database -Query "PRAGMA table_info(LOGS)"