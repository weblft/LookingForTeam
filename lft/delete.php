<?php
require_once "function.php";
session_start();

$passwd=htmlspecialchars($_POST['passwd']);
if(isset($_GET['id'])){
	$_SESSION['passflag']=true;
	$_SESSION['confirm_id']=$_GET['id'];
	unset($_GET['id']);
}





try{
	$pdo = makeNewPdo();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	if($_POST['delete']&&isset($passwd)){
		$st=$pdo->prepare("SELECT pass FROM registration WHERE showid=?");
		$st->bindValue(1,$_SESSION['confirm_id'],PDO::PARAM_STR);
		$st->execute();
		$pass=$st->fetch();
		echo 'flag1';
		if(password_verify($passwd,$pass[0])){
			$st=$pdo->prepare("DELETE FROM registration WHERE showid=?");
			$st->bindValue(1,$_SESSION['confirm_id'],PDO::PARAM_STR);//bindValueはsqlインジェクション対策
			$st->execute();
			$_SESSION['delete']=true;
			echo 'flag2';
		//	header('Location:confirm.php');
		//	exit();
		}
		else{
			$_SESSION['passflag']=false;
			echo 'flag3';
		}
	}


}catch(PDOException $e){
	echo 'Connection failed: ';
	die($e->getMessage());
}
//require "d_delete.php"
?>