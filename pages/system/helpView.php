<? if ($_GET['didit'] == 'submit' && $gdi['uid'] == $u) {
	$didop = $_POST['did-option'];
	$didcontent = _content($_POST['did-content']);
	$lockOption = $_POST['confirm-lock'];
	$numToLock = $_POST['num-to-lock'];
	if ($didop == 'no') $lock = 'yes';
	else $lock = '';
	foreach ($_POST['select-people'] as $per)
		$peopleAr[] = $per;
	foreach ($_POST['select-suborner'] as $subornerOne)
		$subornerAr[] = $subornerOne;
	if ($didop == 'yes') {
		$peopleStr = implode(', ', $peopleAr);
		$subornerStr = implode(', ', $subornerAr);
	} else $peopleStr = $subornerStr = '';
	if ($didop) changeValue('help', "`id` = '$iid'", "`did` = '$didop', `lock` = '$lock' ");
}

if ($_GET['do']) {
	$do = $_GET['do'];
	$encourageAr = explode(', ', $gdi['encourage']);
	$gdlBelieveAr = explode(', ', $gdid['believe']);
	$gdlBelieveNotAr = explode(', ', $gdid['believe_not']);
	$gdlKnowAr = explode(', ', $gdid['know_did']);
	$gdlKnowNotAr = explode(', ', $gdid['know_didnot']);
	$gdlLikesAr = explode(', ', $gdi['likes']);
	if ($do == 'help') {
		activityAdd('new-request', $iid);
		sendNoti('help-your-request', $iid, '', $rH['uid']);
	}
	if ($do == 'public') {
		changeValue('help', "`id` = '$iid' ", "`privacy` = 'public' ");
		changeValue('activity', "`type` = 'new-request' AND `iid` = '$iid' ", "`privacy` = 'public' ");
	} else if ($do == 'draff') {
		changeValue('help', "`id` = '$iid' ", "`privacy` = 'draff' ");
		changeValue('activity', "`type` = 'new-request' AND `iid` = '$iid' ", "`privacy` = 'draff' ");
	}
	if ($do == 'lock') {
		if ($gdid['believe']) $pBelieve = count(explode(', ', $gdid['believe']));
		else $pBelieve = 0;
		if ($gdid['believe_not']) $pBelieveNot = count(explode(', ', $gdid['believe_not']));
		else $pBelieveNot = 0;
		if ($gdid['know']) $pKnow = count(explode(', ', $gdid['know']));
		else $pKnow = 0;
		if ($gdid['know_not']) $pKnowNot = count(explode(', ', $gdid['know_not']));
		else $pKnowNot = 0;
		changeValue('promise', "`id` = '$iid' ", "`lock` = 'yes', `believe_lock` = '$pBelieve', `believe_not_lock` = '$pBelieveNot', `know_lock` = '$pKnow', `know_not_lock` = '$pKnowNot' ");
	}
} ?>
