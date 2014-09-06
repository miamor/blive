<? include '../lib/config.php'; ?>

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
	if ($id) {
		$pInfo = $l = getRecord('activity', "`id` = '$id'");
		if ($l['type'] == 'stt' || $l['type'] == 'photo') {
			echo '<!--{board}-->';
			include 'views/feedView.php';
			echo '<script src="'.JS.'/feedView.js"></script>';
		} else echo '<div class="alerts alert-error">Id not match</div>';
	} else {
		include 'views/feedList.php';
		echo '<script src="'.JS.'/community.js"></script>';
	}
} ?>

<? if (!$id) { ?>
<style>.box-feed{padding:15px 20px 10px;margin:10px 0 20px 65px;background:#fff;border:1px solid #f1f1f1;box-shadow:inset 0 0 10px #f8f8f8;border-radius:3px;clear:both;position:relative}</style>
<? } ?>
