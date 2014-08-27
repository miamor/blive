<!-- <? echo $gdi['content'] ?> -->


<div class="one-good-big" id="<? echo $iid ?>">
	<div class="one-good-main"><span>
			<img title="<? echo $auth['username'] ?>" class="one-good-avatar avatar-circle left" src="<? echo $auth['avatar'] ?>"/>
			<div class="one-good-content">
				<div class="label label-danger one-good-price right"><? echo $gdi['price'] ?></div>
				<? echo tag($gdi['content']) ?>
			</div>
		<? if ($gdi['did'] == 'yes') { ?>
			<div class="one-good-content did-it did-content">
				<b class="success-sign">I did it!</b>
				<? echo tag($gdid['content']) ?>
			</div>
		<? } else if ($gdi['did'] == 'no') { ?>
			<div class="one-good-content did-it did-content">
				<b class="failure-sign">I failed!</b>
				<? echo tag($gdid['content']) ?>
			</div>
		<? } ?>
			
			<div class="one-good-info">
				<div class="one-good-buttons"><? bButton($gdi['id']) ?></div>
				<div class="one-good-time right gensmall">
					<span class="fa fa-clock-o"></span> <? echo timeFormat($gdi['time']) ?>
				</div>
				<div class="clearfix"></div>
			</div>

		<? if ($gdi['uid'] == $u && !$gdi['did']) { ?>
			<div class="confirm-did">
				<div class="confirm-ask">
					<strong><img src="<? echo silk ?>/emoticon_grin.png" style="margin-top:-3px"/> Did you made it?</strong>
					<div class="confirm-options right">
						<a id="yes" class="yes did-it btn btn-primary"><span class="success-sign"></span> Yes</a>
						<a id="no" class="no did-it btn"><span class="failure-sign"> No</span></a>
					</div>
				</div>
				<div class="confirm-switch confirm-options right hide"></div>
				<div class="confirm-text hide"></div>
				<form class="confirm-textarea hide">
					<input type="hidden" class="did-option" name="did-option"/>
					<span class="gensmall">Wanna share something about?</span>
					<textarea name="did-content" class="did-content no-toolbar left" style="height:80px"></textarea>
					<input type="submit" value="Submit" class="right form-button"/>
				</form>
				<div class="confirm-lock-options hide option-list">
					<div class="one-option selected">Default</div>
					<div class="one-option">Auto</div>
					<div class="one-option">Custom</div>
				</div>
				<div class="confirm-select-people hide">
					<select multiple name="did-select-people[]" class="chosen-select">
						<? $frList = $getRecord -> GET('friend', "`uid` = '$u' OR `receive_id` = '$u' ");
						foreach ($frList as $frList) {
							if ($frList['id'] == $u) $frid = $frList['receive_id'];
							else $frid = $frList['id'];
							$fr = getRecord('members^id,username', "id = $frid");
							echo '<option>'.$fr['username'].'</option>';
						} ?>
					</select>
				</div>
			</div>
		<? } ?>
	</span></div>
		
	<div class="gensmall one-good-code">#p<? echo $iid ?></div>

	<? $tb = 'promise'; include 'views/comment.php' ?>
</div>

<script src="<? echo JS ?>/promiseView.js"></script>
