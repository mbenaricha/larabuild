<?php

//global $ROOT, $AROOT, $CUST_ID, $bdb;

$_SERVER['BPACK_APPLI'] = '1.0';
$_SERVER['SERVER_NAME'] = '1.0';
$_SERVER['REQUEST_URI'] = '1.0';

$ROOT = '';
$AROOT = '';
$CUST_ID = '';

class bdd
{
    public function BitAnd($a, $b)
    {
        return "bitand";
    }
    public function qstr($sql)
    {
        return "'" . $sql . "'";
    }
}

$bdb = new bdd();

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