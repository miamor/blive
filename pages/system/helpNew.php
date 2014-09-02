<? $pContent = _content($_POST['p-status']);
$pPrivacy = $_POST['p-privacy'];
$pType = $_POST['p-type'];
$pTags = str_replace(',', ', ', $_POST['tags']);
if ($pContent == '<p><br></p>') $pContent = '';
if (countRecord('help', "`uid` = '$u' AND `content` = '$pContent' ") <= 0) {
	if (countRecord('help', "`uid` = '$u' AND `content` = '$pContent' ") <= 0) {
		$add = insert('help', "`uid`, `type`, `content`, `privacy`, `tags`, `time`", " '$u', '$pType', '$pContent', '$pPrivacy', '$pTags', '$curint' ");
		if ($add) {
			$newPromise = getRecord('help^id,type,uid,content', "`uid` = '$u' AND `type` = '$pType' AND `content` = '$pContent' ");
			$content = str_replace(array('&nbsp;', '@'), array(' ', '+'), _content($pContent));
			$memTagAr = explode('+', $content);
			for ($j = 1; $j <= count($memTagAr); $j++) {
				$thisMem = explode(' ', $memTagAr[$j]);
				$thisMem = $thisMem[0];
				$thisMemIn = getRecord('members^id,username', "`username` = '$thisMem' ");
				$thisMemU = $thisMemIn['id'];
				if ($thisMemU != $u && in_array($thisMemU, $frAr)) sendNoti('mention-in-request', $newPromise['id'], '', $thisMemU);
			}
			insert('activity', "`privacy`, `uid`, `to_uid`, `type`, `iid`, `time`", "'$pPrivacy', '$u', '$u', 'new-request', '{$newPromise['id']}', '$curint'");
		}
	}
} ?>
