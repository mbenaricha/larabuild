<?php

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

function ModulePath ()
{
    return '';
}

class bdd
{
    public function BitAnd ($a, $b)
    {
        return "bitand";
    }

    public function AddJoin() {
        return "addjoin";
    }
}
