<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

define("DB_SERVER", "localhost:8080");
define("DB_USER", "root");
define("DB_PASS", "abc123");
define("DB_NAME", "goodbooks");
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

$dbName = DB_NAME;
$con = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
$db_select = mysql_select_db(DB_NAME, $con);

define('MAIN_PATH', '/var/lib/tomcat6/webapps/ROOT/blive');
// define('HOST_URL', 'http://192.168.93.101');
// define('HOST_NAME', 'localhost');
define('HOST_URL', 'http://localhost:8080/blive');
define('MAIN_URL', HOST_URL);
// define('COMPILE_URL', 'http://localhost:8080/goodbooks');
define('LIB', MAIN_URL.'/lib');
define('ASSETS', MAIN_URL.'/assets');
define('CSS', ASSETS.'/css');
define('IMG', ASSETS.'/img');
define('silk', IMG.'/famfamfam/silk');
define('JS', ASSETS.'/js');
define('JQUERY', JS.'/jquery');
define('PLUGINS', ASSETS.'/plugins');
define(FLAT_UI, PLUGINS.'/flat-ui');
$serverUrl = $_SERVER['REQUEST_URI'];

require_once 'func.lib.php';
// include MAIN_PATH.'/modules/config.php';
// include MAIN_PATH.'/modules/dbModel.php';
// $config = new Config();

$current = $time = date('d-m-Y H:i');
$today = date('d-m-Y');
$todayYMD = date('Y-m-d');
$todayl = date('l');
$todayD = date('D');
$todayd = (int)date('d');
$todaym = (int)date('m');
$todayY = (int)date('Y');
$now = date('dHis');
$curint = (int)date('ymdHi');
$nowFull = (int)date('YmdHis');
$nowMS = date('is');
$nowH = date('H');
$nowS = date('s');
$nowM = date('i');
$m_y = date('ym');
$month = date('ym');

$iid = _GET('i');
$id = _GET('id');
$t = _GET('t');
$r = _GET('r');
$d = _GET('d');
$c = _GET('c');
$a = _GET('a');
$l = _GET('l');
$q = _GET('q');
$p = _GET('p');
$e = _GET('e');
$uid = _GET('u');
$g = _GET('g');
$mode = _GET('mode');
$n = _GET('n');
$cmii = _GET('cmt');

if ( $_SESSION['user_id'] ) {
	global $user_id, $u;
	$user_id = $u = intval($_SESSION['user_id']);
	$member = getRecord('members', "id = $u");
	$frLists = $getRecord -> GET('friend', "`accept` = 'yes' AND (`uid` = '$u' OR `receive_id` = '$u') ");
	foreach ($frLists as $frLists) {
		if ($frLists['uid'] == $u) $frU = $frLists['receive_id'];
		else $frU = $frLists['uid'];
		$frIn = getRecord('members^id,username', "`id` = '$frU'");
		$frArN[$frU] = $frIn['username'];
	}
	$frRequestsTo = $getRecord -> GET('friend', "`accept` != 'yes' AND `receive_id` = '$u' ");
	foreach ($frRequestsTo as $frR) {
		$frU = $frR['uid'];
		$frIn = getRecord('members^id,username', "`id` = '$frU'");
		$frToArN[$frU] = $frIn['username'];
	}
	$frSents = $getRecord -> GET('friend', "`accept` != 'yes' AND `uid` = '$u' ");
	foreach ($frSents as $frS) {
		$frU = $frS['receive_id'];
		$frIn = getRecord('members^id,username', "`id` = '$frU'");
		$frSArN[$frU] = $frIn['username'];
	}
	$frAr = array_keys($frArN);
	$frToAr = array_keys($frToArN);
	$frSAr = array_keys($frSArN);
	$glob_displayName = $member['username'];
	$type = $member['type'];
	$avatar = $member['avatar'];
	$username = $member['username'];
	$coins = $member['coin'];
	$rep = $member['reputation'];
	$aWords = countRecord('promise', "`uid` = '$u' ");
	$sWords = countRecord('promise', "`uid` = '$u' AND `privacy` != 'draff' AND `lock` = 'yes' AND `did` = 'yes' ");
	$fWords = countRecord('promise', "`uid` = '$u' AND `privacy` != 'draff' AND `did` = 'no' ");
	$oWords = countRecord('promise', "`uid` = '$u' AND `privacy` != 'draff' AND `lock` != 'yes' ");
	$lWords = countRecord('promise', "`uid` = '$u' AND `privacy` != 'draff' AND `lock` = 'yes' ");
	$wWords = countRecord('promise', "`uid` = '$u' AND `privacy` != 'draff' AND `did` = '' ");
	$dWords = countRecord('promise', "`uid` = '$u' AND `privacy` = 'draff' ");
	$aAsk = countRecord('ask', "`uid` = '$u' ");
	$anAsk = countRecord('ask', "`uid` = '$u' AND `did` = 'yes' ");
	$uAsk = countRecord('ask', "`uid` = '$u' AND `did` != 'yes' ");
	$notiList = $getRecord -> GET("notification", "`to_uid` = '$u' AND `type` != 'friend_request' AND `type` != 'follow' AND `type` != 'accept_friend_request' ", '%10');
	$notiNum = count($notiList);
} ?>
