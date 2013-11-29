<?php
header('Content-Type: image/png');
header('Cache-Control: no-cache, must-revalidate'); 

$username = "root";
$password = "";
$hostname = "localhost"; 
$dbname = "team_reindeer";


try {
    $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    /*** echo a message saying we have connected ***/
   
   
   	$x_coord = $_GET['x_coord'];
	$y_coord = $_GET['y_coord'];
    	
	// check if this monster already exists	
    $statement = $dbh->prepare("SELECT damage_x, damage_y FROM map_tiles WHERE coord_x = ? AND coord_y = ?");
     if( $statement->execute(array($x_coord,$y_coord)) ) {
 		// create image
		$targetImage = imagecreatetruecolor( 256, 256 );
		imagealphablending( $targetImage, false );
		imagesavealpha( $targetImage, true );
			
		$srcImage = imagecreatefrompng(  "images/transparent.png" );    
		imagealphablending( $srcImage, true );
		imagesavealpha( $srcImage, true );
		
		imagecopyresampled( $targetImage, $srcImage, 
		                    0, 0, 
		                    0, 0, 
		                    256, 256, 
		                    256, 256 );  
			                    
     	while ($result = $statement->fetch(PDO::FETCH_ASSOC) ) {
     	
     			// get damage and place it randomly within this tile
				$damage = rand(1,3);
								
				$srcImage = imagecreatefrompng(  "images/damage".$damage.".png" );    
				imagealphablending( $srcImage, true );
				imagesavealpha( $srcImage, true );
				
				imagecopyresampled( $targetImage, $srcImage, 
				                    $result['damage_x'], $result['damage_y'], 
				                    0, 0, 
				                    30, 30, 
				                    30, 30 );  	
				imagealphablending( $targetImage, true );
				imagesavealpha( $targetImage, true );		
     			
     		}
     		
     		
 		// return image
		imagealphablending( $targetImage, true );
		imagesavealpha( $targetImage, true );
		
		imagepng(  $targetImage );   
 		imagedestroy( $targetImage );
     		
     
     	// return transparent tile
     	
      } else {
     	 // Query failed
         // return transparent tile
         
         returnTransparent();
         
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


	 
	function returnTransparent() {
		$srcImage = imagecreatefrompng(  "images/transparent.png" );    
		imagealphablending( $srcImage, true );
		imagesavealpha( $srcImage, true );
		
		$targetImage = imagecreatetruecolor( 400, 400 );
		imagealphablending( $targetImage, false );
		imagesavealpha( $targetImage, true );
		imagecopyresampled( $targetImage, $srcImage, 
		                    0, 0, 
		                    0, 0, 
		                    400, 400, 
		                    400, 400 );
		imagealphablending( $targetImage, true );
		imagesavealpha( $targetImage, true );
		
		imagepng(  $targetImage );
     		imagedestroy( $targetImage );
	}	 

    
?>
