<? $pContent = _content($_POST['p-status']);
$pMoney = $_POST['p-money'];
$pMoneyType = $_POST['p-money-type'];
$pPrivacy = $_POST['p-privacy'];
$link = $_POST['thumb-link'];
$link_img = $_POST['thumb-link-img'];
$link_title = $_POST['thumb-link-title'];
$link_content = $_POST['thumb-link-content'];
$postToFb = $_POST['post-to-fb'];
if ($pContent == '<p><br></p>') $pContent = '';
if ($pContent && countRecord('promise', "`uid` = '$u' AND `content` = '$pContent' ") <= 0) {
	if (countRecord('promise', "`uid` = '$u' AND `content` = '$pContent' ") <= 0) {
		$add = insert('promise', "`uid`, `content`, `money`, `money-type`, `privacy`, `time`", " '$u', '$pContent', '$pMoney', '$pMoneyType', '$pPrivacy', '$curint' ");
		if ($add) {
			subtractCoin($u, $pMoney);
			addBet($u, $pMoney);
			$newPromise = getRecord('promise^id,uid,content', "`uid` = '$u' AND `content` = '$pContent' ");
			$content = str_replace(array('&nbsp;', '@'), array(' ', '+'), _content($pContent));
			$memTagAr = explode('+', $content);
			for ($j = 1; $j <= count($memTagAr); $j++) {
				$thisMem = explode(' ', $memTagAr[$j]);
				$thisMem = $thisMem[0];
				$thisMemIn = getRecord('members^id,username', "`username` = '$thisMem' ");
				$thisMemU = $thisMemIn['id'];
				if ($thisMemU != $u && in_array($thisMemU, $frAr)) sendNoti('mention-in-promise', $newPromise['id'], '', $thisMemU);
			}
//			if ($pPrivacy != 'draff') 
			insert('activity', "`privacy`, `uid`, `to_uid`, `type`, `iid`, `thumb-link`, `thumb-link-img`, `thumb-link-title`, `thumb-link-content`, `time`", " '{$pPrivacy}', '{$u}', '{$u}', 'new-promise', '{$newPromise['id']}', '$link', '$link_img', '$link_title', '$link_content', '{$curint}' ");
			if ($member['token'] && $postToFb) {
				$pageTO = 'promise';
				include 'system/postToFb.php';
			}
		}
	}
} ?>
