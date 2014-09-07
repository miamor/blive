<? include '../lib/config.php';
$pag = 'help';
if ($mode == 'new') include 'system/helpNew.php';
if ($iid) {
	echo '<!--{board}-->';
	$gdi = getRecord('help', "`id` = '$iid' ");
	echo '<!-- '.$gdi['content'].' -->';
	$gdiLikes = explode(', ', $gdi['likes']);
	$auth = getRecord('members^username,avatar,gender', "id = {$gdi['uid']}");
	$checkDid = countRecord('help', "`type` = 'do' AND `iid` = '$iid' ");
	$checkMyDid = countRecord('help', "`type` = 'do' AND `uid` = '$u' AND `iid` = '$iid' ");
	$gdid = $getRecord -> GET('help', "`type` = 'do' AND `iid` = '$iid' ");
	$searchWithTags = '';
	if ($gdi['tags']) {
		$tagAr = explode(', ', $gdi['tags']);
		foreach ($tagAr as $tagOne) $searchWithTags .= "`tags` LIKE '%".$tagOne."%' OR ";
		$searchWithTags = substr($searchWithTags, 0, -4);
		if ($gdi['type'] == 'need') $searchType = 'add';
		else $searchType = 'need';
		$related = $getRecord -> GET('help', "`type` = '$searchType' AND ($searchWithTags)");
	}
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
	} else if ($_GET['show'] == 'votes') include 'views/helpVotes.php';
	else {
		if ($gdi && $gdi['type'] != 'do' && ($gdi['privacy'] != 'draff' || $gdi['uid'] == $u)) {
			$gdlHelpfulAr = explode(', ', $gdi['helpful']);
			$gdlHelpfulNotAr = explode(', ', $gdi['helpful_not']);
			$gdlSameAr = explode(', ', $gdi['same']);
			$pAr = explode(', ', $gdid['people']);
			$sAr = explode(', ', $gdid['suborner']);
			include 'system/helpView.php';
			include 'views/helpView.php';
		} else echo '<div class="alerts alert-warning">You\'re attempting to access a non-exist request or this promise\'s owner has set this to private.</div>';
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

<script>$('.page-content').attr('data-p', 'request')</script>
<? if (!$iid) { ?>
<style>.box-feed{padding:15px 20px 10px;margin:10px 0 20px 15px;background:#fff;border:1px solid #f1f1f1;box-shadow:inset 0 0 10px #f8f8f8;border-radius:3px;clear:both;position:relative}</style>
<? } ?>
