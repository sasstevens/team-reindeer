<?php
$username = "db80128_live";
$password = "wearetilt123";
$hostname = "internal-db.s80128.gridserver.com"; 
$dbname = "db80128_hackathon_voting";


try {
    $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    /*** echo a message saying we have connected ***/
   // echo 'Connected to database';
    
	$team = $_GET['team'];
    
    if ($team == '1') {
    	$team = "snowman";
    } else {
    	$team = "reindeer";
    }
    
    $ip = get_client_ip();
    
     /*** INSERT data ***/
    $count = $dbh->exec("INSERT INTO votes (ip, vote) VALUES ('$ip', '$team')");

    /*** echo the number of affected rows ***/
    if ($count == 1) {
    	echo 'true';
    } else {
	    echo 'false';
	 }

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
