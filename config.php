<?php
//mysql database address
if (strpos($_SERVER['HTTP_HOST'] , 'myblog.com') !== false ) {
define('DB_HOST','192.168.1.234');
//mysql database user
define('DB_USER','devuser');
//database password
define('DB_PASSWD','devuser');

} else {
define('DB_HOST','172.17.0.1');
//mysql database user
define('DB_USER','lg_blog');
//database password
define('DB_PASSWD','9f06a76ced9120db51bf2677ce411d77');
}

//database name
define('DB_NAME','blog_loveqzhi');
//database prefix
define('DB_PREFIX','eg_');
//auth key
define('AUTH_KEY','1fTHGsxAxGpQoE)VbqYFe#wuU!Ut2$7h534c07c4c06c14de70178e1296fcf30e');
//cookie name
define('AUTH_COOKIE_NAME','EM_AUTHCOOKIE_mwbf4bAqo5Exf3QxWgvS0tANLT6L0Bp0');
