<?php

namespace App\Http\Controllers;

use App\Http\Determine\Builderinfos\CustomApps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class InfosController extends Controller
{

    public function all(Request $request)
    {
//        $rootapplipath = __DIR__ . '/../Determine/appli';
        $rootapplipath = '/home/farrugia/www/fullCore/html/appli';
        // init
        $customapps = new CustomApps($rootapplipath);
        $customapps->refresh();
        $response = array(
            'applis' => $customapps->getAppliList(),
            'custumconsts' => $customapps->getApplisConstants(),
            'custumvars' => $customapps->getApplisVars(),
            'errors' => $customapps->geterrorlog(),
        );

        return $response;
    }

    public function custids(Request $request)
    {
        $rootapplipath = __DIR__ . '/../Determine/appli';
        // init
        $customapps = new CustomApps($rootapplipath);
        $customapps->refresh();
        // prepare response
        $response = array(
            'applis' => $customapps->getAppliList(),
            'custumconsts' => $customapps->getApplisConstants(),
            'custumvars' => $customapps->getApplisVars(),
            'errors' => $customapps->geterrorlog(),
        );

        return $response['applis'];

//         return view('part.custids',['custids' => $response['applis']]);
    }


    public function tt(Request $request)
    {
        $jsonstr = '{ "appconf": { "CTR_DEF_REQID": "CTRLASTREQID", "antivirus": { "vendor": "clamav", "cmd": "clamdscan --no-summary - <%s", "found": ":(.*)(FOUND)" }, "pre_account": "409100", "pdf": { "height_logo": 70, "width_logo": 70 }, "Debug": 65793, "coreurl": "eudemo5.determine.com\/aeronantes_i\/", "hostname": "eudemo5.determine.com", "rooturl": "eudemo5.determine.com\/s\/aeronantes_i\/", "apps_url": "", "rootpath": "\/var\/www\/saas\/html\/determine.site\/", "libpath": "\/var\/www\/saas\/html\/determine.site\/lib\/", "Sphinx": { "host": "10.0.1.150:9312" }, "localcache": { "xcache": 1, "instance": "s\/aeronantes_iNmQwYTdlOGRmZTgxODg3ZTZkNjNhMjRh" }, "cache": 300, "memcache": { "mongodb": 1, "host": "10.0.1.150", "instance": "aeronantes_i" } } }';

        $tab = json_decode($jsonstr, true);

        $search = '{"appconf":"memecache"}';


        $s = json_decode($search, true);

        $key = array_values($tab);
//        if (isset($tab[$key]))

//       $int =  array_intersect($tab, $s);



        dd($key);


        return $jsonstr;
    }


}
