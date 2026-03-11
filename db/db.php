<?php
$servername = "localhost";
$username = "root";
$db_password = "";
$database = "mundial_qatar";

try {
	$db = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $db_password); 	 	 	 	 	 	
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 	 	 	 	
} catch (PDOException $e) {
	echo $e->getMessage(); 	 	 	 	 	 	
}

function obtenerArraySQL($db, $sql){
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	//return new RecursiveArrayIterator($stmt->fetchAll());
	return $stmt->fetchAll();
}
?>
