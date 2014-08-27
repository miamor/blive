<? $tbcmt = 'activity_cmt';
// include 'system/comment.php';
if ( $_GET['do'] == "submitstt" ) {
	$content = _content($_POST['status']);
	$title = _content($_POST['title']);
	$decodeName = $_FILES['img']['name'];
	$ext = end(explode(".", strtolower(basename($decodeName))));
	$nameF = explode('.', $decodeName);
	if (strlen($decodeName) != strlen(utf8_decode($decodeName))) $nameFile = md5($nameF[0]).'.'.$ext;
	else $nameFile = $decodeName;
	$up = move_uploaded_file($_FILES['img']['tmp_name'], MAIN_PATH."/data/img/".$nameFile);
	$url = "data/img/".$nameFile;
	$privacy = $_POST['privacy'];
	if (!$privacy) $privacy = 'public';
//	echo $_FILES['img']['tmp_name'].'~~~~~~'.$nameFile;
//	if ($up) echo 'done';
//	else echo 'error';
	if ($content == '<p><br></p>') $content = '';
	if ($up) mysql_query("insert into `activity` (`type`, `privacy`, `img_url`, `uid`, `to_uid`, `content`, `time`) values ('photo', '$privacy', '$url', '$u', '$u', '$content', '$curint')");
	else if ($content) mysql_query("insert into `activity` (`type`, `privacy`, `privacy`, `uid`, `to_uid`, `content`, `time`) values ('stt', '$privacy', '$u', '$u', '$content', '$curint')");
}

if ($_GET['do']) {
//		$p = $_GET['p'];
		$pS = mysql_fetch_array(mysql_query("SELECT * FROM `activity` WHERE `id` = '$id'"));
		$upi = $pS['uid'];
		$upnn = getRecord('members', "`id` = '$upi'");
		$upn = $upnn['username'];
		$toi = $pS['to_uid'];
		$tonn = getRecord('members', "`id` = '$toi'");
		$ton = $tonn['username'];
/*	if ( $_GET['do'] == "cmt" ) {
		$cmtcon = _content($_POST['cmt-stt-'.$id]);
		if ($cmtcon && $cmtcon != '<p><br></p>') insert('activity', "`uid`, `type`, `iid`, `content`, `time`", "'$u', 'cmt', '$id', '$cmtcon', '$curint' ");
	}
*/	if ($_GET['do'] == "like" && !$cmii) {
		if ($pS['type'] == 'new-promise') {
			$gdi = getRecord('promise^id,likes', "`id` = '{$pS['iid']}'");
			$likeAr = explode(', ', $gdi['likes']);
			if (!in_array($u, $likeAr)) pushToCol('promise', 'id', $gdi['id'], 'likes');
			else rmFromCol('promise', 'id', $gdi['id'], 'likes');
		}
		if ( countRecord('activity', "`iid` = '$id' AND `type` = 'like' AND `uid` = '$u'") <= 0 ) {
			$inlike = insert('activity', "`uid`, `type`, `iid`, `time`", "'$u', 'like', '$id', '$curint' ");
			pushToCol('activity', 'id', $id, 'likes');
/*			if ($upi != $u) {
				if ($upi != $toi) sendNoti('like-wall-stt', $id, '', $upi);
				else $innos = sendNoti('like-my-stt', $id, '', $upi);
			}
*/		} else {
			$unlike = mysql_query("DELETE FROM `activity` WHERE `iid` = '$id' AND `type` = 'like' AND `uid` = '$u'");
			rmFromCol('activity', 'id', $id, 'likes');
/*			if ($upi != $u) {
				if ($upi != $toi) removeNoti('like-wall-stt', $id, '', $upi);
				else $innos = removeNoti('like-my-stt', $id, '', $upi);
			}
*/		}
	}
}
?>
