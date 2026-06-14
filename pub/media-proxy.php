<?php
/**
 * Lightweight R2/S3 media proxy.
 *
 * Streams media files directly from the remote storage bucket
 * without booting the full Magento application or writing locally.
 */

require dirname(__DIR__) . '/vendor/autoload.php';

$requestUri = $_SERVER['REQUEST_URI'] ?? '';
$path = parse_url($requestUri, PHP_URL_PATH);

// Strip leading /media/ to get the relative path within the media directory
$relativePath = preg_replace('#^/media/#', '', $path);

if (empty($relativePath) || str_contains($relativePath, '..')) {
    http_response_code(400);
    exit;
}

$bucket = $_ENV['AWS_BUCKET'] ?? $_SERVER['AWS_BUCKET'] ?? getenv('AWS_BUCKET') ?: '';
$region = $_ENV['AWS_DEFAULT_REGION'] ?? $_SERVER['AWS_DEFAULT_REGION'] ?? getenv('AWS_DEFAULT_REGION') ?: 'auto';
$endpoint = $_ENV['AWS_ENDPOINT'] ?? $_SERVER['AWS_ENDPOINT'] ?? getenv('AWS_ENDPOINT') ?: '';
$key = $_ENV['AWS_ACCESS_KEY_ID'] ?? $_SERVER['AWS_ACCESS_KEY_ID'] ?? getenv('AWS_ACCESS_KEY_ID') ?: '';
$secret = $_ENV['AWS_SECRET_ACCESS_KEY'] ?? $_SERVER['AWS_SECRET_ACCESS_KEY'] ?? getenv('AWS_SECRET_ACCESS_KEY') ?: '';

if (empty($bucket) || empty($endpoint) || empty($key) || empty($secret)) {
    http_response_code(500);
    echo 'Media proxy: missing R2 configuration';
    exit;
}

$s3 = new Aws\S3\S3Client([
    'version' => 'latest',
    'region' => $region,
    'endpoint' => $endpoint,
    'use_path_style_endpoint' => false,
    'credentials' => [
        'key' => $key,
        'secret' => $secret,
    ],
]);

$objectKey = 'media/' . $relativePath;

try {
    $result = $s3->getObject([
        'Bucket' => $bucket,
        'Key' => $objectKey,
    ]);

    $contentType = $result['ContentType'] ?? 'application/octet-stream';
    $contentLength = $result['ContentLength'] ?? null;

    header('Content-Type: ' . $contentType);
    if ($contentLength) {
        header('Content-Length: ' . $contentLength);
    }
    header('Cache-Control: public, max-age=31536000, immutable');

    echo $result['Body'];
} catch (Aws\S3\Exception\S3Exception $e) {
    if ($e->getStatusCode() === 404) {
        http_response_code(404);
        echo 'Media proxy: object not found - ' . $objectKey;
    } else {
        http_response_code(502);
        echo 'Media proxy: R2 error - ' . $e->getAwsErrorCode();
    }
}
