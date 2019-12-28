<?php
require_once "function.php";
session_start();

$passwd=htmlspecialchars($_POST['passwd']);
if(isset($_GET['id'])){
	_SESSION['confirm_id']=$_GET['id'];
	unset($_GET['id']);
}
$_SESSION['passflag']=true;	


try{
	$pdo = makeNewPdo();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	if($_POST['delete']&&isset($passwd)){
		$st=$pdo->prepare("SELECT pass FROM registration WHERE showid=?");
		$st->bindValue(1,$_SESSION['confirm_id'],PDO::PARAM_STR);
		$st->execute();
		$pass=$st->fetch();
		if(password_verify($passwd,$pass['pass'])){
			$st=$pdo->prepare("DELETE FROM registration WHERE showid=?");
			$st->bindValue(1,$_SESSION['confirm_id'],PDO::PARAM_STR);//bindValueはsqlインジェクション対策
			$st->execute();
			$_SESSION['delete']=true;	
			header('Location:confirm.php');
			exit();
		}
		else{
			$_SESSION['passflag']=false;
			
		}
	}


}catch(PDOException $e){
	echo 'Connection failed: ';
	die($e->getMessage());
}
require "d_delete.php"
?>