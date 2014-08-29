<? include '../lib/config.php';
$pag = 'help';
if ($mode == 'new') include 'system/helpNew.php';
if ($iid) {
	$gdi = getRecord('help', "`id` = '$iid' ");
	$gdiLikes = explode(', ', $gdi['likes']);
	$auth = getRecord('members^username,avatar,gender', "id = {$gdi['uid']}");
//	$checkDid = countRecord('help', "iid = $iid");
//	$gdid = getRecord('help', "iid = $iid");
	if ($_GET['display']) {
		$dis = $_GET['display'];
		echo '<h3>'.count($gdiLikes).' following people liked this</h3>';
		for ($k = 0; $k < count($gdiLikes); $k++) {
			$ul = $gdiLikes[$k];
			$lp = getRecord('members^username,avatar', "`id` = '$ul' ");
			echo '<div class="one-people"><a href="#!user?u='.$ul.'"><img class="left avatar-circle sm-thum" src="'.$lp['avatar'].'"/> '.$lp['username'].'</a></div>';
		}
	} else if ($_GET['show'] == 'votes') include 'views/helpVotes.php';
	else {
		if ($gdi && ($gdi['privacy'] != 'draff' || $gdi['uid'] == $u)) {
			include 'system/helpView.php';
			include 'views/helpView.php';
		} else echo '<div class="alerts alert-warning">You\'re attempting to access a non-exist promise or this promise\'s owner has set this to private.</div>';
	}
} else {
	$show = $_GET['show'];
	if ($show == 'all' || $show == '' || !$show) $condition = "`privacy` != 'draff' ";
	else if ($show == 'draff') $condition = "`privacy` = 'draff' ";
	else {
		if ($show == 'success') $condition = "`did` = 'yes' AND `lock` = 'yes' ";
		else if ($show == 'fail') $condition = "`did` = 'no' ";
		else if ($show == 'waiting') $condition = "`did` = '' ";
		else if ($show == 'open') $condition = "`lock` != 'yes' ";
		else if ($show == 'lock') $condition = "`lock` = 'yes' ";
		$condition = "`privacy` != 'draff' AND $condition";
	}
	$condition = "`uid` = '$u' AND $condition";
	include 'views/helpList.php';
} ?>

<script>$('.page-content').attr('data-p', 'help')</script>
<? if (!$iid) { ?>
<style>.main-content{box-shadow:none;background:transparent;border:0;padding:0}
.box-feed{padding:15px 20px 10px;margin:10px 0 20px 15px;background:#fff;border:1px solid #f1f1f1;box-shadow:inset 0 0 10px #f8f8f8;border-radius:3px;clear:both;position:relative}</style>
<? } ?>
<script src="<? echo JS ?>/help.js"></script>
