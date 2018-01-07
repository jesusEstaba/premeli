<?php

function assets($path)
{
    $secure = env('APP_ENV')=='production' || env('APP_SECURE')==true;
    return app('url')->asset($path, $secure);
}

function dbData($param)
{
    if (env("CLEARDB_DATABASE_URL", false)) {
    	$url = parse_url(env("CLEARDB_DATABASE_URL"));

	    if ($param === 'db') {
	        return substr($url["path"], 1);
	    }

	    return $url[$param];//host || user || pass
    }
 	
 	return '';   
}
