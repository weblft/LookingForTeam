<?php
require_once "function.php";
session_start();
$_SESSION['registed']=true;
$title=$_SESSION['regist_title'];//変更
$id=$_SESSION['regist_id'];//変更


$message=$title.'のチームメンバーの募集を開始しました！'."\n".'詳しくは下記のurlから'."\n".'#LookingForTeam'."\n#".$title."\n";
//$message=$title.'のチームメンバーの募集を開始しました！'."\n".'詳しくはこちら'."\n".'localhost/php/lft/show.php?search_title='.$title.'&id='.$id."\n".'#LookingForTeam'."\n#".$title;
$encodeMessage=urlencode($message);
$url="https://weblft.herokuapp.com/show.php?search_title={$title}&id={$id}";
$encodeUrl=urlencode($url);
require "d_confirm.php";

?>


