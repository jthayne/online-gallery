<?php
define ('ACCESS_KEY', '84H9YKPB');

define ('DATABASE_SERVER', '');
define ('DATABASE_NAME', '');
define ('DATABASE_USER', '');
define ('DATABASE_PASSWORD', '');

### DATABASE ##
$database = DATABASE_NAME;

### DATABASE CONNECT ###
$mysqli = new mysqli(DATABASE_SERVER, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);

### SET VARIABLE DEFAULTS ###
if (!isset($extraCSS)) {
    $extraCSS = "";
}
