<?php
header('Content-type: text/json');
header('Content-type: application/json');

$username = "root";
$password = "";
$hostname = "localhost"; 
$dbname = "team_reindeer";


try {
    $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    /*** echo a message saying we have connected ***/
   // echo 'Connected to database';
    
    $statement = $dbh->prepare("SELECT count(*) as snowmen FROM votes WHERE vote = 'snowman' GROUP BY vote");
     if( $statement->execute() ) {
     	$result = $statement->fetch();
        $snowmen = $result["snowmen"];
      } else {
     	 // Query failed
     	 $snowmen = 0;
	}
    $statement = $dbh->prepare("SELECT count(*) as reindeer FROM votes WHERE vote = 'reindeer' GROUP BY vote");
     if( $statement->execute() ) {
     	$result = $statement->fetch();     	
        $reindeer = $result["reindeer"];
      } else {
      // Query failed
      $reindeer = 0;
	}
	
 	$new_arr = array($reindeer, $snowmen);
 	echo json_encode($new_arr);  
 
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
