<?php 
//SDKの読み込み
require '../vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\CommandPool;

$credentials = [
'key' => 'AKIAINSE6J6RS55N6KXQ',//upするときは削除
'secret' => 'lSb5VuF6Jf9YolaR+h3COxR0paiyrlB0s5ujTB2H',//upするときは削除

];

$bucket_version = 'latest';
$bucket_region = 'ap-northeast-1';
$bucket_name = 'my-project-weblft';


$s3 = new S3Client([
'credentials' => $credentials,
'region'  => $bucket_region,
'version' => $bucket_version,
]);


$params = [
'Bucket' => $bucket_name,
'Key' => 'logo.png',
];

$params2=[
'Bucket' => $bucket_name,
'Key' => 'background.png',
];
$cmd = $s3 -> getCommand('GetObject', $params2);
$request = $s3->createPresignedRequest($cmd, '+1 minutes');
$backgroundUri = $request -> getUri();

$backgroundUrl = $backgroundUri-> getScheme().'://'.$backgroundUri -> getHost().$uri -> getPath().'?'.$backgroundUri -> getQuery();
?>