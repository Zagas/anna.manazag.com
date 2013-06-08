<!--Class to use mysql database -->
<?php
 
 	
function dbaccess(){
	$mysqli = new mysqli("mysql.tmci.me", "tmciproject", "3CEWeAXk", "socialmon");
     
	// verifica dell'avvenuta connessione
	if (mysqli_connect_errno()) {
		// notifica in caso di errore
		echo "Errore in connessione al DBMS: ".mysqli_connect_error();
		// interruzione delle esecuzioni i caso di errore
		exit();
	}
	else {
		// notifica in caso di connessione attiva
		echo "Connection succesfully established\n";
	}
	return($mysqli);
}


function insertDB($query){
	$dbh = dbaccess();
	$dbh->query($query);
}

 function Leggidb($query){
        $db = dbaccess();
	$result = $db->query($query);
	echo $result;
	return($result);
} 

function FBtoCheck($query){
	$dbh = dbaccess();
	$result = $dbh->query($query);
	$rows = $result->num_rows;
	$stack = array();
	if($rows >0){
		while($row = $result->fetch_array(MYSQLI_NUM)) {
			$id = $row[0];
			$fb_url = $row[1];
			$data = array("id" => "$id", "fb_url" => "$fb_url");
			array_push($stack, $data);			
		}
	}
	$result->close(); // close DB connection
	return($stack);
}
?>
