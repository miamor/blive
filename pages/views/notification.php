<? foreach ($notiList as $notiList) {
	$sendInfo = getRecord("members^username,avatar", "`id` = '{$notiList['uid']}'") ?>
	<li class="<?php if ($notiList['read'] != 'read') echo 'unread' ?>"><div class="dropdown-noti">
<? if ($notiList['type'] == 'like-my-stt' || $notiList['type'] == 'likes-activity') {
	$imgnoti = silk.'/thumb_up.png';
	$quoteStt = getRecord('activity^id,content,type,uid,to_uid', "`id` = '{$notiList['i']}'");
	if ($quoteStt['type'] == 'photo') $quo = '<a class="fanbox" href="'.$quoteStt['img_url'].'">photo</a>';
	else if ($quoteStt['type'] == 'stt') $quo = '<a href="#!feed?i='.$notiList['i'].'">status</a>';
	else $quo = '<a href="#!feed?i='.$notiList['i'].'">action</a>';
	$quote = tag($quoteStt['content']) ?>
			<img class="absolute-left-content img-circle" src="<? echo $sendInfo['avatar'] ?>"/>
			<?php if (check($quoteStt['type'], 'photo') >0) echo '<img class="absolute-right-content img-circle" src="'.$quoteStt['img_url'].'"/>' ?>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			liked
		<? if ($quoteStt['uid'] == $quoteStt['to_uid']) echo 'your '.$quo;
		else if ($quoteStt['uid'] != $quoteStt['to_uid'] && $quoteStt['to_uid'] == $u) {
			$quoteSttToName = getRecord('members^id,username', "`id` = '{$notiList['to_uid']}'");
			echo $quoteSttToName['username'].'\'s '.$quo.' on your wall';
		} else if ($quoteStt['uid'] != $quoteStt['to_uid'] && $quoteStt['uid'] == $u) {
			$quoteSttToName = getRecord('members^id,username', "`id` = '{$notiList['to_uid']}'");
			echo 'your '.$quo.' on '.$quoteSttToName['username'].'\'s wall';
		} ?>
			<? if ($quote) echo ': "<span class="quote-stt">'.$quote.'</span>" ' ?>
<? } else if ($notiList['type'] == 'mention-in-promise') {
	$imgnoti = silk.'/thumb_up.png';
	$quoteStt = getRecord('promise^id,content', "`id` = '{$notiList['i']}'");
	$quote = tag($quoteStt['content']) ?>
			<img class="absolute-left-content img-circle" src="<? echo $sendInfo['avatar'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			<b>mentioned</b> you in <? if ($sendInfo['gender'] == 'male') echo 'his'; else echo 'her' ?>
			<strong><a href="#!promise?i=<? echo $notiList['i'] ?>">promise</a></strong>
			<? echo ': "<span class="quote-stt">'.$quote.'</span>" ' ?>
<? } else if ($notiList['type'] == 'mention-in-post') {
	$imgnoti = silk.'/thumb_up.png';
	$quoteStt = getRecord('feed^id,content', "`id` = '{$notiList['i']}'");
	$quote = tag($quoteStt['content']) ?>
			<img class="absolute-left-content img-circle" src="<? echo $sendInfo['avatar'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			<b>mentioned</b> you in <? if ($sendInfo['gender'] == 'male') echo 'his'; else echo 'her' ?>
			<strong><a href="#!feed?i=<? echo $notiList['i'] ?>">post</a></strong>
			<? echo ': "<span class="quote-stt">'.$quote.'</span>" ' ?>
<? } else if ($notiList['type'] == 'to-create-promise') {
	$imgnoti = silk.'/thumb_up.png';
	$quoteStt = getRecord('promise^id,content', "`id` = '{$notiList['i']}'");
	$quote = tag($quoteStt['content']) ?>
			<img class="absolute-left-content img-circle" src="<? echo $sendInfo['avatar'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			<b>asked</b> you to create new promise (from <strong><a href="#!promise?i=<? echo $notiList['i'] ?>">this</a></strong>)
			<? echo ': "<span class="quote-stt">'.$quote.'</span>" ' ?>
<? } else if ($notiList['type'] == 'encourage-promise') {
	$imgnoti = silk.'/thumb_up.png';
	$quoteStt = getRecord('promise^id,content', "`id` = '{$notiList['i']}'");
	$quote = tag($quoteStt['content']) ?>
			<img class="absolute-left-content img-circle" src="<? echo $sendInfo['avatar'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			<b>encouraged</b> you in your
			<strong><a href="#!promise?i=<? echo $notiList['i'] ?>">words</a></strong>
			<? echo ': "<span class="quote-stt">'.$quote.'</span>" ' ?>
<? } else if ($notiList['type'] == 'know_did-promise_did') {
	$imgnoti = silk.'/thumb_up.png';
	$quoteStt = getRecord('promise^id,content', "`id` = '{$notiList['i']}'");
	$quote = tag($quoteStt['content']) ?>
			<img class="absolute-left-content img-circle" src="<? echo $sendInfo['avatar'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>"><?php echo $sendInfo['username'] ?></a>
			<b>confirmed TRUE</b> for your <strong><a href="#!promise?i=<? echo $notiList['i'] ?>">words</a></strong>
			<? echo ': "<span class="quote-stt">'.$quote.'</span>" ' ?>
<? } else if ($notiList['type'] == 'likes-promise') {
	$imgnoti = silk.'/thumb_up.png';
	$quoteStt = getRecord('promise^id,content', "`id` = '{$notiList['i']}'");
	$quote = tag($quoteStt['content']) ?>
			<img class="absolute-left-content img-circle" src="<? echo $sendInfo['avatar'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<? echo $sendInfo['username'] ?>
			</a>
			<b>encouraged</b> you in your
			<strong><a href="#!promise?i=<? echo $notiList['i'] ?>">words</a></strong>
			<? echo ': "<span class="quote-stt">'.$quote.'</span>" ' ?>
<? } else if ($notiList['type'] == 'likes-promise_cmt') {
	$imgnoti = silk.'/thumb_up.png';
	$quoteStt = getRecord('promise^id,content', "`id` = '{$notiList['i']}'");
	$quote = tag($quoteStt['content']) ?>
			<img class="absolute-left-content img-circle" src="<? echo $sendInfo['avatar'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			<b>encouraged</b> you in your
			<strong><a href="#!promise?i=<? echo $notiList['i'] ?>">words</a></strong>
			<? echo ': "<span class="quote-stt">'.$quote.'</span>" ' ?>
<? } else if ($notiList['type'] == 'suborner') {
	$imgnoti = silk.'/thumb_up.png';
	$quoteStt = getRecord('promise^id,content', "`id` = '{$notiList['i']}'");
	$quote = tag($quoteStt['content']) ?>
			<img class="absolute-left-content img-circle" src="<? echo $sendInfo['avatar'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			<b>asked</b> you to confirm their
			<strong><a href="#!promise?i=<? echo $notiList['i'] ?>">words</a></strong>
			<? echo ': "<span class="quote-stt">'.$quote.'</span>" ' ?>
<? } ?>
	</li>
<? } ?>
