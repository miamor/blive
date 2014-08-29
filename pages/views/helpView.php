<!-- <? echo $gdi['content'] ?> -->

<? if ($gdi['uid'] == $u) echo '<!--{left-content}-->' ?>

<? $pAr = explode(', ', $gdid['people']);
$sAr = explode(', ', $gdid['suborner']) ?>

<div class="one-good-big statu one <? if ($gdi['did'] == 'yes' && $gdi['lock'] =='yes') echo 'the-lock'; else if ($gdi['did'] == 'yes' && $gdi['lock'] == 'lie') echo 'the-lie'; else if ($gdi['did'] == 'yes') echo 'the-did'; else if ($gdi['did'] == 'no') echo 'the-fail' ?> the<? echo $iid ?> <? if ($gdi['did'] == 'yes') echo 'did-it'; else if ($gdi['did'] == 'no') echo 'fail-it' ?>" data-p="promise" id="<? echo $iid ?>">
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
<div class="main-help-col col-sm-8 no-padding no-margin">
	<h4 class="h3-helper left"><b>3</b> following people offered to help!</h4>
	<a class="btn right button-help">Help</a>
	<div class="clearfix"></div>
	<div class="helper-list">
		<div class="helper-one">
			<img class="avatar-circle left" src="<? echo $auth['avatar'] ?>"/>
			<div class="helper-username cuprum">
				<a href="#!user?u=1">admin</a>
			</div>
			<div class="helper-content">I can help you with that!</div>
		</div>
		<div class="helper-one">
			<img class="avatar-circle left" src="<? echo $auth['avatar'] ?>"/>
			<div class="helper-username cuprum">
				<a href="#!user?u=1">abc</a>
			</div>
			<div class="helper-content">Hey call me I'll get you one</div>
		</div>
		<div class="helper-one">
			<img class="avatar-circle left" src="<? echo $auth['avatar'] ?>"/>
			<div class="helper-username cuprum">
				<a href="#!user?u=1">xyz</a>
			</div>
			<div class="helper-content">I already got one. See me at [...] to get hah?!</div>
		</div>
	</div>
</div>
<div class="suggest-help col-sm-4 no-padding no-margin">
	<h5>We found something, may help you?</h5>
	<div class="suggest-list">
		<div class="suggest-one">
			<div class="helper-username cuprum">
				<a href="#!request?i=1">Request #1</a>
			</div>
		</div>
		<div class="suggest-one">
			<div class="helper-username cuprum">
				<a href="#!request?i=1">Request #1</a>
			</div>
		</div>
		<div class="suggest-one">
			<div class="helper-username cuprum">
				<a href="#!request?i=1">Request #1</a>
			</div>
		</div>
	</div>
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

<script src="<? echo JS ?>/promiseView.js"></script>
