<? include '../lib/config.php';

$pag = 'promise';
if ($mode == 'new') include 'system/promiseNew.php';
if ($iid) {
	echo '<!--{board}-->';
	$gdi = getRecord('promise', "`id` = '$iid' ");
	echo '<!-- '.$gdi['content'].' -->';
	$gdiLikes = explode(', ', $gdi['likes']);
	$auth = getRecord('members^username,avatar,gender', "id = {$gdi['uid']}");
	$checkDid = countRecord('promise_did', "iid = $iid");
	$gdid = getRecord('promise_did', "iid = $iid");
	$encourageAr = explode(', ', $gdi['encourage']);
	$gdlBelieveAr = explode(', ', $gdid['believe']);
	$gdlBelieveNotAr = explode(', ', $gdid['believe_not']);
	$gdlKnowAr = explode(', ', $gdid['know_did']);
	$gdlKnowNotAr = explode(', ', $gdid['know_didnot']);
	$gdlLikesAr = explode(', ', $gdi['likes']);
	$pAr = explode(', ', $gdid['people']);
	$sAr = explode(', ', $gdid['suborner']);
	$compare = array_diff($sAr, $gdlKnowAr);
	$compareKnowNot = array_diff($sAr, $gdlKnowNotAr);
	$totalConfirmed = count($compare) + count($compareKnowNot);
	$reqr = round(count($sAr)/2);
	if ($_GET['display']) {
		$dis = $_GET['display'];
		echo '<h3>'.count($gdiLikes).' following people liked this</h3>';
		for ($k = 0; $k < count($gdiLikes); $k++) {
			$ul = $gdiLikes[$k];
			$lp = getRecord('members^username,avatar', "`id` = '$ul' ");
			echo '<div class="one-people"><a href="#!user?u='.$ul.'"><img class="left avatar-circle sm-thum" src="'.$lp['avatar'].'"/> '.$lp['username'].'</a>';
			echo '<div class="right">';
			if (in_array($ul, $frAr)) echo '<span class="btn btn-small btn-info">Friends</span>';
			else if (in_array($ul, $frRequestsTo)) echo '<span class="btn btn-small btn-success">Accept</span>';
			else if (in_array($ul, $frSAr)) echo '<span class="btn btn-small btn-default">Friend request sent</span>';
			else if ($ul != $u) echo '<span class="btn btn-small btn-primary">Add friend</span>';
			echo '</div>';
			echo '</div>';
		}
	} else if ($_GET['show'] == 'votes') include 'views/promiseVotes.php';
	else {
		if ($gdi && ($gdi['privacy'] != 'draff' || $gdi['uid'] == $u)) {
			include 'system/promiseView.php';
			include 'views/promiseView.php';
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
	include 'views/promiseList.php';
} ?>

<script>$('.page-content').attr('data-p', 'promise')</script>
<? if (!$iid) { ?>
<style>.box-feed{padding:15px 20px 10px;margin:10px 0 20px 15px;background:#fff;border:1px solid #f1f1f1;box-shadow:inset 0 0 10px #f8f8f8;border-radius:3px;clear:both;position:relative}</style>
<? } ?>
<!--<script src="<? echo JS ?>/promise.js"></script>-->
