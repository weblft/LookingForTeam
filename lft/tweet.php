<?php
require_once "function.php";
require_once 'PhotosContoroller.php';
session_start();

$passwd=convertToHtml($_POST['passwd']);


if($_SESSION['tweet_gati']==1){
	$gatiMessage= "ガチ度１(楽しくやろう)";
}
elseif($_SESSION['tweet_gati']==2){
	$gatiMessage="ガチ度2(強くなりたい)";
}
elseif($_SESSION['tweet_gati']==2){
	$gatiMessage="ガチ度3(スクリムよくやる)";
}
elseif($_SESSION['tweet_gati']==2){
	$gatiMessage="ガチ度4(積極的に大会出場)";
}	
elseif($_SESSION['tweet_gati']==2){
	$gatiMessage="ガチ度5(プロを目指す)";
}





$tweetflag=false;//tweetをできるかどうかを判定するための変数
$_SESSION['passflag']=true;//パスワードの入力があっているか判定するパスワードの入力があっているか判定するための変数。初めの入力のタイミングでエラ〜メッセージが出ないように最初はtrueにしておく。
$message=$_SESSION['tweet_title'].'のチームメンバーの募集を'.$gatiMessage.'で開始しました！'."\n".'詳しくは下記のurlから'."\n".'#LookingForTeam'."\n#".$_SESSION['tweet_title']."\n";//twiiterに送るメッセージ
$encodeMessage=urlencode($message);//エンコードしたメッセージ
$url="https://weblft.herokuapp.com/show.php?search_title={$_SESSION['tweet_title']}&id={$_SESSION['confirm_id']}";
$encodeUrl=urlencode($url);//エンコードしたurl

//はじめに受け取ったidとタイトルを保管しておく
if(isset($_GET['id'])){
	$_SESSION['confirm_id']=$_GET['id'];
	$_SESSION['tweet_title']=$_GET['title'];
	$_SESSION['tweet_gati']=$_GET['gati'];
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