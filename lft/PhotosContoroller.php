<?php 
//SDKの読み込み
require '../vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\CommandPool;

$credentials = [
'key' => 'AKIAINSE6J6RS55N6KXQ',
'secret' => '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',
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

try{
	$result = $s3->getObject($params);
	header("Content-Type:image/png");
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



?>