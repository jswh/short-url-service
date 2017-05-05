<?php
$table = 'shorten_url';
$chars = ['q','w','e','r','t','y','u','i','o','p','a','s','d','f','g','h','j','k','l','z','x','c','v','b','n','m','0','1','2','3','4','5','6','7','8','9','Q','W','E','R','T','Y','U','I','O','P','A','S','D','F','G','H','J','K','L','Z','X','C','V','B','N','M'];
function linkDb() {
    $dbHost = 'sqld.duapp.com:4050';
    $dbName = '';
    $dbUsr = '';
    $dbPwd = '';

    $conn = mysql_pconnect($dbHost, $dbUsr, $dbPwd);
    if (!$conn) abort(500, 'db lost');
    if (!mysql_select_db($dbName, $conn)) abort(500, 'db not selected');

    return $conn;
}
function abort($code, $msg) {
    header("error: $msg", true, $code);
    die;
}
function codeTrans($int, $chars) {
    $system = count($chars);
    $str = '';
    do {
        $modResult = intval($int / $system);
        $remainder = $int % $system;
        $str = $chars[$remainder] . $str;
        $int = $modResult;
    } while ($modResult > 0);

    return $str;
}
function codeRevert($str, $chars) {
    $system = count($chars);
    $strArray = array_reverse(str_split($str));
    $counter = 0;
    foreach ($strArray as $k => $v) {
        $num = array_search($v, $chars);
        $counter += ($num * pow($system, $k));
    }

    return $counter;
}

