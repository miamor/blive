<? if ($_GET['do'] == 'addfriend') {
	if (countRecord('friend', "(`uid` = '$u' AND `receive_id` = '$uid') OR (`uid` = '$uid' AND `receive_id` = '$u')") <= 0) {
		$sendRequest = insert('friend', "`uid`, `receive_id`", "'$u', '$uid'");
		if ($sendRequest) sendNoti('friend-request', $u, '', $uid);
	}
} else if ($_GET['do'] == 'acceptfriend') {
	changeValue('friend', "`uid` = '$uid' AND `receive_id` = '$u'", "`accept` = 'yes'");
} else if ($_GET['do'] == 'removefriend') {
	if (countRecord('friend', "(`uid` = '$u' AND `receive_id` = '$uid') OR (`uid` = '$uid' AND `receive_id` = '$u')") > 0) {
		$delete = delete('friend', "(`uid` = '$u' AND `receive_id` = '$uid') OR (`uid` = '$uid' AND `receive_id` = '$u')");
	}
} ?>
