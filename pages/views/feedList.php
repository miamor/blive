<? if ($_GET['show']) {
	$showC = $_GET['show'];
	if ($showC == 'status') $mconn = "`type` = 'stt'";
	else if ($showC == 'blog') $mconn = "`type` = 'blog'";
	else if ($showC == 'promise') $mconn = "`type` = 'new-promise'";
	else if ($showC == 'request') $mconn = "`type` = 'new-request'";
} else $mconn = "`type` != 'like'";
if ($frAr) $frArStr = implode(',', $frAr).','.$u;
else $frArStr = $u;
$cond = "`uid` IN ($frArStr) AND (`privacy` = 'public' OR (`privacy` = 'draff' AND `uid` = '$u') OR (`privacy` = 'include' AND `available_list` LIKE '%$u%') OR (`privacy` = 'exclude' AND `available_list` NOT LIKE '%$u%') )";
if ($_GET['view'] == 'mine') $mconn .= "AND `uid` = '$u' ";
if ($mconn) $cond = "$mconn AND $cond"; ?>

<div class="switch-view">
	<a class="switch-link" href="#!feed?view=mine">Mine</a>
</div>

<? include 'views/feedListDisplay.php' ?>
