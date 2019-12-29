<?php 
require '../../vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\CommandPool;

$credentials = [
'key' => 'AKIAINSE6J6RS55N6KXQ',
'secret' => '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',
];

$bucket_version = 'latest';
$bucket_region = 'アジアパシフィック';
$bucket_name = 'my-project-weblft';


$s3 = new S3Client([
'credentials' => $credentials,
'region'  => $bucket_region,
'version' => $bucket_version,
]);
?>