<? if ($_GET['do']) {
	$do = $_GET['do'];
	$gdlLikesAr = explode(', ', $gdi['likes']);
	if ($do == 'help') {
		$hcontent = $_POST['help-content'];
		if ($hcontent) {
			if (countRecord('help', "`type` = 'do' AND `uid` = '$u' AND `iid` = '$iid' ") <= 0) {
				$dohelp = insert('help', "`type`, `content`, `iid`, `uid`, `time`", "'do', '$hcontent', '$iid', '$u', '$curint' ");
				if ($dohelp) {
					$new = getRecord('help', "`type` = 'do' AND `uid` = '$u' AND `iid` = '$iid' ");
					activityAdd('new-request', $new['id']);
					sendNoti('help-your-request', $iid, '', $gdi['uid']);
					echo '<!--[type]success[/type] [content] Your form has been sent. Thanks for your support! [/content]-->';
				} else echo '<!--[type]error[/type] [content] Oops! Something went wrong. Please contact the administrators for help. [/content]-->';
			} else echo '<!--[type]error[/type] [content] You\'ve already sent a request of help. [/content]-->';
		} else echo '<!--[type]error[/type] [content] Please fill in your form. [/content]-->';
	} else if ($do == 'like') {
		if (!$cmii) {
			if (!in_array($u, $gdlLikesAr)) pushToCol('help', 'id', $iid, 'likes');
			else rmFromCol('help', 'id', $iid, 'likes');
		}
	}
	if ($do == 'public') {
		changeValue('help', "`id` = '$iid' ", "`privacy` = 'public' ");
		changeValue('activity', "`type` = 'new-request' AND `iid` = '$iid' ", "`privacy` = 'public' ");
	} else if ($do == 'draff') {
		changeValue('help', "`id` = '$iid' ", "`privacy` = 'draff' ");
		changeValue('activity', "`type` = 'new-request' AND `iid` = '$iid' ", "`privacy` = 'draff' ");
	}
	if ($do == 'lock' && $gdi['uid'] == $u) {
		changeValue('help', "`id` = '$iid' ", "`lock` = 'yes' ");
	}
	if ($do == 'helpful' && $gdi['uid'] != $u) {
		if (in_array($u, $gdlHelpfulNotAr)) rmFromCol('help', 'id', $iid, 'helpful_not');
		if (!in_array($u, $gdlHelpfulAr)) pushToCol('help', 'id', $iid, 'helpful');
		else rmFromCol('help', 'id', $iid, 'helpful');
	}
	if ($do == 'helpfulnot' && $gdi['uid'] != $u) {
		if (in_array($u, $gdlHelpfulAr)) rmFromCol('help', 'id', $iid, 'helpful');
		if (!in_array($u, $gdlHelpfulNotAr)) pushToCol('help', 'id', $iid, 'helpful_not');
		else rmFromCol('help', 'id', $iid, 'helpful_not');
	}
	if ($do == 'sameproblem' && $gdi['uid'] != $u) {
		if (!in_array($u, $gdlSameAr)) {
			pushToCol('help', 'id', $iid, 'same');
			insert('help', "`type`, `uid`, `iid`", " 'need', '$u', '$iid' ");
		} else {
			rmFromCol('help', 'id', $iid, 'same');
			delete('help', "`type` = 'need' AND `uid` = '$u' AND `iid` = '$iid' ");
		}
	}
	if ($do == 'requestsolved') {
		if ($s) {
			if ($gdi['uid'] == $u) changeValue('help', "`id` = '$iid' ", "`did` = 'yes', `helped_id` = '$s' ");
		}
	}
} ?>
