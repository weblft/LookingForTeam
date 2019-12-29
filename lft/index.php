<?php
require_once "function.php";
require_once 'PhotosContoroller.php';
session_start();
$_SESSION['registed']=false;//confirm.phpから登録完了した後にconfirm.phpに戻れなくするためにfalseにする。
$_SESSION['delete']=false;//confirm.phpから削除完了した後にconfirm.phpに戻れなくするためにfalseにする。
$_SESSION['h_error']=true;//
$_SESSION['w_error']=true;//
$_SESSION['id_judge']=true;
$params = [
'Bucket' => $bucket_name,
'Key' => 'logo.png',
];

try{
	$result = $s3->getObject($params);
	/*$len = $result['ContentLength'];
	
	//ファイルを表示
	header("Content-Type: {$result['ContentType']}");
	echo $result['Body'];
	
	//ファイルダウンロード
	header('Content-Type: application/force-download;');
	header('Content-Length: '.$len);
	header('Content-Disposition: attachment; filename="sample.jpg"');
	echo $result['Body'];
	*/
}catch(S3Exception $e){
	var_dump($e -> getMessage());
}   

require 'd_index.php';

?>