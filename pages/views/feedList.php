<? if ($_GET['show']) {
	$showC = $_GET['show'];
	if ($showC == 'status') $mconn = "`type` = 'stt'";
	else if ($showC == 'blog') $mconn = "`type` = 'blog'";
	else if ($showC == 'promise') $mconn = "`type` = 'new-promise'";
	else if ($showC == 'request') $mconn = "`type` = 'new-request'";
} else $mconn = "`type` != 'like'";
$cond = "(`privacy` = 'public' OR (`privacy` = 'draff' AND `uid` = '$u') OR (`privacy` = 'include' AND `available_list` LIKE '%$u%') OR (`privacy` = 'exclude' AND `available_list` NOT LIKE '%$u%') )";
if ($mconn) $cond = "$mconn AND $cond";

include 'views/feedListDisplay.php'
?>
