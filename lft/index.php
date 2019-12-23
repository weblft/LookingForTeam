<?php
require('../vendor/autoload.php');
require_once "function.php";
session_start();
$_SESSION['registed']=false;//confirm.phpから登録完了した後にconfirm.phpに戻れなくするためにfalseにする。
$_SESSION['delete']=false;//confirm.phpから削除完了した後にconfirm.phpに戻れなくするためにfalseにする。
$_SESSION['h_error']=true;//
$_SESSION['w_error']=true;//
$_SESSION['id_judge']=true;


try{
		$pdo=makeNewPdo();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		$st=$pdo->query("SELECT title FROM game");
		while($games=$st->fetch()){
			echo 'test!';
			$game_titles[]=$games[0][0];
			echo $games[0][0];
		}
	
}catch(PDOException $e){
	echo 'Connection failed: ';
	die($e->getMessage());
}


//require "d_index.php"
?>