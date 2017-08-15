<?php

class Cache {

    public static function getHeaders()
    {
        if (!function_exists('getallheaders')) {
            $headers = array();
            foreach ($_SERVER as $name => $value) {
                if (substr($name, 0, 5) == 'HTTP_') {
                    $headers[str_replace(' ', '-',
                        ucwords(strtolower(str_replace(
                            '_', ' ', substr($name, 5)))))] = $value;
                }
            }
        }
        $headers = getallheaders();
        return $headers;
    }

    public static function check($uri = null)
    {
        $headers = self::getHeaders();
        $HashID = md5($uri ? $uri : $_SERVER['REQUEST_URI']);
        $ExpireTime = 86400 * 360;
        header('Cache-Control: max-age=' . $ExpireTime);
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $ExpireTime).' GMT');
        header('ETag: ' . $HashID);
        $not_cached = strpos(@$headers['If-None-Match'], $HashID) === false;
        if (!$not_cached) {
            header("HTTP/1.1 304 Not Modified");
            exit();
        }
    }

}

?>
