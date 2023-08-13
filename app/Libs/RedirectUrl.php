<?php

namespace App\Libs;

class RedirectUrl
{
    public static function tenantFrontend()
    {
        $protocol = request()->secure() ? 'https://' : 'http://';
        $host = request()->getHost() == '127.0.0.1'
            || request()->getHost() == 'localhost'
            ? 'localhost:3000'
            : request()->getHost();

        $redirectUrl = $protocol . tenant('id') . '.' . $host;

        return $redirectUrl;
    }
}
