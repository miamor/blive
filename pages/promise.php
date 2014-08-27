<? include '../lib/config.php';
$pag = 'promise';
if ($mode == 'new') include 'system/promiseNew.php';
if ($iid) {
	$gdi = getRecord('promise', "`id` = '$iid' ");
	$gdiLikes = explode(', ', $gdi['likes']);
	$auth = getRecord('members^username,avatar,gender', "id = {$gdi['uid']}");
	$checkDid = countRecord('promise_did', "iid = $iid");
	$gdid = getRecord('promise_did', "iid = $iid");
	if ($_GET['display']) {
		$dis = $_GET['display'];
		echo '<h3>'.count($gdiLikes).' following people liked this</h3>';
		for ($k = 0; $k < count($gdiLikes); $k++) {
			$ul = $gdiLikes[$k];
			$lp = getRecord('members^username,avatar', "`id` = '$ul' ");
			echo '<div class="one-people"><a href="#!user?u='.$ul.'"><img class="left avatar-circle sm-thum" src="'.$lp['avatar'].'"/> '.$lp['username'].'</a></div>';
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
<script src="<? echo JS ?>/promise.js"></script>
