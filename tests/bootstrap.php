<?php
// @codingStandardsIgnoreFile
require_once __DIR__ . '/../autoload.php';

use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;

$accessKey = getenv('QINIU_ACCESS_KEY');
$secretKey = getenv('QINIU_SECRET_KEY');
$testAuth = new Auth($accessKey, $secretKey);

$bucketName = getenv('QINIU_TEST_BUCKET');
$key = 'php-logo.png';
$key2 = 'niu.jpg';

$testStartDate = date('Y-m-d', strtotime('-2 days'));
$testEndDate = date('Y-m-d', strtotime('-1 day'));
$testGranularity = 'day';
$testLogDate = date('Y-m-d',strtotime("-1 days"));

$dummyAccessKey = 'abcdefghklmnopq';
$dummySecretKey = '1234567890';
$dummyAuth = new Auth($dummyAccessKey, $dummySecretKey);

//cdn
$timestampAntiLeechEncryptKey = getenv('QINIU_TIMESTAMP_ENCRPTKEY');
$customDomain = 'http://' . qiniuTestDomain();
$customDomain2 = qiniuTestDomain();
$customCallbackURL = "https://qiniu.timhbw.com/notify/callback";

function qiniuTestDomain()
{
    $domain = preg_replace('#^https?://#', '', getenv('QINIU_TEST_DOMAIN'));
    return rtrim($domain, '/');
}

function qiniuEnsureTestObject($bucket, $key, $filePath)
{
    global $testAuth;

    $bucketManager = new BucketManager($testAuth);
    list(, $error) = $bucketManager->stat($bucket, $key);
    if ($error === null) {
        return;
    }
    if ($error->code() !== 612) {
        throw new RuntimeException($error->message());
    }

    $uploadManager = new UploadManager();
    $token = $testAuth->uploadToken($bucket, $key);
    list(, $error) = $uploadManager->putFile($token, $key, $filePath);
    if ($error !== null) {
        throw new RuntimeException($error->message());
    }
}

$tid = getenv('TRAVIS_JOB_NUMBER');
if (!empty($tid)) {
    $pid = getmypid();
    $tid = strstr($tid, '.');
    $tid .= '.' . $pid;
}

function qiniuTempFile($size, $randomized = true)
{
    $fileName = tempnam(sys_get_temp_dir(), 'qiniu_');
    $file = fopen($fileName, 'wb');
    if ($randomized) {
        $rest_size = $size;
        while ($rest_size > 0) {
            $length = min($rest_size, 4 * 1024);
            if (fwrite($file, random_bytes($length)) == false) {
                return false;
            }
            $rest_size -= $length;
        }
    } else if ($size > 0) {
        fseek($file, $size - 1);
        fwrite($file, ' ');
    }
    fclose($file);
    return $fileName;
}
