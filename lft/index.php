<?php
require('../vendor/autoload.php');
require_once "function.php";
session_start();
$_SESSION['registed']=false;//confirm.phpから登録完了した後にconfirm.phpに戻れなくするためにfalseにする。
$_SESSION['delete']=false;//confirm.phpから削除完了した後にconfirm.phpに戻れなくするためにfalseにする。
$_SESSION['h_error']=true;//regist.phpで平日の終了時刻の方が平日の開始時刻より早く設定されてないかを判定するためのもの
$_SESSION['w_error']=true;//regist.phpで休日の終了時刻の方が休日の開始時刻より早く設定されてないかを判定するためのもの
$_SESSION['id_judge']=true;//


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


require "d_index.php"
?>