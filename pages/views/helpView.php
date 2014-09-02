<!-- <? echo $gdi['content'] ?> -->

<? if ($gdi['uid'] == $u) echo '<!--{left-content}-->' ?>

<div class="one-good-big statu one the-<? echo $gdi['type'] ?> <? if ($gdi['did'] == 'yes' && $gdi['lock'] =='yes') echo 'the-lock'; else if ($gdi['did'] == 'yes' && $gdi['lock'] == 'lie') echo 'the-lie'; else if ($gdi['did'] == 'yes') echo 'the-did'; else if ($gdi['did'] == 'no') echo 'the-fail' ?> the<? echo $iid ?> <? if ($gdi['did'] == 'yes') echo 'did-it'; else if ($gdi['did'] == 'no') echo 'fail-it' ?>" data-p="request" id="<? echo $iid ?>">
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
			<div class="fb-share-button" data-href="<? echo MAIN_URL.'#!request?i='.$iid ?>"></div>
	</span></div>

	<div class="one-good-info helpful">

<? 	if ($gdi['type'] == 'add') {
		if ($gdi['uid'] != $u) { ?>
			<div class="one-tool">
				<span class="button-vote-group helpful-vote helpful-btn <? if (in_array($u, $gdlHelpfulAr) || in_array($u, $gdlHelpfulNotAr)) echo 'active' ?>">
					<a class="button-vote vote-down button-helpful <? if (in_array($u, $gdlHelpfulAr)) echo 'active' ?>" id="helpful"><span class="fa fa-thumbs-down"></span></a>
					<a class="button-vote vote-up button-helpful-not <? if (in_array($u, $gdlHelpfulNotAr)) echo 'active' ?>" id="helpful_not"><span class="fa fa-thumbs-up"></span></a>
				</span>
				<a class="button-vote button-star-request-add"><span class="fa fa-star-o"></span></a>
			</div>

<!--		<div class="helpful-vote">
				<b class="genbig">Is this helpful?</b>
				<span class="helpful-btn">
					<a class="btn btn-primary" id="helpful">Yes</a>
					<a class="btn btn-none" id="helpful_not">No</a>
				</span>
			</div> -->
<? 		} ?>
		<!-- BEGIN Helpful static -->
		<div class="helpful-static"><span>
			<? helpfulSta($gdi['helpful'], $gdi['helpful_not']) ?>
		</span></div>
		<!-- END Helpful static -->
<? 	} else {
		if ($gdi['uid'] != $u) { ?>
			<div class="one-tool">
				<span class="button-vote-group helpful-vote helpful-btn">
					<a class="button-vote vote-down button-helpful" id="helpful"><span class="fa fa-thumbs-down"></span></a>
					<a class="button-vote vote-up button-helpful-not" id="helpfulnot"><span class="fa fa-thumbs-up"></span></a>
				</span>
				<a class="button-vote button-star-request-need"><span class="fa fa-star-o"></span></a>
			</div>
<?		}
	} ?>
		</div>
	
	<div class="gensmall one-good-code">#r<? echo $iid ?></div>

<div class="helpers">
<? 	if ($gdi['type'] == 'need' && $checkMyDid <= 0 && $gdi['uid'] != $u) { ?>
			<div class="me-help hide arrow-big-div">
				<h4 class="arrow-bottom">Help him out</h4>
				<form class="form-help arrow-div">
					<textarea name="help-content" class="no-toolbar" placeholder="Say something?"></textarea>
					<input type="submit" class="right" value="Submit"/>
				</form>
			</div>
<? 	} ?>
	<div class="main-help-col col-sm-8 no-padding no-margin">
		<? if ($gdi['type'] == 'need' && $checkMyDid <= 0 && $gdi['uid'] != $u) echo '<a class="btn right button-help">Help</a>' ?>
	<!--	<h4 class="h3-helper left"><b>3</b> following people offered to help!</h4> -->
		<? if ($gdi['type'] == 'need') echo '<h4 class="h3-helper"><b>'.$checkDid.'</b> following people offered to help!</h4>';
		else echo '<h4 class="h3-helper"><b>'.$checkDid.'</b> following people asked for help</h4>' ?>
		<div class="clearfix"></div>
		<div class="helper-list">
<? 	if ($checkDid > 0) {
		foreach ($gdid as $hep) {
			$ahp = getRecord('members^username,avatar', "`id` = '{$hep['uid']}' ") ?>
			<div class="helper-one">
				<div class="right helper-tool">
					<span class="button-vote-group">
						<a class="button-vote vote-down"><span class="fa fa-thumbs-down"></span></a>
						<a class="button-vote vote-up"><span class="fa fa-thumbs-up"></span></a>
					</span>
					<a class="button-vote button-choose-best"><span class="fa fa-star-o"></span></a>
				</div>
				<img class="avatar-circle left" src="<? echo $ahp['avatar'] ?>"/>
				<div class="helper-username cuprum">
					<a href="#!user?u=<? echo $hep['uid'] ?>"><? echo $ahp['username'] ?></a>
				</div>
				<div class="helper-content"><? echo tag($hep['content']) ?></div>
				<div class="clearfix"></div>
			</div>
	<?	}
	} else {
		if ($gdi['type'] == 'need') echo '<div class="helper-one italic">No one offered a help.</div>';
		else echo '<div class="helper-one italic">No one asked a help.</div>';
	}		?>
		</div>
	</div>
	<div class="suggest-help col-sm-4 no-padding no-margin arrow-big-div">
<? if (count($related) > 0) { ?>
		<? if ($gdi['type'] == 'need') echo '<h5 class="arrow-bottom">We found something, may help you?</h5>';
		else echo '<h5 class="arrow-bottom">This might help</h5>' ?>
		<div class="suggest-list arrow-div">
<? 	foreach ($related as $rl) {
		$aurl = getRecord('members^username,avatar', "`id` = '{$rl['uid']}' ") ?>
			<div class="suggest-one">
				<img class="avatar-circle left" src="<? echo $aurl['avatar'] ?>"/>
				<a href="#!request?i=<? echo $rl['id'] ?>">
					<span class="helper-username helper-title s-title"><? echo tag($rl['content']) ?></span>
				</a>
				<span class="gensmall">by <a href="#!user?u=<? echo $rl['uid'] ?>"><? echo $aurl['username'] ?></a></span>
				<div class="clearfix"></div>
			</div>
<?	} ?>
		</div>
<? } else echo '<div class="italic"><div class="helper-one">Nothing found.</div></div>'; ?>
	</div>
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
