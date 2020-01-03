<?php
require_once "function.php";
require_once 'PhotosContoroller.php';
session_start();
$_SESSION['registed']=false;//confirm.phpから登録完了した後にconfirm.phpに戻れなくするためにfalseにする。
$_SESSION['delete']=false;//confirm.phpから削除完了した後にconfirm.phpに戻れなくするためにfalseにする。
$_SESSION['h_error']=true;//
$_SESSION['w_error']=true;//
$_SESSION['id_judge']=true;


try{
	 $result = $s3->getObject($params);
	echo (string)$result->getUri();
	$img=base64_encode($result['Body']);
	
}
catch(S3Exception $e){
	var_dump($e -> getMessage());
} 

//require 'd_index.php';

?>