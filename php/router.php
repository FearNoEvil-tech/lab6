<?php
$path=parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)?:'/';
if(preg_match('~^/database(?:/|$)~i',$path)||preg_match('~\.(?:db|sqlite|sql|md)$~i',$path)){http_response_code(404);exit('Not found');}
if($path==='/' )$path='/index.php';
$base=realpath(dirname(__DIR__));
$full=realpath($base.$path);
if($full===false||substr($full,0,strlen($base.DIRECTORY_SEPARATOR))!==$base.DIRECTORY_SEPARATOR||!is_file($full)){http_response_code(404);exit('Not found');}
return false;
