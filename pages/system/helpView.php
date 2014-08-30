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
					echo '<!--[type][success] [content][Your form has been sent. Thanks for your support!]-->';
				} else echo '<!--[type][error] [content][Oops! Something went wrong. Please contact the administrators for help.]-->';
			} else echo '<!--[type][error] [content][You\'ve already sent a request of help.]-->';
		} else echo '<!--[type][error] [content][Please fill in your form.]-->';
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
} ?>
