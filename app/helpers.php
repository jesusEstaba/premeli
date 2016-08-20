<?php

function assets($path)
{
	$secure = (env('APP_ENV')=='production') ? true : false;
    return app('url')->asset($path, $secure);
}