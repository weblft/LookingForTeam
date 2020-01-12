<?php
require_once "function.php";
require_once 'PhotosContoroller.php';
session_start();
//ここは見直す
$_SESSION['registed']=false;//confirm.phpから登録完了した後にconfirm.phpに戻れなくするためにfalseにする。
$_SESSION['delete']=false;//confirm.phpから削除完了した後にconfirm.phpに戻れなくするためにfalseにする。
$_SESSION['holidayError']=true;//
$_SESSION['weekdayError']=true;//
$_SESSION['idJudge']=true;


try{
	$result = $s3->getObject($params);
	$img=base64_encode($result['Body']);
}
catch(S3Exception $e){
	var_dump($e -> getMessage());
} 

require 'd_index.php';

?>