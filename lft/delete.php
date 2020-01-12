<?php
require_once "function.php";
require_once 'PhotosContoroller.php';
session_start();

$passwd=toHtml($_POST['passwd']);
//$_GET['id']を初期化されないように$_SESSION['confirmId']に保持しておく処理
if(isset($_GET['id'])){
	$_SESSION['confirmId']=$_GET['id'];
	unset($_GET['id']);
}
$_SESSION['passFlag']=true;	


try{
	$pdo = makeNewPdo();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	
	//削除ボタンが押された時に行う処理
	if($_POST['delete']&&isset($passwd)){
		$st=$pdo->prepare("SELECT pass FROM registration WHERE showid=?");
		$st->bindValue(1,$_SESSION['confirmId'],PDO::PARAM_STR);
		$st->execute();
		$pass=$st->fetch();
		if(password_verify($passwd,$pass['pass'])){
			$st=$pdo->prepare("DELETE FROM registration WHERE showid=?");
			$st->bindValue(1,$_SESSION['confirmId'],PDO::PARAM_STR);//bindValueはsqlインジェクション対策
			$st->execute();
			$_SESSION['delete']=true;	
			header('Location:confirm.php');
			exit();
		}
		else{
			$_SESSION['passFlag']=false;
		}
	}
	
}catch(PDOException $e){
	echo 'Connection failed: ';
	die($e->getMessage());
}
require "d_delete.php";
?>