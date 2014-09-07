<!-- Keep your words -->

<div class='m_mainn'>

<div id='test'></div>

<div class="hide small-board-fixed"></div>
<div class="hide small-board sb-stt-likelist"></div>

<? $ui = $member['id'] ?>

<div class='following'>

	<div class='statuss'>
<? if ($_GET['note'] == 'undividepage') $feedList = $getRecord -> GET('activity', $cond, '', 'time DESC, id DESC');
else $feedList = $getRecord -> GET('activity', $cond, '^5', 'time DESC, id DESC');

foreach ($feedList as $l) {
	$lid = $l['id'];
	$up_id = $l['uid'];
	$to_id = $l['to_uid'];
	$laymem = getRecord('members^username,avatar', "`id`='$up_id'");
	$up_name = $mnamem = $laymem['username'];
	$avat = $laymem['avatar'];
	$laymm = getRecord('members^username', "`id`='$to_id'");
	$to_name = $laymm['username'];
	if ($l['type'] == 'become-friend') echo '<div class="statu long-line"><a class="fol_thum" href="#!user?u='.$up_id.'"><img src="'.$avat.'" class="thumbnai"/> <b>'.$up_name.'</b></a> and 
		<a class="m-type '.$laymem['group'].'" href="#!user?u='.$to_id.'"><b>'.$to_name.'</b></a> became friends.</div>';
	else {
		$content = nl2br($l['content']);
		$thoigian = timeFormat($l['time']);
		$img_url = explode(', ', $l['img_url']);
		echo '<div class="statu the-box box-feed the'.$lid.'" data-p="feed" id="'.$lid.'">';
		if ($l['uid'] == $u) echo '<div class="me-marked"></div>';
		echo "<div id='option'></div>";
		if ($up_id != $to_id) {
			echo "<a class='fol_thum' href='#!user?u=$up_id'>
					<img src='$avat' class='thumbnai thumbs'/>
					<div class='bold'>$up_name</div>
				</a>
				<a href='#!user?u=$up_id'><b>$up_name</b></a>
				<i class='img to'></i>
				<a class='m-type ".$laymem['group']."' href='#!user?u=$to_id'><b>$to_name</b></a>";
		} else echo "<a class='fol_thum' href='#!user?u=$up_id'><img src='$avat' class='thumbnai thumbs'/>
				<div class='bold'>$up_name</div></a>";
		$sm = '<a href="#!user?u='.$up_id.'"><b>'.$up_name.'</b></a> ';
		if ($l['type'] == 'photo' /*&& strlen($l['content']) <= 0*/) {
			if (count($img_url) > 1) echo $sm.'<span class="small">added <a href="#!feed?i='.$l['id'].'">'.count($img_url).' photos</a></span>';
			else echo $sm.'<span class="small">added a <a href="#!feed?i='.$l['id'].'">photo</a></span>';
		} else if ($l['type'] == 'new-promise') {
			$gdi = getRecord('promise', "`id` = '{$l['iid']}' ");
			echo $sm ?>
				<span class="small">added a <a href="#!promise?i=<? echo $gdi['id'] ?>">promise</a></span>
				<? if ($gdi['money']) {
						if ($gdi['lock'] != 'yes') echo '<span class="label label-info label-money" title="Money bet">'.$gdi['money'].'</span>';
						else if ($gdi['did'] == 'yes' && $gdi['true'] == 'true') echo '<span class="label label-success label-money" title="Added to account">+'.$gdi['money'].'</span>';
						else echo '<span class="label label-danger label-money" title="Sucstract from account">-'.$gdi['money'].'</span>';
					} ?>
					<div id="<? echo $gdi['id'] ?>" class="one-good-feed <? if ($gdi['did'] == 'yes' && $gdi['lock'] =='yes') echo 'the-lock'; else if ($gdi['did'] == 'yes' && $gdi['lock'] == 'lie') echo 'the-lie'; else if ($gdi['did'] == 'yes') echo 'the-did'; else if ($gdi['did'] == 'no') echo 'the-fail' ?> the<? echo $gdi['id'] ?> <? if ($gdi['did'] == 'yes') echo 'did-it'; else if ($gdi['did'] == 'no') echo 'fail-it' ?>" data-p="promise">
						<div class="one-good-main">
							<div class="one-good-content"><? echo tag($gdi['content']) ?></div>
							<div class="one-good-info">
								<div class="one-good-buttons">
									<? bButton($gdi['id']) ?>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
<?		} else if ($l['type'] == 'new-request') {
			$gdi = getRecord('help', "`id` = '{$l['iid']}' ");
			if ($gdi['type'] != 'do') {
				if ($gdi['iid']) $gdip = getRecord('help^id,uid,content', "`id` = '{$gdi['iid']}' ");
				$gdipAu = getRecord('members', "`id` = '{$gdip['uid']}' ");
				echo $sm ?>
				<span class="small">
				<? if (!$gdi['iid']) {
					if ($gdi['type'] == 'need') echo 'needed a <a href="#!request?i='.$gdi['id'].'">help</a>';
					else if ($gdi['type'] == 'add') echo 'added a <a href="#!request?i='.$gdi['id'].'">favor</a>';
					else if ($gdi['type'] == 'do') echo 'did a <a href="#!request?i='.$gdi['id'].'">favor</a>';
				} else {
					if ($gdi['type'] == 'need') echo 'needed a <a href="#!request?i='.$gdip['id'].'">help</a>';
					else if ($gdi['type'] == 'add') echo 'added a <a href="#!request?i='.$gdip['id'].'">favor</a>';
					else if ($gdi['type'] == 'do') echo 'did a <a href="#!request?i='.$gdip['id'].'">favor</a>';
					echo ' like <a href="#!user?u='.$gdip['uid'].'">'.$gdipAu['username'].'</a>';
				} ?>
				</span>
				<div id="<? echo $gdi['id'] ?>" class="one-good-feed the-<? echo $gdi['type'] ?> <? if ($gdi['did'] == 'yes' && $gdi['lock'] =='yes') echo 'the-lock'; else if ($gdi['did'] == 'yes' && $gdi['lock'] == 'lie') echo 'the-lie'; else if ($gdi['did'] == 'yes') echo 'the-did'; else if ($gdi['did'] == 'no') echo 'the-fail' ?> the<? echo $gdi['id'] ?> <? if ($gdi['did'] == 'yes') echo 'did-it'; else if ($gdi['did'] == 'no') echo 'fail-it' ?>" data-p="request">
					<div class="one-good-main">
						<? if ($gdi['iid']) { ?>
							<div class="one-good-content"><? echo tag($gdip['content']) ?></div>
						<? } else { ?>
							<div class="one-good-content"><? echo tag($gdi['content']) ?></div>
						<? } ?>
					</div>
					<div class="one-good-info tags-small">
						<? echo tagsList($gdi['tags']) ?>
					</div>
				</div>
<?			}
		}
		if ($content) echo '<div class="content stt">'.tag($content).'</div>';
		if ($l['thumb-link']) { ?>
			<div class="link-thumbbox">
				<div class="thumbbox"><a href="<? echo $l['thumb-link'] ?>">
					<? if ($l['thumb-link-img']) echo '<div class="left thumb-photo"><img src="'.$l['thumb-link-img'].'"/></div>' ?>
					<div class="thumb-title"><? echo $l['thumb-link-title'] ?></div>
					<div class="thumb-link"><? echo $l['thumb-link'] ?></div>
					<div class="thumb-content"><? echo $l['thumb-link-content'] ?></div>
				</a></div>
			</div>
<?		}
		if ($l['img_url'] != null && (strlen(strstr($l['img_url'], '.')) > 0)) {
			echo '<div class="line-break"></div>';
			if (count($img_url) > 1) {
				$maxImg = count($img_url);
				if ($maxImg >= 5) $maxImg = 5;
				echo '<div class="img-groups group-'.$maxImg.'-img">';
				for ($i = 0; $i < $maxImg; $i++) 
					if ($img_url[$i]) echo '<div class="img_preview"><a href="#!feed?i='.$l['id'].'"><img src="'.$img_url[$i].'"/></a></div>';
				echo '</div><div class="clearfix"></div>';
			} else echo '<div class="img_preview"><a href="#!feed?i='.$l['id'].'"><img src="'.$l['img_url'].'"/></a></div>';
		}

	if (!$gdi['iid']) {
		echo '<div class="normal-stt-tool">';
			if ($l['type'] == 'new-promise') toolPost('promise', $gdi['id']);
			else if ($l['type'] == 'new-request') toolPost('help', $gdi['id']);
			else toolPost('activity', $lid);
			echo '<div class="static-post">';
				if ($l['type'] == 'new-promise') likeStatic('promise', $gdi['id']);
				else if ($l['type'] == 'new-request') likeStatic('help', $gdi['id']);
				else likeStatic('activity', $lid);
			echo '</div>';
			echo '<div class="cmts-post">';
				if ($l['type'] == 'new-promise') cmtListPost('promise', $gdi['id'], 4);
				else if ($l['type'] == 'new-request') cmtListPost('help', $gdi['id']);
				else cmtListPost('activity', $lid, 4);
			echo '</div>';
			if ($l['type'] == 'new-promise') cmtFormPost('promise', $gdi['id']);
			else cmtFormPost('activity', $lid);
	//		echo "</div>";
		echo '</div>';
	}
	echo '</div>';
	}
} ?>
	</div>
	<div id="more"></div>
</div>

</div>

