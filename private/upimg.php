<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

$bucket = 'kameishuta';

$s3 = new S3Client([
   'version' => 'latest',
   'region'  => 'ap-northeast-1'
]);

try {
   // Upload data.
   $result = $s3->putObject([
       'Bucket' => $bucket,
       'Key'    => $new_filename,
       'Body'   => $img,
       'ACL'    => 'public-read',
       'ContentType' => mime_content_type($_FILES['upimg'][tmp_name]),
   ]);
   $path = $result['ObjectURL'];
} catch (S3Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
