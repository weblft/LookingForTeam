<?php 
//SDKの読み込み
require '../vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\CommandPool;

//s3を使うための処理
$credentials=[
'key'=>'AKIAINSE6J6RS55N6KXQ',//upするときは削除
'secret'=>'lSb5VuF6Jf9YolaR+h3COxR0paiyrlB0s5ujTB2H',//upするときは削除
];

$bucketVersion='latest';
$bucketRegion='ap-northeast-1';
$bucketName='my-project-weblft';


$s3= new S3Client([
'credentials'=>$credentials,
'region'=>$bucketRegion,
'version'=>$bucketVersion,
]);


$params=[
'Bucket'=>$bucketName,
'Key'=>'logo.png',
];

$params2=[
'Bucket'=>$bucketName,
'Key'=>'background.png',
];
$cmd= $s3->getCommand('GetObject',$params2);
$request= $s3->createPresignedRequest($cmd,'+1 minutes');//1分間の間署名付きurlの取得
$backgroundUri=$request->getUri();//uriの取得
$backgroundUrl=$backgroundUri->getScheme().'://'.$backgroundUri->getHost().$backgroundUri->getPath().'?'.$backgroundUri->getQuery();//urlの取得
session_start();
$_SESSION['background']=$backgroundUrl;
?>