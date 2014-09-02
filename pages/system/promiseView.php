<? if ($_GET['didit'] == 'submit' && $gdi['uid'] == $u) {
	$didop = $_POST['did-option'];
	$didcontent = _content($_POST['did-content']);
	$lockOption = $_POST['confirm-lock'];
	$numToLock = $_POST['num-to-lock'];
	if ($didop == 'no') $lock = 'yes';
	else $lock = '';
/*	foreach ($_POST['select-people'] as $per)
		$peopleAr[] = $per;
*/	foreach ($_POST['select-suborner'] as $subornerOne)
		$subornerAr[] = $subornerOne;
	if ($didop == 'yes') {
		$peopleStr = implode(', ', $peopleAr);
		$subornerStr = implode(', ', $subornerAr);
	} else $peopleStr = $subornerStr = '';
	if ($didop) {
		changeValue('promise', "`id` = '$iid'", "`did` = '$didop', `lock` = '$lock' ");
//		$add = insert('promise_did', "`uid`, `iid`, `content`, `people`, `suborner`, `lock_option`, `lock_num`, `time`", "'$u', '$iid', '$didcontent', '$peopleStr', '$subornerStr', '$lockOption', '$numToLock', '$curint'");
		$add = insert('promise_did', "`uid`, `iid`, `content`, `suborner`, `lock_option`, `lock_num`, `time`", "'$u', '$iid', '$didcontent', '$subornerStr', '$lockOption', '$numToLock', '$curint'");
		if ($add) {
			foreach ($_POST['select-suborner'] as $up)
				sendNoti('suborner', $iid, '', $up);
/*			foreach ($_POST['select-people'] as $up)
				sendNoti('to-create-promise', $iid, '', $up);
*/		}
	}
}

if ($_GET['do']) {
	$do = $_GET['do'];
	if ($do == 'public') {
		changeValue('promise', "`id` = '$iid' ", "`privacy` = 'public' ");
		changeValue('activity', "`type` = 'new-promise' AND `iid` = '$iid' ", "`privacy` = 'public' ");
	} else if ($do == 'draff') {
		changeValue('promise', "`id` = '$iid' ", "`privacy` = 'draff' ");
		changeValue('activity', "`type` = 'new-promise' AND `iid` = '$iid' ", "`privacy` = 'draff' ");
	}
	if ($do == 'encourage') {
		if (!in_array($u, $encourageAr)) pushToCol('promise', 'id', $iid, 'encourage');
		else rmFromCol('promise', 'id', $iid, 'encourage');
	} else if ($do == 'believe') {
		if (!in_array($u, $gdlBelieveAr)) pushToCol('promise_did', 'iid', $iid, 'believe');
		else rmFromCol('promise_did', 'iid', $iid, 'believe');
	} else if ($do == 'believe-not') {
		if (!in_array($u, $gdlBelieveNotAr)) pushToCol('promise_did', 'iid', $iid, 'believe_not');
		else rmFromCol('promise_did', 'iid', $iid, 'believe_not');
	} else if ($do == 'know') {
		if (!in_array($u, $gdlKnowAr)) pushToCol('promise_did', 'iid', $iid, 'know_did');
		else rmFromCol('promise_did', 'iid', $iid, 'know_did');
	} else if ($do == 'know-not') {
		if (!in_array($u, $gdlKnowNotAr)) pushToCol('promise_did', 'iid', $iid, 'know_didnot');
		else rmFromCol('promise_did', 'iid', $iid, 'know_didnot');
	} else if ($do == 'like') {
		if (!$cmii) {
			if (!in_array($u, $gdlLikesAr)) pushToCol('promise', 'id', $iid, 'likes');
			else rmFromCol('promise', 'id', $iid, 'likes');
		}
	} else if ($do == 'lock') {
		if ($gdid['believe']) $pBelieve = count(explode(', ', $gdid['believe']));
		else $pBelieve = 0;
		if ($gdid['believe_not']) $pBelieveNot = count(explode(', ', $gdid['believe_not']));
		else $pBelieveNot = 0;
		if ($gdid['know']) $pKnow = count(explode(', ', $gdid['know_did']));
		else $pKnow = 0;
		if ($gdid['know_not']) $pKnowNot = count(explode(', ', $gdid['know_didnot']));
		else $pKnowNot = 0;
		changeValue('promise', "`id` = '$iid' ", "`lock` = 'yes', `believe_lock` = '$pBelieve', `believe_not_lock` = '$pBelieveNot', `know_lock` = '$pKnow', `know_not_lock` = '$pKnowNot' ");
//		changeValue('promise', "`id` = '$iid' ", "`lock` = 'yes', `believe_lock` = '{$gdid['believe']}', `believe_not_lock` = '{$gdid['believe_not']}', `know_lock` = '{$gdid['know_did']}', `know_not_lock` = '{$gdid['know_didnot']}' ");
		if (count($compare) <= $reqr) changeValue('promise', "`id` = '$iid' ", "`true` = 'true' ");
		else changeValue('promise', "`id` = '$iid' ", "`true` = 'false' ");
	} else if ($do == 'submitlist') {
		foreach ($_POST['select-people'] as $per)
			$peopleAr[] = $per;
		$peopleStr = implode(', ', $peopleAr);
		if ($gdi['lock'] == 'yes' && $gdi['did'] == 'yes' && $gdid['true'] == 'true') changeValue('promise', "`id` = '$iid' ", "`people` = '$peopleStr' ");
	}
} ?>
