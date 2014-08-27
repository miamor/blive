<? include '../lib/config.php' ?>

<? $id = $iid;
include 'system/feed.php';
if ($_GET['display']) {
	$dis = $_GET['display'];
	$lL = $getRecord -> GET('activity', "`type` = 'like' AND `iid` = '$id' ");
	echo '<h3>'.count($lL).' following people liked this</h3>';
	foreach ($lL as $lL) {
		$lp = getRecord('members^username,avatar', "`id` = '{$lL['uid']}' ");
		echo '<div class="one-people"><a href="#!user?u='.$lL['uid'].'"><img class="left avatar-circle sm-thum" src="'.$lp['avatar'].'"/> '.$lp['username'].'</a></div>';
	}
} else {
	if ($id) include 'views/feedView.php';
	else include 'views/feedList.php';
} ?>

<script src="<?php echo JS ?>/community.js"></script>
<style>.sceditor-container{margin:-1px;width:100%!important;border:1px solid #ededed}
.pagination{display:none}</style>
<? if (!$id) { ?>
<style>.main-content{box-shadow:none;background:transparent;border:0;padding:0}
.box-feed{padding:15px 20px 10px;margin:10px 0 20px 65px;background:#fff;border:1px solid #f1f1f1;box-shadow:inset 0 0 10px #f8f8f8;border-radius:3px;clear:both;position:relative}</style>
<? } ?>
