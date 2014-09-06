<? 	$laymem = getRecord('members', "`id` = '{$pInfo['uid']}'");
	$up_name = $mnamem = $laymem['username'];
	$avat = $laymem['avatar'];
	$laymm = getRecord('members', "`id` = '{$pInfo['to_uid']}'");
	$to_name = $laymm['username'];
	$content = $pInfo['content'];
	if ($pInfo['img_url']) $img_url = explode(', ', $pInfo['img_url']);
//	if ($l['type'] == 'new-promise') $gdi = getRecord('promise', "`id` = '{$l['iid']}' "); ?>
	
	<!-- <? if ($l['type'] == 'new-promise') echo tag($gdi['content']);
	else if ($l['type'] == 'photo' && strlen($l['content']) <= 0) echo 'Photo';
	else if ($l['content']) echo tag($l['content']);
	else echo 'Community' ?> -->
	
	<div class='stat one statu box-feed the<? echo $id ?>' data-p="feed" id='<?php echo $id ?>'>
		<div id='option'></div>
<? if (count($img_url) > 0) {
// echo '<div class="col-sm-9 sidebar-nicescroller">';
	echo '<div class="col-sm-3 sidebar-nicescroller stt-col">';
		if ($pInfo['uid'] != $pInfo['to_uid']) {
			echo "<a class='fol_thum' href='#!user?u={$pInfo['uid']}'>
					<img src='$avat' class='thumbnai'/>
					<div class='bold'>$up_name</div>
				</a>
				<a href='#!user?u={$pInfo['uid']}'><b>{$up_name}</b></a>
				<i class='img to'></i>
				<a href='#!user?u={$pInfo['to_uid']}'><b>{$to_name}</b></a>";
		} else echo "<a class='fol_thum' href='#!user?u={$pInfo['uid']}'><img src='$avat' class='thumbnai'/><div class='bold'>$up_name</div></a>";
	if ($content) echo '<div class="content stt">'.tag($content).'</div>';
	echo '</div>';
	echo '<div class="col-sm-6 img-col">';
		echo '<div id="owl-carousel-single-1" class="owl-carousel owl-theme">';
		for ($i = 0; $i < count($img_url); $i++) { ?>
			<div class="item full">
				<img src="<? echo $img_url[$i] ?>"/>
				<div class="carousel-caption dark-bg">Lorem ipsum dolor sit amet, nullam sapien erat tristique tempor nulla, blandit sit metus volutpat integer wisi. Sed elementum, nec nec inceptos vestibulum diam proin erat, sociosqu et sit provident pellentesque sed aenean. Faucibus per turpis est pellentesque potenti, tristique iaculis adipiscing mauris.</div>
			</div>
<? 		}
		echo '</div>';
	echo '</div>';
// echo '</div>';
} else {
	echo '<div class="col-sm-8 sidebar-nicescroller stt-col">';
	if ($pInfo['uid'] != $pInfo['to_uid']) {
			echo "<a class='fol_thum' href='#!user?u={$pInfo['uid']}'>
					<img src='$avat' class='thumbnai'/>
					<div class='bold'>$up_name</div>
				</a>
				<a href='#!user?u={$pInfo['uid']}'><b>{$up_name}</b></a>
				<i class='img to'></i>
				<a href='#!user?u={$pInfo['to_uid']}'><b>{$to_name}</b></a>";
		} else echo "<a class='fol_thum' href='#!user?u={$pInfo['uid']}'><img src='$avat' class='thumbnai'/><div class='bold'>$up_name</div></a>";
	if ($l['type'] == 'stt') echo '<div class="content stt">'.tag($content).'</div>';
	echo '</div>';
}


	if (count($img_url) > 0) echo '<div class="normal-stt-tool col-sm-3 sidebar-nicescroller">';
	else echo '<div class="normal-stt-tool col-sm-4 sidebar-nicescroller">';
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
	echo '</div>';
?>
	</div>

