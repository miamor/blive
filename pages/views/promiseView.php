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
		<? if ($gdid) { ?>
			<div class="one-good-content did-it did-content">
		<?	if ($gdi['lock'] == 'yes' && $gdi['money'] > 0) {
				if ($gdi['did'] == 'yes') echo '<div class="right a-money plus-money label label-success">+'.$gdi['money'].' <img src="'.IMG.'/'.$gdi['money-type'].'.png"/></div>';
				else if ($gdi['did'] == 'no') echo '<div class="right a-money substract-money label label-danger">-'.$gdi['money'].' <img src="'.IMG.'/'.$gdi['money-type'].'.png"/></div>';
			}
			if ($gdi['did'] == 'yes') echo '<b class="success-sign left">I did it!</b>';
			else if ($gdi['did'] == 'no') echo '<b class="failure-sign left">I failed!</b>';
			echo tag($gdid['content']) ?>
			<? if ($gdid['suborner']) {
				echo '<div class="suborner-list">';
				echo '<span class="small success-text dt">* These people know it!</span>';
				for ($jj = 0; $jj < count($sAr); $jj++) {
					$up = $pAr[$jj];
					$upi = getRecord('members^id,username', "`id` = '$up'");
					if ($up == $u) $kl = 'bold';
					echo '<a class="one-per '.$kl.'" href="#!user?u='.$up.'">+'.$upi['username'].'</a>';
				}
				if (in_array($u, $sAr)) { ?>
				<div class="confirm-know-it gensmall">
					<b><? echo $auth['username'] ?></b> asked you to confirm <? echo possessive($auth['id']) ?> words. Help <? echo pronoun($auth['id']) ?> by clicking <b>+Know</b> (if you're sure <? echo vocative($auth['id']) ?> did it, otherwise clicking <b>-Know</b>)
				</div>
			<? }
				echo '</div>';
			} ?>
				<div class="people-list">
			<? if ($gdid['people']) {
				if ($gdi['lock'] == 'yes') echo '<div class="small italic">* These following people will have to make a word to complete with the minimum bet is <b>'.$gdi['money'].'</b>.</div>';
				else if ($gdi['uid'] == $u) echo '<div class="small italic">* This list is now available for you only and will be public after this is closed.</div>';
				if ($gdi['lock'] == 'yes' || $gdi['uid'] == $u) {
					for ($j = 0; $j < count($pAr); $j++) {
						$up = $pAr[$j];
						$upi = getRecord('members^id,username', "`id` = '$up'");
						echo '<a class="one-per" href="#!user?u='.$up.'">+'.$upi['username'].'</a>';
					}
				}
			} ?>
				</div>
			</div>
		<? } ?>
			
			<div class="one-good-info">
				<div class="one-good-buttons"><? bButton($gdi['id']) ?></div>
<!--				<div class="one-good-time right gensmall">
					<span class="fa fa-clock-o"></span> <? echo timeFormat($gdi['time']) ?>
				</div>
-->				<div class="clearfix"></div>
			</div>

		<? if ($gdi['uid'] == $u && !$gdi['did']) { ?>
			<div class="confirm-did">
				<div class="confirm-ask">
					<strong><img src="<? echo silk ?>/emoticon_grin.png" style="margin-top:-3px"/> Did you made it?</strong>
					<div class="confirm-options right">
						<a id="yes" class="yes did-it btn btn-primary"><span class="success-sign"></span> Yes</a>
						<a id="no" class="no did-it btn btn-none"><span class="failure-sign"> No</span></a>
					</div>
				</div>
				<div class="confirm-switch confirm-options right hide"></div>
				<div class="confirm-text hide"></div>
				<form class="confirm-textarea hide">
<!--					<div class="confirm-lock-option">
						<select name="confirm-lock" class="left">
							<option value="default">Default</option>
							<option value="custom">Custom</option>
							<option value="none">None</option>
						</select>
						<input type="number" class="num-to-lock" name="num-to-lock" placeholder="Numbers of votes before locked"/>
					</div>
-->					<input type="hidden" class="did-option" name="did-option"/>
					<div class="confirm-select-suborner">
						<select multiple name="select-suborner[]" class="chosen-select" placeholder="Who knows what you did?">
							<? for ($j = 0; $j < count($frAr); $j++) {
								$frid = $frAr[$j];
								echo '<option value="'.$frid.'">'.$frArN[$frid].'</option>';
							} ?>
						</select>
					</div>
					<span class="gensmall">Wanna share something about?</span>
					<textarea name="did-content" class="did-content no-toolbar left" style="height:80px"></textarea>
					<div class="confirm-select-people">
						<select multiple name="select-people[]" class="chosen-select" placeholder="Select some people to feed back your words">
							<? for ($j = 0; $j < count($frAr); $j++) {
								$frid = $frAr[$j];
								echo '<option value="'.$frid.'">'.$frArN[$frid].'</option>';
							} ?>
						</select>
					</div>
					<input type="submit" value="Submit" class="right form-button"/>
					<div class="clearfix"></div>
				</form>
				<div class="confirm-lock-options hide">
<!--					<div class="one-option selected">Default</div>
					<div class="one-option">Auto</div>
					<div class="one-option">Custom</div>
-->				</div>
			</div>
		<? } ?>
	</span></div>
		
	<div class="gensmall one-good-code">#p<? echo $iid ?></div>

	<div class="hide small-board-fixed"></div>
	<div class="hide small-board sb-like-list"></div>

<?	toolPost('promise', $iid);
	echo '<div class="static-post">';
		likeStatic('promise', $iid);
	echo '</div>';
	echo '<div class="cmts-post">';
		cmtListPost('promise', $iid);
	echo '</div>';
	cmtFormPost('promise', $iid); ?>
</div>

<script src="<? echo JS ?>/promiseView.js"></script>
