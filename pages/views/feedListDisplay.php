<!-- Community -->

<div class='m_mainn'>

<div id='test'></div>

<div class="hide small-board-fixed"></div>
<div class="hide small-board sb-stt-likelist"></div>

<? $ui = $member['id'] ?>

<div class='following'>

	<div class='statuss'>
		<?php 
		if ($_GET['note'] == 'undividepage') $l = $getRecord -> GET('activity', $cond, '', 'time DESC, id DESC');
		else $l = $getRecord -> GET('activity', $cond, '^5', 'time DESC, id DESC');

		foreach ($l as $l) {
				$lid = $l['id'];
				$up_id = $l['uid'];
				$to_id = $l['to_uid'];
				$content = nl2br($l['content']);
				$thoigian = timeFormat($l['time']);
				$img_url = $l['img_url'];
				$laymem = getRecord('members', "`id`='$up_id'");
				$up_name = $mnamem = $laymem['username'];
				$avat = $laymem['avatar'];
				$laymm = getRecord('members', "`id`='$to_id'");
				$to_name = $laymm['username'];
			if ($l['uid'] == $u || (countRecord('friend', "(`uid` = '$u' AND `receive_id` = '{$l['uid']}') OR (`receive_id` = '$u' AND `uid` = '{$l['uid']}')") > 0)) {
				if ($l['type'] == 'become-friend') echo '<div class="statu long-line"><a class="fol_thum" href="#!user?u='.$up_id.'"><img src="'.$avat.'" class="thumbnai"/> <b>'.$up_name.'</b></a> and 
					<a class="m-type '.$laymem['group'].'" href="#!user?u='.$to_id.'"><b>'.$to_name.'</b></a> became friends.</div>';
				else {
					echo "<div class='statu the-box box-feed the$lid' data-p='feed' id='$lid'>";
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
						} else {
							echo "<a class='fol_thum' href='#!user?u=$up_id'><img src='$avat' class='thumbnai thumbs'/>
							<div class='bold'>$up_name</div></a>";
							if ($l['type'] != 'stt') {
								$sm = '<a href="#!user?u='.$up_id.'"><b>'.$up_name.'</b></a> ';
								if ($l['type'] == 'photo' && strlen($l['content']) <= 0) echo $sm.'<span class="small">added a photo</span>';
								else if ($l['type'] == 'new-promise') {
									$gdi = getRecord('promise', "`id` = '{$l['iid']}' ");
									echo $sm ?>
									<span class="small">added a <a href="#!promise?i=<? echo $gdi['id'] ?>">promise</a></span>
									<div id="<? echo $gdi['id'] ?>" class="one-good-feed <? if ($gdi['did'] == 'yes' && $gdi['lock'] =='yes') echo 'the-lock'; else if ($gdi['did'] == 'yes' && $gdi['lock'] == 'lie') echo 'the-lie'; else if ($gdi['did'] == 'yes') echo 'the-did'; else if ($gdi['did'] == 'no') echo 'the-fail' ?> the<? echo $gdi['id'] ?> <? if ($gdi['did'] == 'yes') echo 'did-it'; else if ($gdi['did'] == 'no') echo 'fail-it' ?>">
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
<?							 	} else if ($l['type'] == 'new-request') {
									$gdi = getRecord('help', "`id` = '{$l['iid']}' ");
									echo $sm ?>
									<span class="small">
									<? if ($gdi['type'] == 'need') echo 'needed a <a href="#!request?i='.$gdi['id'].'">help</a>';
									else if ($gdi['type'] == 'add') echo 'added a <a href="#!request?i='.$gdi['id'].'">favor</a>';
									else if ($gdi['type'] == 'do') echo 'did a <a href="#!request?i='.$gdi['id'].'">favor</a>' ?>
									</span>
									<div id="<? echo $gdi['id'] ?>" class="one-good-feed <? if ($gdi['did'] == 'yes' && $gdi['lock'] =='yes') echo 'the-lock'; else if ($gdi['did'] == 'yes' && $gdi['lock'] == 'lie') echo 'the-lie'; else if ($gdi['did'] == 'yes') echo 'the-did'; else if ($gdi['did'] == 'no') echo 'the-fail' ?> the<? echo $gdi['id'] ?> <? if ($gdi['did'] == 'yes') echo 'did-it'; else if ($gdi['did'] == 'no') echo 'fail-it' ?>">
										<div class="one-good-main">
											<div class="one-good-content"><? echo tag($gdi['content']) ?></div>
										</div>
									</div>
<?							 	}
							}
						}
						if ($content) echo '<div class="content stt">'.tag($content).'</div>';
						if ($img_url != null && (strlen(strstr($img_url, '.')) > 0)) echo '<div class="line-break"></div> <div class="img_preview"><img src="'.$img_url.'"/></div>';
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
					echo "</div>";
				}
			}
		}

	?>
	</div>
	<div id="more"></div>
</div>

</div>

