<?php
require_once "function.php";
session_start();

$passwd=htmlspecialchars($_POST['passwd']);
$tweetflag=false;//tweetをできるかどうかを判定するための変数
$_SESSION['passflag']=true;//パスワードの入力があっているか判定するパスワードの入力があっているか判定するための変数。初めの入力のタイミングでエラ〜メッセージが出ないように最初はtrueにしておく。
$message=$_SESSION['tweet_title'].'のチームメンバーの募集を開始しました！'."\n".'詳しくはこちら'."\n".'#Looking For Team'."\n#".$_SESSION['tweet_title'];//twiiterに送るメッセージ
$encodeMessage=urlencode($message);//エンコードしたメッセージ
$url="https://weblft.herokuapp.com/show.php?search_title={$_SESSION['tweet_title']}&id={$_SESSION['confirm_id']}";
$encodeUrl=urlencode($url);//エンコードしたurl

//はじめに受け取ったidとタイトルを保管しておく
if(isset($_GET['id'])){
	$_SESSION['confirm_id']=$_GET['id'];
	$_SESSION['tweet_title']=$_GET['title'];
	unset($_GET['id']);
}





try{
	//登録されているパスワードと一致を判定する処理
	$pdo = makeNewPdo();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	if($_POST['tweet']&&isset($passwd)){
		$st=$pdo->prepare("SELECT pass FROM registration WHERE showid=?");
		$st->bindValue(1,$_SESSION['confirm_id'],PDO::PARAM_STR);
		$st->execute();
		$pass=$st->fetch();
		if(password_verify($passwd,$pass['pass'])){
			$_SESSION['passflag']=true;
			$tweetflag=true;
		}
		else{
			$_SESSION['passflag']=false;
		}
	}
}catch(PDOException $e){
	echo 'Connection failed: ';
	die($e->getMessage());
}
require "d_tweet.php"
?>