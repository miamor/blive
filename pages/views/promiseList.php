<!-- What you said -->

<!--{left-content}-->

<div class="switch-view right">
	<a class="switch-link" href="#!promise?view=mine">Mine</a>
</div>
<h2>Promises</h2>

<? if ($_GET['view']) {
	$view = $_GET['view'];
	if ($view == 'mine') $mconn = "`uid` = '$u' AND `type` != 'like' ";
} else $mconn = "`type` != 'like' ";
$cond = "`type` = 'new-promise' AND (`privacy` = 'public' OR (`privacy` = 'draff' AND `uid` = '$u') OR (`privacy` = 'include' AND `available_list` LIKE '%$u%') OR (`privacy` = 'exclude' AND `available_list` NOT LIKE '%$u%') )";
if ($mconn) $cond = "$mconn AND $cond";

include 'views/feedListDisplay.php' ?>

<script src="<? echo JS ?>/community.js"></script>
<style>.box-feed{padding:15px 20px 10px;margin:10px 0 20px 65px!important;background:#fff;border:1px solid #f1f1f1;box-shadow:inset 0 0 10px #f8f8f8;border-radius:3px;clear:both;position:relative}</style>
