<?php
require_once 'function.php';

try{
	$pdo=makeNewPdo();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	$st=$pdo->query("SELECT title FROM game");
	while($games=$st->fetch()){
		$game_titles[]=$games['title'];
	}
	
}catch(PDOException $e){
	echo 'Connection failed: ';
	die($e->getMessage());
}


require "d_search.php";
?>