<?php
/**
 * filename : constscontext.php
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
    public function qstr($sql)
    {
        return "'" . $sql . "'";
    }
}

$bdb = new bdd();

$ROOT = './';
$_SERVER['SERVER_NAME'] = '';
$_SERVER['REQUEST_URI'] = '';
$_SERVER['HTTP_HOST'] = 'determine.site';
$_SERVER['BPACK_APPLI'] = 'determine.site';
$rwroot="rwroot";

// --------------------------------------------------------------------- include config files

if (isset($argv[1]) && isset($argv[2]))
{
    $m_rootapplipath = $argv[1];
    $m_appli = $argv[2];
} else {
    $m_rootapplipath = '../appli';
    $m_appli = 'dp2p';
}

$m_applipath = "$m_rootapplipath/$m_appli";

//include_once("coreversion.inc");

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


// --------------------------------------------------------------------- get constants


$m_app_const = get_defined_constants(true)['user'];
// ------------------------------------

$json_constants = json_encode( $m_app_const);

if (json_last_error() == JSON_ERROR_NONE) {
    $json_response = $json_constants;
} else {
    $err = json_last_error_msg();
    $json_response = json_encode(array('err' => $err));
}

// ---------------- send response
echo $json_response;

