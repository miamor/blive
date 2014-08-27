<? if ($_GET['didit'] == 'submit' && $gdi['uid'] == $u) {
	$didop = $_POST['did-option'];
	$didcontent = _content($_POST['did-content']);
	if ($didop == 'yes') {
		$peopleStr = implode(', ', $peopleAr);
		$subornerStr = implode(', ', $subornerAr);
	} else $peopleStr = $subornerStr = '';
	if ($didop) {
		changeValue('ask', "`id` = '$iid'", "`did` = '$didop', `lock` = '$lock' ");
		$add = insert('ask_answer', "`uid`, `iid`, `content`, `time`", "'$u', '$iid', '$didcontent', '$curint'");
	}
}

if ($_GET['do']) {
	$do = $_GET['do'];
	$encourageAr = explode(', ', $gdi['encourage']);
	$gdlBelieveAr = explode(', ', $gdid['believe']);
	$gdlBelieveNotAr = explode(', ', $gdid['believe_not']);
	$gdlKnowAr = explode(', ', $gdid['know_did']);
	$gdlKnowNotAr = explode(', ', $gdid['know_didnot']);
	$gdlLikesAr = explode(', ', $gdi['likes']);
	if ($do == 'public') {
		changeValue('ask', "`id` = '$iid' ", "`privacy` = 'public' ");
		changeValue('activity', "`type` = 'new-promise' AND `iid` = '$iid' ", "`privacy` = 'public' ");
	} else if ($do == 'public') {
		changeValue('ask', "`id` = '$iid' ", "`privacy` = 'draff' ");
		changeValue('activity', "`type` = 'new-promise' AND `iid` = '$iid' ", "`privacy` = 'draff' ");
	}
	if ($do == 'encourage') {
		if (!in_array($u, $encourageAr)) pushToCol('ask', 'id', $iid, 'encourage');
		else rmFromCol('ask', 'id', $iid, 'encourage');
	} else if ($do == 'believe') {
		if (!in_array($u, $gdlBelieveAr)) pushToCol('ask_answer', 'iid', $iid, 'believe');
		else rmFromCol('ask_answer', 'iid', $iid, 'believe');
	} else if ($do == 'believe-not') {
		if (!in_array($u, $gdlBelieveNotAr)) pushToCol('ask_answer', 'iid', $iid, 'believe_not');
		else rmFromCol('ask_answer', 'iid', $iid, 'believe_not');
	} else if ($do == 'know') {
		if (!in_array($u, $gdlKnowAr)) pushToCol('ask_answer', 'iid', $iid, 'know_did');
		else rmFromCol('ask_answer', 'iid', $iid, 'know_did');
	} else if ($do == 'know-not') {
		if (!in_array($u, $gdlKnowNotAr)) pushToCol('ask_answer', 'iid', $iid, 'know_didnot');
		else rmFromCol('ask_answer', 'iid', $iid, 'know_didnot');
	} else if ($do == 'like') {
		if (!$cmii) {
			if (!in_array($u, $gdlLikesAr)) pushToCol('ask', 'id', $iid, 'likes');
			else rmFromCol('ask', 'id', $iid, 'likes');
		}
	} else if ($do == 'lock') {
		if ($gdid['believe']) $pBelieve = count(explode(', ', $gdid['believe']));
		else $pBelieve = 0;
		if ($gdid['believe_not']) $pBelieveNot = count(explode(', ', $gdid['believe_not']));
		else $pBelieveNot = 0;
		if ($gdid['know']) $pKnow = count(explode(', ', $gdid['know']));
		else $pKnow = 0;
		if ($gdid['know_not']) $pKnowNot = count(explode(', ', $gdid['know_not']));
		else $pKnowNot = 0;
		changeValue('ask', "`id` = '$iid' ", "`lock` = 'yes', `believe_lock` = '$pBelieve', `believe_not_lock` = '$pBelieveNot', `know_lock` = '$pKnow', `know_not_lock` = '$pKnowNot' ");
	}
} ?>
