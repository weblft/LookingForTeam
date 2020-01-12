<?php
/*confirm.phpはdelete.phpとregist.phpからフラグを受け削除完了や登録完了などの表示を行う*/


require_once 'function.php';
require_once 'PhotosContoroller.php';

session_start();
$_SESSION['registed']=true;
$title=$_SESSION['registTitle'];
$id=$_SESSION['registId'];
$gati=$_SESSION['registGati'];


//ガチ度を識別して対応するメッセージを返す
if($gati==1){
	$gatiMessage= 'ガチ度１(楽しくやろう)';
}
elseif($gati==2){
	$gatiMessage='ガチ度2(強くなりたい)';
}
elseif($gati==2){
	$gatiMessage='ガチ度3(スクリムよくやる)';
}
elseif($gati==2){
	$gatiMessage='ガチ度4(積極的に大会出場)';
}	
elseif($gati==2){
	$gatiMessage='ガチ度5(プロを目指す)';
}


//twitterに投稿するurlとメッセージの作成
$message=$title.'のチームメンバーの募集を'.$gatiMessage.'で開始しました！'."\n".'詳しくは下記のurlから'."\n".'#LookingForTeam'."\n#".$title."\n";
$url="https://weblft.herokuapp.com/show?search_title={$title}&id={$id}";

//twitterbに投稿する際にはurlとメッセージをエンコードしておく
$encodeMessage=urlencode($message);
$encodeUrl=urlencode($url);

require 'd_confirm.php';

?>


