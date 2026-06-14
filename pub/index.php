<?php
/**
 * Public alias for the application entry point
 *
 * Copyright 2011 Adobe
 * All Rights Reserved.
 */

use Magento\Framework\App\Bootstrap;

// Temporary debug — remove after diagnosing
if (isset($_GET['debug_media'])) {
    header('Content-Type: text/plain');
    echo 'REQUEST_URI: ' . ($_SERVER['REQUEST_URI'] ?? 'NULL') . "\n";
    echo 'SCRIPT_NAME: ' . ($_SERVER['SCRIPT_NAME'] ?? 'NULL') . "\n";
    echo 'PHP_SELF: ' . ($_SERVER['PHP_SELF'] ?? 'NULL') . "\n";
    echo 'DOCUMENT_ROOT: ' . ($_SERVER['DOCUMENT_ROOT'] ?? 'NULL') . "\n";
    exit;
}

// Route /media/* requests to the lightweight R2 proxy.
// Streams directly from R2 without booting Magento or writing locally,
// since the filesystem is read-only on Laravel Cloud.
$requestUri = $_SERVER['REQUEST_URI'] ?? '';
$path = parse_url($requestUri, PHP_URL_PATH);
if (strpos($path, '/media/') === 0) {
    require __DIR__ . '/media-proxy.php';
    exit;
}

try {
    require __DIR__ . '/../app/bootstrap.php';
} catch (\Exception $e) {
    echo <<<HTML
<div style="font:12px/1.35em arial, helvetica, sans-serif;">
    <div style="margin:0 0 25px 0; border-bottom:1px solid #ccc;">
        <h3 style="margin:0;font-size:1.7em;font-weight:normal;text-transform:none;text-align:left;color:#2f2f2f;">
        Autoload error</h3>
    </div>
    <p>{$e->getMessage()}</p>
</div>
HTML;
    http_response_code(500);
    exit(1);
}

$bootstrap = Bootstrap::create(BP, $_SERVER);
/** @var \Magento\Framework\App\Http $app */
$app = $bootstrap->createApplication(\Magento\Framework\App\Http::class);
$bootstrap->run($app);
