#Script to send user logger data to database, V1.0
#AlexeyP 2017

#When setting up logon/logoff script use script parameter: -type "Logon" for logon script and -type "Logoff" for logoff script, otherwise "Unknown will be displayed"
param([string]$type="Unknown")
#################################################################################################################################

#Server URL, put your URL here:
$server = "http://localhost/userlogger"


#################################################################################################################################
#Get user and computer data
$time = Get-Date -Format u
$user = $env:USERNAME
$computer = $env:COMPUTERNAME

#Compile data and convert to Json
$data = @{
    Computername = "$computer"
    Username = "$user"
    Time = "$time"
    Type = "$type"
}


#API Uri
$uri = $server+"/logentry.php"

#Determine PS version as bellow 3 needs .net object for rest api and Json
if($PSVersionTable.PSVersion.Major -gt 2){

    $psv = 1
    
    $body = ConvertTo-Json -InputObject $data
    
    }

else{
    
    $psv = 2
    
    function ConvertTo-Json20([object] $item){
        add-type -assembly system.web.extensions
        $ps_js=new-object system.web.script.serialization.javascriptSerializer
        return $ps_js.Serialize($item)
        }

    $body = ConvertTo-Json20 $data


}



#Function to log entry
function Log-Entry {

    param(
    [string]$psv,
    [string]$body,
    [string]$uri



    )

    #Check PS Version and send depending
    switch ($psv){

        1{  Invoke-RestMethod -Method Post -Body $body -Uri $uri }

        2{
            #For PS Version 1,2

            $request = [System.Net.WebRequest]::Create($uri)

            $request.Method = "POST"

            try
            {
                $requestStream = $request.GetRequestStream()
                $streamWriter = New-Object System.IO.StreamWriter($requestStream)
                $streamWriter.Write($body)
            }

            finally

            {
                if ($null -ne $streamWriter) { $streamWriter.Dispose() }
                if ($null -ne $requestStream) { $requestStream.Dispose() }
            }

            $res = $request.GetResponse()
    
        }

        #testing
        default{"Unable to get powershell version"
        
        }

    }

}


#Connect to API and log an entry, retry if database locked
$count = 0

"Sending Data ----------"

do{
    
    $result = Log-Entry $psv $body $uri

    $count += 1

    $result

    }
#Retry up to 5 times if database locked by another log being submitted
while($count -lt 5 -and $result -like "*locked*")

"Sent ------------------"

    