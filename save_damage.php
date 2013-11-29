<?php

$username = "root";
$password = "";
$hostname = "localhost"; 
$dbname = "team_reindeer";


try {
    $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    /*** echo a message saying we have connected ***/
   // echo 'Connected to database';
    
   	$x_coord = $_GET['x_coord'];
	$y_coord = $_GET['y_coord'];
   	$damage_x = $_GET['damage_x'];
	$damage_y = $_GET['damage_y'];
	$damage_type = $_GET['damage_type'];
	
	if ($damage_x > 246 || $damage_y > 246) {
		return;
	}
    
     /*** INSERT data ***/
    $count = $dbh->exec("INSERT INTO map_tiles (coord_x, coord_y, damage_x, damage_y, damage_type) VALUES ($x_coord, $y_coord, $damage_x, $damage_y, $damage_type)");

/* 	echo ; */
	/*

	saveImage($monster_image, $dbh->lastInsertId());
	return $dbh->lastInsertId();
*/
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
/*

    define('UPLOAD_DIR', 'uploads/');
    $base64img = str_replace('data:image/png;base64,', '', $base64img);
    $data = base64_decode($base64img);
    $file = UPLOAD_DIR . $filename . '.png';
    file_put_contents($file, $data);
*/
}
    
?>
