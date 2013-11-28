<?php
header('Content-Type: image/png');

$username = "root";
$password = "";
$hostname = "localhost"; 
$dbname = "team_reindeer";


try {
    $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    /*** echo a message saying we have connected ***/
   
   
   	$x_coord = $_GET['x_coord'];
	$y_coord = $_GET['y_coord'];
    
    
    // look the map tile up in the database
    
    // if it's not there, then insert a blank entry
    
	    // then return an empty tile

	// else get the info about it
$image = imagecreatetruecolor(485, 500);
imagealphablending($image, false);
imagesavealpha($image, true);
$col=imagecolorallocatealpha($image,255,255,255,127);
imagefill($image, 0, 0, $col);
//imagefilledrectangle($image,0,0,485, 500,$col);


/* add door glass */
$img_doorGlass = imagecreatefrompng("images/damage1.png");     
imagecopyresampled($image, $img_doorGlass, 106, 15, 0, 0, 185, 450, 185, 450);              


/* add door */
$img_doorStyle = imagecreatefrompng("door/$doorStyle/$doorStyle"."_"."$doorColor.png");     
imagecopyresampled($image, $img_doorStyle, 106, 15, 0, 0, 185, 450, 185, 450);


$fn = md5(microtime()."door_builder").".png";

if(imagepng($image, "user_doors/$fn", 1)){
  echo "user_doors/$fn";
}       
imagedestroy($image); 


	
	// check if this monster already exists	
    $statement = $dbh->prepare("SELECT damage_level FROM map_tiles WHERE coord_x = ? AND coord_y = ?");
     if( $statement->execute(array($x_coord,$y_coord)) ) {
     	$result = $statement->fetch();
     	if ($result == '') 
     	{
    		$statement = $dbh->prepare("INSERT INTO map_tiles (coord_x, coord_y) VALUES (?, ?)");
     		 $statement->execute(array($x_coord,$y_coord));
     	} else {
     		for ($i = 0; $i <= $result['damage_level']; $i++ ) {
     			// get damage and place it randomly within this tile
     		}
     	}
     	// return transparent tile
     	
      } else {
     	 // Query failed
         // return transparent tile
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
