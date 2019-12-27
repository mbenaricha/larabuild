<?php

namespace App\Http\Determine\Builderinfos;
/**
 * filename : CustomApps.php
 * copyright: Determine.
 * author   : mbenaricha
 * date     : 23/12/2019
 */
class CustomApps
{

    private $mainrootpath = '';
    private $applist = array();
    private $appVars = array();
    private $appConstants = array();
    private $errorlog = array();


    /*
     * constructor
     * init: $mainrootpath & refresh
     */
    public function __construct($path)
    {
        $this->setmainrootpath($path);
    }


    /*
     * set $this->mainrootpath and refresh
     */
    public function setmainrootpath($path)
    {
        $this->mainrootpath = $path;
    }

    /*
     * set $this->$applist with
     * folders list under $this->mainrootpath
     */
    private function loadAppliList()
    {
        $appliList = array();
        if ($handle = opendir($this->mainrootpath)) {
            while (false !== ($currentAppli = readdir($handle))) {
                if ($currentAppli != "." && $currentAppli != ".." && filetype($this->mainrootpath . "/$currentAppli") == 'dir') {
                    $appliList[$currentAppli] = "/$currentAppli";
                }
            }
            closedir($handle);
        }
        $this->applist = $appliList;
    }

    /*
     * refresh: $this->applist, $this->appConstants
     */
    public function refresh()
    {
        $this->loadAppliList();
        $this->loadAllApplisConstants();
        $this->loadAllApplisVars();
    }

    public function getAppliList()
    {
        return $this->applist;
    }


// -----------------------------------------------------------------------------------------------------------------

    public function getApplisConstants($filter = array())
    {
        if ($filter && isset($filter['setupvar']) && isset($filter['mask'])) {
            return $this->getMaskMatchApplis($filter['setupvar'], $filter['mask']);
        } else {
            return $this->appConstants;
        }
    }

    public function getApplisVars()
    {
        return $this->appVars;
    }

    public function geterrorlog()
    {
        return $this->errorlog;
    }

    /*
     * set $this->appConstants
     * with all applications constants
     */
    public function loadAllApplisConstants()
    {
        $allconst = array();
        foreach ($this->applist as $appli => $applipath) {
            $appliConstants = $this->getSingleAppConstants($appli);

            if ($appliConstants) {
                $allconst[$appli] = $appliConstants;
            }
        }
        $this->appConstants = $allconst;
    }

    /*
     * return all array of applis witch match
     */
    public function getMaskMatchApplis($setupvar, $maskvalue)
    {
        $applismatched = array();
        foreach ($this->appConstants as $custid => $jsonsetupvars) {
//            $val = json_decode($jsonsetupvars,true);
            $val = $jsonsetupvars;
            if (isset($val[$setupvar])) {
                if ($this->matchMask($val[$setupvar], $maskvalue)) {
                    $applismatched[$custid] = array($setupvar => $val[$setupvar]);
                }
            }
        }
        return $applismatched;
    }


    /*
     * return true if $nunmber match $maskvalue
     */
    public function matchMask($number, $maskvalue)
    {
        return (($number & $maskvalue) === $maskvalue);
    }

    /*
     * return defined constantes
     * of single $appli
     */
    public function getSingleAppConstants($appli)
    {
        $rootapplipath = $this->mainrootpath;
//        $phpscript = $rootapplipath . "/../Builderinfos/constscontext.php";
        $phpscript = __DIR__ . "/constscontext.php";

        $output = array();
        if ($appli) {
            exec("php $phpscript $rootapplipath $appli", $json_output);
            $output = $this->fetchJsonResponse($json_output, $appli);
        }
        return $output;
    }


    public function getSingleAppVars($appli)
    {
        $rootapplipath = $this->mainrootpath;
        $phpscript = __DIR__ . "/varscontext.php";
        $output = array();
        if ($appli) {
            exec("php $phpscript $rootapplipath $appli", $json_output);
            $output = $this->fetchJsonResponse($json_output, $appli);
        }
        return $output;
    }

    private function isJson($string)
    {
        $ret = json_decode($string, true);
        if (json_last_error() == JSON_ERROR_NONE) {
            return $ret;
        } else {
            return false;
        }
    }

    public function fetchJsonResponse($response, $appli)
    {
        $ret = array();
        if (is_array($response)) {
            $count = count($response);
            if ($count > 1) {
                foreach ($response as $key => $msg) {
                    if (!empty($msg)) {
                        $checkedResponse = $this->isJson($msg);
                        if ($checkedResponse) {

                            $this->errorlog[$appli][] = $checkedResponse;
                        } else {
                            $this->errorlog[$appli][] = $msg;
                        }
                    }
                }
            } elseif ($count == 1) {
                $ret = $this->isJson($response[0]);
            }
        }
        return $ret;
    }

    public function loadAllApplisVars()
    {
        $allvars = array();
        foreach ($this->applist as $appli => $applipath) {
            $appliVars = $this->getSingleAppVars($appli);

            // json encode vars values --------------------
            foreach ($appliVars as $varname => $varvalue) {
                if (is_array($varvalue) || is_object($varvalue)) {
                    $appliVars[$varname] = json_encode($varvalue);
                }
            }
            // end json encode vars values --------------------

            if ($appliVars) {
                $allvars[$appli] = $appliVars;
            }
        }

        $this->appVars = $allvars;
    }

    public function searchSettedVars($search)
    {
        $setted = array();
        foreach ($this->appVars as $custid => $vars) {
            if (isset($vars[$search])) {
                $setted[$custid] = $vars[$search];
            }
        }
        return $setted;
    }


}
