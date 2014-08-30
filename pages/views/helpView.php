<!-- <? echo $gdi['content'] ?> -->

<? if ($gdi['uid'] == $u) echo '<!--{left-content}-->' ?>

<? $pAr = explode(', ', $gdid['people']);
$sAr = explode(', ', $gdid['suborner']) ?>

<div class="one-good-big statu one the-<? echo $gdi['type'] ?> <? if ($gdi['did'] == 'yes' && $gdi['lock'] =='yes') echo 'the-lock'; else if ($gdi['did'] == 'yes' && $gdi['lock'] == 'lie') echo 'the-lie'; else if ($gdi['did'] == 'yes') echo 'the-did'; else if ($gdi['did'] == 'no') echo 'the-fail' ?> the<? echo $iid ?> <? if ($gdi['did'] == 'yes') echo 'did-it'; else if ($gdi['did'] == 'no') echo 'fail-it' ?>" data-p="promise" id="<? echo $iid ?>">
	<div class="one-good-main"><span>
			<div class="left one-good-avatar">
				<img title="<? echo $auth['username'] ?>" class="avatar-circle" src="<? echo $auth['avatar'] ?>"/>
				<a class="bold" href="#!user?u=<? echo $gdi['uid'] ?>"><? echo $auth['username'] ?></a>
			</div>
			<div class="one-good-content">
				<? echo tag($gdi['content']) ?>
			</div>
			<div class="tags-list">
				<? echo tagsList($gdi['tags']) ?>
			</div>
	</span></div>
	
	<div class="gensmall one-good-code">#r<? echo $iid ?></div>

<div class="helpers">
<? 	if ($gdi['type'] == 'need') {
		if ($checkDid <= 0 && $gdi['uid'] != $u) { ?>
			<div class="me-help hide arrow-big-div">
				<h4 class="arrow-bottom">Help him out</h4>
				<form class="form-help arrow-div">
					<textarea name="help-content" class="no-toolbar" placeholder="Say something?"></textarea>
					<input type="submit" class="right" value="Submit"/>
				</form>
			</div>
		<? } ?>
	<div class="main-help-col col-sm-8 no-padding no-margin">
		<? if ($checkDid <= 0 && $gdi['uid'] != $u) echo '<a class="btn right button-help">Help</a>' ?>
	<!--	<h4 class="h3-helper left"><b>3</b> following people offered to help!</h4> -->
		<h4 class="h3-helper"><b><? echo $checkDid ?></b> following people offered to help!</h4>
		<div class="clearfix"></div>
		<div class="helper-list">
	<?	if ($checkDid > 0) {
		foreach ($gdid as $hep) {
			$ahp = getRecord('members^username,avatar', "`id` = '{$hep['uid']}' ") ?>
			<div class="helper-one">
				<img class="avatar-circle left" src="<? echo $ahp['avatar'] ?>"/>
				<div class="helper-username cuprum">
					<a href="#!user?u=<? echo $hep['uid'] ?>"><? echo $ahp['username'] ?></a>
				</div>
				<div class="helper-content"><? echo tag($hep['content']) ?></div>
				<div class="clearfix"></div>
			</div>
	<?	}
		} else echo '<div class="helper-one italic">No one offered a help.</div>' ?>
		</div>
	</div>
	<div class="suggest-help col-sm-4 no-padding no-margin arrow-big-div">
	<? if (count($related) > 0) { ?>
		<h5 class="arrow-bottom">We found something, may help you?</h5>
		<div class="suggest-list arrow-div">
	<? 	foreach ($related as $rl) { ?>
			<div class="suggest-one">
				<div class="helper-username cuprum">
					<a href="#!request?i=<? echo $rl['id'] ?>"><? echo tag($rl['content']) ?></a>
				</div>
			</div>
	<?	} ?>
		</div>
	<? } else echo '<div class="italic"><div class="helper-one">Nothing found.</div></div>'; ?>
	</div>
<? 	} ?>
	<div class="clearfix"></div>
</div>

	<div class="hide small-board-fixed"></div>
	<div class="hide small-board sb-like-list"></div>

<?	toolPost($pag, $iid);
	echo '<div class="static-post">';
		likeStatic($pag, $iid);
	echo '</div>';
	echo '<div class="cmts-post">';
		cmtListPost($pag, $iid);
	echo '</div>';
	cmtFormPost($pag, $iid); ?>
</div>

<script src="<? echo JS ?>/helpView.js"></script>
