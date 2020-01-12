<?php
/*検索条件を入力してshow.phpに飛ばす*/
require_once 'function.php';
require_once 'PhotosContoroller.php';

try{
	$pdo=makeNewPdo();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	$st=$pdo->query("SELECT title FROM game");
	while($games=$st->fetch()){
		$gameTitles[]=$games['title'];
	}
	
}catch(PDOException $e){
	echo 'Connection failed: ';
	die($e->getMessage());
}


require "d_search.php";
?>