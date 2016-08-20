<?php

function assets($path)
{
    $secure = (env('APP_ENV')=='production') ? true : false;
    return app('url')->asset($path, $secure);
}

function dbData($param)
{
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

   
    
    if ($param === 'db') {
            return substr($url["path"], 1);
    }

    return $url[$param];//host || user || pass
}
