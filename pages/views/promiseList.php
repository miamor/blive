<!-- Promises -->

<? $mconn = "`type` = 'new-promise'";
if ($frAr) $frArStr = implode(',', $frAr).','.$u;
else $frArStr = $u;
$cond = "`uid` IN ($frArStr) AND (`privacy` = 'public' OR (`privacy` = 'draff' AND `uid` = '$u') OR (`privacy` = 'include' AND `available_list` LIKE '%$u%') OR (`privacy` = 'exclude' AND `available_list` NOT LIKE '%$u%') )";
if ($_GET['view'] == 'mine') $mconn .= "AND `uid` = '$u' ";
if ($mconn) $cond = "$mconn AND $cond"; ?>

<div class="switch-view right">
	<a class="switch-link" href="#!feed?view=mine">Mine</a>
</div>
<h2>Promises</h2>

<? include 'views/feedListDisplay.php' ?>

<script src="<? echo JS ?>/community.js"></script>
<style>.box-feed{padding:15px 20px 10px;margin:10px 0 20px 65px!important;background:#fff;border:1px solid #f1f1f1;box-shadow:inset 0 0 10px #f8f8f8;border-radius:3px;clear:both;position:relative}</style>
