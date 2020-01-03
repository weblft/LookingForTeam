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
	$cmd = $s3 -> getCommand('GetObject', $params);
	$request = $s3->createPresignedRequest($cmd, '+1 minutes');
	$uri = $request -> getUri();
	$img=base64_encode($result['Body']);
	$url = $uri -> getScheme().'://'.$uri -> getHost().$uri -> getPath().'?'.$uri -> getQuery();
	var_dump($url);
}
catch(S3Exception $e){
	var_dump($e -> getMessage());
} 

//require 'd_index.php';

?>