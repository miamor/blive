<? if ($_GET['do'] == 'comment') {
	$cmi = $_GET['cmt'];
	$content = _content($_POST['cmt-content']);
	if ($content == '<p><br></p>') $content = '';
	if ($content) {
//		if (countRecord($tbcmt, "`uid` = '$u' AND `content` = '$content' ") <= 0) {
			if ($cmi) $add = insert($tbcmt, "`uid`, `iid`, `pid`, `content`, `time`", "'$u', '$iid', '$cmi', '$content', '$curint'");
			else $add = insert($tbcmt, "`uid`, `iid`, `content`, `time`", "'$u', '$iid', '$content', '$curint'");
//		}
	}
}
if ($_GET['do'] == 'like') {
	$cmtIn = getRecord($tbcmt.'^id,likes', "`id` = '$cmii' ");
	if ($cmtIn['likes']) $cmtLikesAr = explode(', ', $cmtIn['likes']);
	else $cmtLikesAr = array();
	if (!in_array($u, $cmtLikesAr)) pushToCol($tbcmt, 'id', $cmii, 'likes', $iid);
	else rmFromCol($tbcmt, 'id', $cmii, 'likes', $iid);
} ?>
