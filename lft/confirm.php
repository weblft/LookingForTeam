<?php
require_once "function.php";
require_once 'PhotosContoroller.php';

session_start();
$_SESSION['registed']=true;
$title=$_SESSION['regist_title'];//変更
$id=$_SESSION['regist_id'];//変更
$gati=$_SESSION['regist_gati'];
if($gati==1){
	$gatiMessage= "ガチ度１(楽しくやろう)";
}
elseif($gati==2){
	$gatiMessage="ガチ度2(強くなりたい)";
}
elseif($gati==2){
	$gatiMessage="ガチ度3(スクリムよくやる)";
}
elseif($gati==2){
	$gatiMessage="ガチ度4(積極的に大会出場)";
}	
elseif($gati==2){
	$gatiMessage="ガチ度5(プロを目指す)";
}

$message=$title.'のチームメンバーの募集を'.$gatiMessage.'で開始しました！'."\n".'詳しくは下記のurlから'."\n".'#LookingForTeam'."\n#".$title."\n";
//$message=$title.'のチームメンバーの募集を開始しました！'."\n".'詳しくはこちら'."\n".'localhost/php/lft/show.php?search_title='.$title.'&id='.$id."\n".'#LookingForTeam'."\n#".$title;
$encodeMessage=urlencode($message);
$url="https://weblft.herokuapp.com/show?search_title={$title}&id={$id}";
$encodeUrl=urlencode($url);
require "d_confirm.php";

?>


