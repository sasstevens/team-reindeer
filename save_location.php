<?php

$username = "root";
$password = "";
$hostname = "localhost"; 
$dbname = "team_reindeer";


try {
    $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    /*** echo a message saying we have connected ***/
   // echo 'Connected to database';
    
	$monster = $_GET['monster_id']; 
	$lat = $_GET['lat'];
	$lon = $_GET['lon'];

	// check if this monster already exists	
	$sql = "UPDATE monsters 
	        SET lat=?, lon=?
			WHERE monster_id=?";
	$q = $dbh->prepare($sql);
	$result = $q->execute(array($lat,$lon,$monster));
    echo $result;

    /*** close the database connection ***/
    $dbh = null;
    
    
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
    
function get_client_ip() {
     $ipaddress = '';
     if (getenv('HTTP_CLIENT_IP'))
         $ipaddress = getenv('HTTP_CLIENT_IP');
     else if(getenv('HTTP_X_FORWARDED_FOR'))
         $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
     else if(getenv('HTTP_X_FORWARDED'))
         $ipaddress = getenv('HTTP_X_FORWARDED');
     else if(getenv('HTTP_FORWARDED_FOR'))
         $ipaddress = getenv('HTTP_FORWARDED_FOR');
     else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
     else if(getenv('REMOTE_ADDR'))
         $ipaddress = getenv('REMOTE_ADDR');
     else
         $ipaddress = 'UNKNOWN';

     return $ipaddress; 
}
    
?>
