<? include '../lib/config.php';
$pag = 'ask';
if ($mode == 'new') include 'system/askNew.php';
if ($iid) {
	$gdi = getRecord('ask', "`id` = '$iid' ");
	$gdiLikes = explode(', ', $gdi['likes']);
	$auth = getRecord('members^username,avatar,gender', "id = {$gdi['uid']}");
	$from = getRecord('members^username,avatar,gender', "id = {$gdi['fr_uid']}");
	$checkDid = countRecord('ask_answer', "iid = $iid");
	$gdid = getRecord('ask_answer', "iid = $iid");
	if ($_GET['display']) {
		$dis = $_GET['display'];
		echo '<h3>'.count($gdiLikes).' following people liked this</h3>';
		for ($k = 0; $k < count($gdiLikes); $k++) {
			$ul = $gdiLikes[$k];
			$lp = getRecord('members^username,avatar', "`id` = '$ul' ");
			echo '<div class="one-people"><a href="#!user?u='.$ul.'"><img class="left avatar-circle sm-thum" src="'.$lp['avatar'].'"/> '.$lp['username'].'</a></div>';
		}
	} else if ($_GET['show'] == 'votes') include 'views/askVotes.php';
	else {
		if ($gdi && ($gdi['privacy'] != 'draff' || $gdi['uid'] == $u)) {
			include 'system/askView.php';
			include 'views/askView.php';
		} else echo '<div class="alerts alert-warning">You\'re attempting to access a non-exist promise or this promise\'s owner has set this to private.</div>';
	}
} else {
	$show = $_GET['show'];
	if ($show == 'answered') $condition = "AND `did` = 'yes' ";
	else if ($show == 'unanswered') $condition = "AND `did` != 'no' ";
	$condition = "`uid` = '$u' $condition";
	include 'views/askList.php';
} ?>

<script>$('.page-content').attr('data-p', 'ask')</script>
<script src="<? echo JS ?>/promise.js"></script>
