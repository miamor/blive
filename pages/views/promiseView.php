<!-- <? echo $gdi['content'] ?> -->

<? if ($gdi['uid'] == $u) echo '<!--{left-content}-->' ?>

<? 	$encourageAr = explode(', ', $gdi['encourage']);
	$gdlBelieveAr = explode(', ', $gdid['believe']);
	$gdlBelieveNotAr = explode(', ', $gdid['believe_not']);
	$gdlKnowAr = explode(', ', $gdid['know_did']);
	$gdlKnowNotAr = explode(', ', $gdid['know_didnot']);
	$gdlLikesAr = explode(', ', $gdi['likes']);
	$compare = array_diff($sAr, $gdlKnowAr);
	$reqr = round(count($sAr)/2);
$pAr = explode(', ', $gdid['people']);
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
	<? 	if (!$gdid) {
		echo '<div class="right a-money plus-money label label-info">'.$gdi['money'].' <img src="'.IMG.'/'.$gdi['money-type'].'.png"/></div>';
		} else { ?>
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
					$up = $sAr[$jj];
					$upi = getRecord('members^id,username', "`id` = '$up'");
					if ($up == $u) $kl = 'bold';
					echo '<a class="one-per '.$kl.'" href="#!user?u='.$up.'">+'.$upi['username'].'</a>';
				}
				if (in_array($u, $sAr)) { ?>
				<div class="confirm-know-it gensmall <? if (in_array($u, $gdlKnowAr)) echo 'hide' ?>">
					<b><? echo $auth['username'] ?></b> asked you to confirm <? echo possessive($auth['id']) ?> words. Help <? echo pronoun($auth['id']) ?> by clicking <b>+Know</b> (if you're sure <? echo vocative($auth['id']) ?> did it, otherwise clicking <b>-Know</b>
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
			} else if ($gdi['did'] == 'yes' && $gdi['true'] == 'true') { ?>
				<a class="btn button-generate right" title="Generate a list of friends to make promise">Generate list</a>
				<div class="italic generate-list">
					Congratulation! You now can require some of your friends to make words with the minium bet is <b class="label label-info"><? echo $gdi['money'] ?></b>.
					<form class="form-lock hide">
						<div class="confirm-select-people">
							<select multiple name="select-people[]" class="chosen-select" placeholder="Select some people to feed back your words">
								<? for ($j = 0; $j < count($frAr); $j++) {
									$frid = $frAr[$j];
									echo '<option value="'.$frid.'">'.$frArN[$frid].'</option>';
								} ?>
							</select>
						</div>
						<input type="submit" value="Submit"/>
					</form>
				</div>
				<div class="clearfix"></div>
			<? } ?>
				</div>
			</div>
		<? } ?>
			

			<div class="one-good-info">
 <? 		$urlShare = urlencode(MAIN_URL.'/promise.php?i='.$iid); ?>
			<a onClick="window.open('http://www.facebook.com/sharer/sharer.php?app_id=<? echo $social_conf['Facebook']['id'] ?>&sdk=joey&u=<? echo $urlShare ?>&display=popup&ref=plugin', 'sharer', 'toolbar=0,status=0,width=548,height=325')" target="_parent" href="javascript: void(0)">
				Share on Facebook
			</a>

				<div class="one-good-buttons"><? bButton($gdi['id']) ?></div>
				<div class="clearfix"></div>
<?	if ($checkDid > 0 && $gdi['lock'] != 'yes' && $gdi['uid'] == $u) {
		if (count($compare) <= $reqr) { ?>
		<div class="votes-and-lock hide-on-list gensmall">
			<a class="btn btn-danger lock-it left" style="margin:-2px 10px 0 0" data-content="By locking this item, everyone who voted before will not be able to change their votes anymore (This won't effect to those who vote after this is locked) Remember, this can't be undone" data-href="#!promise?i=<? echo $iid ?>&do=lock"><span class="fa fa-lock"></span> Lock</a>
			<div class="italic">You now can lock it manually. Or it'll be automaticlly locked when all suborners confirm.</div>
		</div>
<?		} else echo '<a class="btn btn-danger disabled left" style="margin:6px 10px 0 0"><span class="fa fa-lock"></span> Lock</a> <div class="italic">You need more than half of suborners confirm your work to lock it manually. Or it\'ll be automaticlly locked when all suborners confirm.</div>';
	} ?>
				<div class="clearfix"></div>
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
						<span class="gensmall">Select some friends knowing your work to confirm, otherwise, you can get back only two-thirds of your bets.</span>
						<select multiple name="select-suborner[]" class="chosen-select" placeholder="Who knows what you did?">
							<? for ($j = 0; $j < count($frAr); $j++) {
								$frid = $frAr[$j];
								echo '<option value="'.$frid.'">'.$frArN[$frid].'</option>';
							} ?>
						</select>
					</div>
					<span class="gensmall">Wanna share something about?</span>
					<textarea name="did-content" class="did-content no-toolbar left" style="height:80px"></textarea>
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

	<div class="gensmall one-good-code">#p<? echo $iid ?></div>

<?	toolPost('promise', $iid); ?>
	</span></div>

<?	echo '<div class="static-post">';
		likeStatic($pag, $iid);
	echo '</div>';
	echo '<div class="cmts-post">';
		cmtListPost($pag, $iid);
	echo '</div>';
	cmtFormPost($pag, $iid); ?>
</div>

<style>#tool{margin-top:5px!important}</style>

<script src="<? echo JS ?>/promiseView.js"></script>
