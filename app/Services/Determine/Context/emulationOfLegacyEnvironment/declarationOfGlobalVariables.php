<?php

global $ROOT, $AROOT, $CUST_ID, $bdb, $rwroot, $appconf, $custid;

$_SERVER['BPACK_APPLI'] = '';
$_SERVER['SERVER_NAME'] = '';
$_SERVER['REQUEST_URI'] = '';
$_SERVER['HTTP_HOST'] = '';

$ROOT = '';
$AROOT = '';
$CUST_ID = '';
$bdb = new bdd();
$rwroot = '';
$appconf['root_file'] = '';
$custid = '';


if (!defined('CURLOPT_HTTPHEADER')) {
    define('CURLOPT_HTTPHEADER', '');
}

if (!defined('CURLOPT_RETURNTRANSFER')) {
    define('CURLOPT_RETURNTRANSFER', '');
}

if (!defined('CURLOPT_BINARYTRANSFER')) {
    define('CURLOPT_BINARYTRANSFER', '');
}

if (!defined('CURLOPT_SSL_VERIFYPEER')) {
    define('CURLOPT_SSL_VERIFYPEER', '');
}

if (!defined('CURLOPT_SSL_VERIFYHOST')) {
    define('CURLOPT_SSL_VERIFYHOST', '');
}