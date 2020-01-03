<?php

if (!function_exists('DBPref')) {
    function DBPref ($doc)
    {
        $prefixes = [
            'ORDERID'    => 'P',
            'REQUESTID'  => 'R',
            'PACKID'     => 'BL',
            'SUPPLIERID' => 'S',
            'INVOICEID'  => 'F',
            'ITEMID'     => 'I',
            'INVFILEID'  => 'INV',
        ];

        return (isset($prefixes[$doc])) ? $prefixes[$doc] : 'X';
    }
}

if (!class_exists('bdd')) {
    class bdd
    {
        public function BitAnd ($a, $b)
        {
            return "bitand";
        }
    }
}
