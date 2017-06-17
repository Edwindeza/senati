<?php
	
        class Conexion  {
            
            
			function initConnection(){
			    $servername = "52.179.182.144";
			    $username = "senati";
			    $password = "Passw@rd123";
			    $db = "moodle";
			    // Create connection
				
				try {

						$conn = new mysqli($servername, $username, $password,$db);
						return $conn;
					}
					catch (Exception $e) {
					    // not a MySQL exception
					    echo $e->getMessage();
					   
				}	

			}
        }
 	

?>