<?php

$username = "root";
$password = "";
$hostname = "localhost"; 
$dbname = "team_reindeer";


try {
    $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    /*** echo a message saying we have connected ***/
   // echo 'Connected to database';
    
	$monster_image = $_POST['monster_image']; 
	$lat = $_POST['lat'];
	$lon = $_POST['lon'];
    
     /*** INSERT data ***/
    $count = $dbh->exec("INSERT INTO monsters (lat, lon) VALUES ('$lat', '$lon')");

/* 	echo ; */
	
	saveImage($monster_image, $dbh->lastInsertId());
	return $dbh->lastInsertId();
    /*** echo the number of affected rows ***/
/*
    if ($count == 1) {
    	echo 'true';
    } else {
	    echo 'false';
	}
*/

    /*** close the database connection ***/
    $dbh = null;
    
    
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
   

function saveImage($base64img, $filename){

    define('UPLOAD_DIR', 'uploads/');
    $base64img = str_replace('data:image/png;base64,', '', $base64img);
    $data = base64_decode($base64img);
    $file = UPLOAD_DIR . $filename . '.png';
    file_put_contents($file, $data);
}
    
?>
