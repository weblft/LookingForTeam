<?php
require_once "function.php";
$title=htmlspecialchars($_POST['regist_title']);
$content=nl2br(htmlspecialchars($_POST['regist_text']),false);
$age=intval(htmlspecialchars($_POST['regist_age']));
$wstart=intval(htmlspecialchars($_POST['regist_W_start_time']));
$wend=intval(htmlspecialchars($_POST['regist_W_end_time']));
$hstart=intval(htmlspecialchars($_POST['regist_H_start_time']));
$hend=intval(htmlspecialchars($_POST['regist_H_end_time']));
$pass=htmlspecialchars($_POST['pass']);
$gati=intval(htmlspecialchars($_POST['regist_gati']));
$check=0;
$shownum=(string)uniqid(rand(1000,9999));//idを作成。
$hash_pass = password_hash($pass, PASSWORD_DEFAULT);
$date=date("Y/m/d H:i:s");





session_start();
if (isset($_SESSION['registed']) && $_SESSION['registed'] == true){
	header('Location:index.php');
	exit();
}
try{
	if(@$_POST['submit']){
		if($wstart>=$wend && $hstart>=$hend){
			$_SESSION['w_error']=false;
			$_SESSION['h_error']=false;
			header('Location:regist.php');
			exit();
		}
		elseif($wstart>=$wend){
			$_SESSION['w_error']=false;
			$_SESSION['h_error']=true;
			header('Location:regist.php');
			exit();
			}
		elseif($hstart>=$hend){
			$_SESSION['h_error']=false;
			$_SESSION['w_error']=true;
			header('Location:regist.php');
			exit();
		}
		$_SESSION['w_error']=true;
		$_SESSION['h_error']=true;
		$pdo=makeNewPdo();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$st=$pdo->prepare("INSERT INTO registration(title,detail,age,W_start,W_end,H_start,H_end,pass,gati,end_check,acount_name,showid,num,date) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$st->bindValue(1,$title,PDO::PARAM_STR);
		$st->bindValue(2,$content,PDO::PARAM_STR);
		$st->bindValue(3,$age,PDO::PARAM_INT);
		$st->bindValue(4,$wstart,PDO::PARAM_INT);
		$st->bindValue(5,$wend,PDO::PARAM_INT);
		$st->bindValue(6,$hstart,PDO::PARAM_INT);
		$st->bindValue(7,$hend,PDO::PARAM_INT);
		$st->bindValue(8,$hash_pass,PDO::PARAM_STR);
		$st->bindValue(9,$gati,PDO::PARAM_INT);
		$st->bindValue(10,$check,PDO::PARAM_INT);
		$st->bindValue(11,$acount,PDO::PARAM_STR);
		$st->bindValue(12,$shownum,PDO::PARAM_STR);
		$st->bindValue(13,0,PDO::PARAM_INT);
		$st->bindValue(14,$date,PDO::PARAM_STR);
		$st->execute();
		$_SESSION['regist_pass']=$pass;//確認ようのパスをconfirm.phpに飛ばすためのセッション
		header('Location:confirm.php');
		exit();
		
	}
}catch(PDOException $e){
	echo 'Connection failed: ';
	die($e->getMessage());
}
$_SESSION['registed']=false;
require "d_regist.php";

?>