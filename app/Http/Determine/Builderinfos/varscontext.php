<?php
/**
 * filename : appload.php
 * copyright: Determine.
 * author   : mbenaricha
 * date     : 03/12/2019
 */

// --------------------------------------------------------------------- determine config
function DBPref($doc)
{
    $prefixes = array(
        'ORDERID' => 'P',
        'REQUESTID' => 'R',
        'PACKID' => 'BL',
        'SUPPLIERID' => 'S',
        'INVOICEID' => 'F',
        'ITEMID' => 'I',
        'INVFILEID' => 'INV',
    );

    return (isset($prefixes[$doc])) ? $prefixes[$doc] : 'X';
}

class bdd
{
    public function BitAnd($a, $b)
    {
        return "bitand";
    }
}

$bdb = new bdd();

$ROOT = './';
$_SERVER['SERVER_NAME'] = '';
$_SERVER['REQUEST_URI'] = '';
$_SERVER['HTTP_HOST'] = 'determine.site';
$_SERVER['BPACK_APPLI'] = 'determine.site';
$rwroot = "rwroot";

// --------------------------------------------------------------------- include config files

if (isset($argv[1]) && isset($argv[2])) {
    $m_rootapplipath = $argv[1];
    $m_appli = $argv[2];
} else {
    $m_rootapplipath = '../appli';
    $m_appli = 'dp2p';
}

$m_applipath = "$m_rootapplipath/$m_appli";

if (file_exists("$m_applipath/version.inc")) {
    include_once("$m_applipath/version.inc");
}

if (file_exists("$m_applipath/config.inc")) {
    include_once("$m_applipath/config.inc");
}

if (file_exists("$m_applipath/dbstruct.inc")) {
    include_once("$m_applipath/dbstruct.inc");
}

if (file_exists("$m_applipath/setup_entry.inc")) {
    include_once("$m_applipath/setup_entry.inc");
}

// --------------------------------------------------------------------- get vars

//$m_app_vars = get_defined_vars(); not work because of recursive $GLOBALS[GLOBALS]
$m_app_vars = s_get_defined_vars();
// ------------------------------------

$json_vars = json_encode($m_app_vars);

if (json_last_error() == JSON_ERROR_NONE) {
    $json_response = $json_vars;
} else {
    $err = json_last_error_msg();
    $json_response = json_encode(array('err' => $err));
}

// ---------------- send response
echo $json_response;


// ------------------------------------- function to get global vars
function s_get_defined_vars()
{
    $excluded = array(
        'argv', 'argc', 'bdb', 'json_vars', 'm_app_vars', 'json_response', 'm_applipath', 'err',
        'excluded', 'key', 'val', 'm_rootapplipath', 'm_appli',
        'GLOBALS', '_GET', '_POST', '_SERVER', '_COOKIE', '_FILES', 'rwroot', 'ROOT', 'reseller',
    );
    $m_app_vars = array();
    foreach ($GLOBALS as $key => $val) {
        if (!in_array($key, $excluded)) {
            $m_app_vars[$key] = $val;
        }
    }
    return $m_app_vars;
}

