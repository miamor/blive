<? 	$pInfo = $l = getRecord('activity', "`id` = '$id'");
	$laymem = getRecord('members', "`id` = '{$pInfo['uid']}'");
	$up_name = $mnamem = $laymem['username'];
	$avat = $laymem['avatar'];
	$laymm = getRecord('members', "`id` = '{$pInfo['to_uid']}'");
	$to_name = $laymm['username'];
	$content = $pInfo['content'];
	$img_url = $pInfo['img_url'];
	if ($l['type'] == 'new-promise') $gdi = getRecord('promise', "`id` = '{$l['iid']}' "); ?>
	
	<!-- <? if ($l['type'] == 'new-promise') echo tag($gdi['content']);
	else if ($l['type'] == 'photo' && strlen($l['content']) <= 0) echo 'Photo';
	else if ($l['content']) echo tag($l['content']);
	else echo 'Community' ?> -->
	
	<div class='statu stat one the-box box-feed the<? echo $id ?>' data-p="feed" id='<?php echo $id ?>'>
		<div id='option'></div>
	<?php if ($pInfo['uid'] != $pInfo['to_uid']) {
			echo "<a class='fol_thum' href='#!user?u={$pInfo['uid']}'>
					<img src='$avat' class='thumbnai'/>
					<div class='bold'>$up_name</div>
				</a>
				<a href='#!user?u={$pInfo['uid']}'><b>{$up_name}</b></a>
				<i class='img to'></i>
				<a href='#!user?u={$pInfo['to_uid']}'><b>{$to_name}</b></a>";
		} else echo "<a class='fol_thum' href='#!user?u={$pInfo['uid']}'><img src='$avat' class='thumbnai'/><div class='bold'>$up_name</div></a>";
	if ($l['type'] != 'stt') {
		echo '<a href="#!user?u='.$up_id.'"><b>'.$up_name.'</b></a> ';
		if ($l['type'] == 'photo' && strlen($l['content']) <= 0) echo '<span class="small">added a photo</span>';
		else if ($l['type'] == 'new-promise') {
			echo '<span class="small">added a <a href="#!promise?i='.$gdi['id'].'">promise</a></span>';
			echo '<div class="one-good-feed the'.$gdi['id'].'" id="'.$gdi['id'].'">';
			if ($gdi['coin']) echo '<div class="left gensmall" title="Extra coins for solving this problem"><img style="height:14px;margin:-3px 1px 0 0" src="'.silk.'/coins_add.png"/>'.$gdi['coin'].' </div>';
			echo '<div class="one-good-content">'.tag($gdi['content']).'</div>
				<div class="one-good-info" style="margin-bottom:5px">';
				bButton($gdi['id']);
			echo '<div class="clearfix"></div>
			</div>
			</div>';
		}
	}
	if ($content) echo '<div class="content stt">'.tag($content).'</div>';
	if ($img_url != null && (strlen(strstr($img_url, '.')) > 0)) echo '<div class="line-break"></div> <img src="'.$img_url.'"/>';
	if ($l['type'] == 'new-promise') toolPost('promise', $gdi['id']);
	else toolPost('activity', $l['id']);
	echo '<div class="static-post">';
		if ($l['type'] == 'new-promise') likeStatic('promise', $gdi['id']);
		else likeStatic('activity', $l['id']);
	echo '</div>';
	echo '<div class="cmts-post">';
		if ($l['type'] == 'new-promise') cmtListPost('promise', $gdi['id']);
		else cmtListPost('activity', $l['id']);
	echo '</div>';
	if ($l['type'] == 'new-promise') cmtFormPost('promise', $gdi['id']);
	else cmtFormPost('activity', $l['id']);
?>
	</div>


<div class="hide small-board-fixed"></div>
<div class="hide small-board sb-stt-likelist"></div>
