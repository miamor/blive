<!-- <? echo $gdi['content'] ?> -->

<? if ($gdi['uid'] == $u) echo '<!--{left-content}-->' ?>

<div class="one-good-big <? if ($gdi['did'] == 'yes' && $gdi['lock'] =='yes') echo 'the-lock'; else if ($gdi['did'] == 'yes' && $gdi['lock'] == 'lie') echo 'the-lie'; else if ($gdi['did'] == 'yes') echo 'the-did'; else if ($gdi['did'] == 'no') echo 'the-fail' ?> the<? echo $iid ?> <? if ($gdi['did'] == 'yes') echo 'did-it'; else if ($gdi['did'] == 'no') echo 'fail-it' ?>" data-p="ask" id="<? echo $iid ?>">
	<div class="one-good-main"><span>
			<div class="left one-good-avatar">
				<img title="<? echo $from['username'] ?>" class="avatar-circle" src="<? echo $from['avatar'] ?>"/>
				<a class="bold" href="#!user?u=<? echo $gdi['fr_uid'] ?>"><? echo $from['username'] ?></a>
			</div>
			<div class="one-good-content">
				<? echo tag($gdi['content']) ?>
			</div>
		<? if ($gdid) { ?>
			<div class="one-good-content did-it did-content">
		<?	if ($gdi['lock'] == 'yes' && $gdi['money'] > 0) {
				if ($gdi['did'] == 'yes') echo '<div class="right a-money plus-money label label-success">+'.$gdi['money'].' <img src="'.IMG.'/'.$gdi['money-type'].'.png"/></div>';
				else if ($gdi['did'] == 'no') echo '<div class="right a-money substract-money label label-danger">-'.$gdi['money'].' <img src="'.IMG.'/'.$gdi['money-type'].'.png"/></div>';
			}
			if ($gdi['did'] == 'yes') echo '<b class="success-sign left">Answer</b>';
			else if ($gdi['did'] == 'no') echo '<b class="failure-sign left">Refused</b>';
			echo tag($gdid['content']) ?>
			</div>
		<? } ?>

		<? if ($gdi['uid'] == $u && !$gdi['did']) { ?>
			<div class="confirm-did">
				<div class="confirm-ask">
					<strong><img src="<? echo silk ?>/emoticon_grin.png" style="margin-top:-3px"/> Answer this one?</strong>
					<div class="confirm-options right">
						<a id="yes" class="yes did-it btn btn-primary"><span class="success-sign"></span> Go</a>
						<a id="no" class="no did-it btn" data-placement="left" data-toggle="confirmation"><span class="failure-sign"> Refuse</span></a>
					</div>
				</div>
				<div class="confirm-switch confirm-options right hide">
					<a id="no" class="no did-it btn" data-placement="left" data-toggle="confirmation"><span class="failure-sign"> Refuse</span></a>
				</div>
				<div class="confirm-text hide"></div>
				<form class="confirm-textarea hide" style="padding:3px 15px 6px">
					<input type="hidden" class="did-option" name="did-option"/>
					<span class="gensmall">Write your answer here</span>
					<textarea name="did-content" class="did-content no-toolbar left" style="height:80px"></textarea>
					<input type="submit" value="Submit" class="right form-button"/>
					<div class="clearfix"></div>
				</form>
			</div>
		<? } ?>
	</span></div>
			
			<div class="one-good-info">
				<div class="one-good-buttons"><? bButtonAsk($gdi['id']) ?></div>
				<div class="clearfix"></div>
			</div>
		
	<div class="gensmall one-good-code">#a<? echo $iid ?></div>

	<div class="hide small-board-fixed"></div>
	<div class="hide small-board sb-like-list"></div>

<?	toolPost('ask', $iid);
	echo '<div class="static-post">';
		likeStatic('ask', $iid);
	echo '</div>';
	echo '<div class="cmts-post">';
		cmtListPost('ask', $iid);
	echo '</div>';
	cmtFormPost('ask', $iid); ?>
</div>

<script src="<? echo JS ?>/promiseView.js"></script>
