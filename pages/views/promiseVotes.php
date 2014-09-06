<?	if ($gdi['encourage']) {
		$encourageAr = explode(', ', $gdi['encourage']);
		$encourage = count($encourageAr);
	} else $encourage = 0;
	if ($gdid['believe']) {
		$gdlBelieveAr = explode(', ', $gdid['believe']);
		$gdlBelieve = count($gdlBelieveAr);
	} else $gdlBelieve = 0;
	if ($gdid['believe_not']) {
		$gdlBelieveNotAr = explode(', ', $gdid['believe_not']);
		$gdlBelieveNot = count($gdlBelieveNotAr);
	} else $gdlBelieveNot = 0;
	if ($gdid['know_did']) {
		$gdlKnowAr = explode(', ', $gdid['know_did']);
		$gdlKnow = count($gdlKnowAr);
	} else $gdlKnow = 0;
	if ($gdid['know_didnot']) {
		$gdlKnowNotAr = explode(', ', $gdid['know_didnot']);
		$gdlKnowNot = count($gdlKnowNotAr);
	} else $gdlKnowNot = 0;
?>
<div id="m_tab">
	<div class="m_tab">
		<div class="tab" id="encourage">Encourage + (<? echo $encourage ?>)</div>
		<div class="tab active" id="believe">Believe + (<? echo $gdlBelieve ?>)</div>
		<div class="tab" id="bnot">Believe - (<? echo $gdlBelieveNot ?>)</div>
		<div class="tab" id="know">Know + (<? echo $gdlKnow ?>)</div>
		<div class="tab" id="knot">Know - (<? echo $gdlKnowNot ?>)</div>
	</div>
	<div class="hide tab-index encourage">
		<? for ($j = 0; $j < $encourage; $j++) {
			$upi = getRecord('members^username', "`id` = '{$encourageAr[$j]}' "); ?>
			<div class="one-votes">
				<a href="#!user?u=<? echo $encourageAr[$j] ?>"><? echo $upi['username'] ?></a>
				<div class="right">
				<? if (in_array($encourageAr[$j], $frAr)) echo '<span class="btn btn-small btn-info">Friends</span>';
				else if (in_array($encourageAr[$j], $frRequestsTo)) echo '<span class="btn btn-small btn-success">Accept</span>';
				else if (in_array($encourageAr[$j], $frSAr)) echo '<span class="btn btn-small btn-default">Friend request sent</span>';
				else echo '<span class="btn btn-small btn-primary">Add friend</span>' ?>
				</div>
				<div class="clearfix"></div>
			</div>
		<? } ?>
	</div>
	<div class="hide tab-index bnot">
		<? for ($j = 0; $j < $gdlBelieveNot; $j++) {
			$upi = getRecord('members^username', "`id` = '{$gdlBelieveNotAr[$j]}' "); ?>
			<div class="one-votes">
				<a href="#!user?u=<? echo $gdlBelieveNotAr[$j] ?>"><? echo $upi['username'] ?></a>
				<div class="right">
			<? 	if (in_array($gdlBelieveNotAr[$j], $frAr)) echo '<span class="btn btn-small btn-info">Friends</span>';
				else if (in_array($gdlBelieveNotAr[$j], $frRequestsTo)) echo '<span class="btn btn-small btn-success">Accept</span>';
				else if (in_array($gdlBelieveNotAr[$j], $frSAr)) echo '<span class="btn btn-small btn-default">Friend request sent</span>';
				else if ($gdlBelieveNotAr[$j] != $u) echo '<span class="btn btn-small btn-primary">Add friend</span>' ?>
				</div>
				<div class="clearfix"></div>
			</div>
		<? } ?>
	</div>
	<div class="tab-index believe">
		<? for ($j = 0; $j < $gdlBelieve; $j++) {
			$upi = getRecord('members^username', "`id` = '{$gdlBelieveAr[$j]}' "); ?>
			<div class="one-votes">
				<a href="#!user?u=<? echo $gdlBelieveAr[$j] ?>"><? echo $upi['username'] ?></a>
				<div class="right">
				<? if (in_array($gdlBelieveAr[$j], $frAr)) echo '<span class="btn btn-small btn-info">Friends</span>';
				else if (in_array($gdlBelieveAr[$j], $frRequestsTo)) echo '<span class="btn btn-small btn-success">Accept</span>';
				else if (in_array($gdlBelieveAr[$j], $frSAr)) echo '<span class="btn btn-small btn-default">Friend request sent</span>';
				else if ($gdlBelieveNotAr[$j] != $u) echo '<span class="btn btn-small btn-primary">Add friend</span>' ?>
				</div>
				<div class="clearfix"></div>
			</div>
		<? } ?>
	</div>
	<div class="hide tab-index bnot">
		<? for ($j = 0; $j < $gdlBelieveNot; $j++) {
			$upi = getRecord('members^username', "`id` = '{$gdlBelieveNotAr[$j]}' "); ?>
			<div class="one-votes">
				<a href="#!user?u=<? echo $gdlBelieveNotAr[$j] ?>"><? echo $upi['username'] ?></a>
				<div class="right">
				<? if (in_array($gdlBelieveNotAr[$j], $frAr)) echo '<span class="btn btn-small btn-info">Friends</span>';
				else if (in_array($gdlBelieveNotAr[$j], $frRequestsTo)) echo '<span class="btn btn-small btn-success">Accept</span>';
				else if (in_array($gdlBelieveNotAr[$j], $frSAr)) echo '<span class="btn btn-small btn-default">Friend request sent</span>';
				else if ($gdlBelieveNotAr[$j] != $u) echo '<span class="btn btn-small btn-primary">Add friend</span>' ?>
				</div>
				<div class="clearfix"></div>
			</div>
		<? } ?>
	</div>
	<div class="hide tab-index know">
		<? for ($j = 0; $j < $gdlKnow; $j++) {
			$upi = getRecord('members^username', "`id` = '{$gdlKnowAr[$j]}' "); ?>
			<div class="one-votes">
				<a href="#!user?u=<? echo $gdlKnowAr[$j] ?>"><? echo $upi['username'] ?></a>
				<? if (in_array($gdlKnowAr[$j], $sAr)) echo '<span class="italic gensmall" style="margin-left:12px">Required</span>' ?>
				<div class="right">
				<? if (in_array($gdlKnowAr[$j], $frAr)) echo '<span class="btn btn-small btn-info">Friends</span>';
				else if (in_array($gdlKnowAr[$j], $frRequestsTo)) echo '<span class="btn btn-small btn-success">Accept</span>';
				else if (in_array($gdlKnowAr[$j], $frSAr)) echo '<span class="btn btn-small btn-default">Friend request sent</span>';
				else if ($gdlBelieveNotAr[$j] != $u) echo '<span class="btn btn-small btn-primary">Add friend</span>' ?>
				</div>
				<div class="clearfix"></div>
			</div>
		<? } ?>
	</div>
	<div class="hide tab-index knot">
		<? for ($j = 0; $j < $gdlKnowNot; $j++) {
			$upi = getRecord('members^username', "`id` = '{$gdlKnowNotAr[$j]}' "); ?>
			<div class="one-votes">
				<a href="#!user?u=<? echo $gdlKnowNotAr[$j] ?>"><? echo $upi['username'] ?></a>
				<div class="right">
				<? if (in_array($gdlKnowNotAr[$j], $frAr)) echo '<span class="btn btn-small btn-info">Friends</span>';
				else if (in_array($gdlKnowNotAr[$j], $frRequestsTo)) echo '<span class="btn btn-small btn-success">Accept</span>';
				else if (in_array($gdlKnowNotAr[$j], $frSAr)) echo '<span class="btn btn-small btn-default">Friend request sent</span>';
				else if ($gdlBelieveNotAr[$j] != $u) echo '<span class="btn btn-small btn-primary">Add friend</span>' ?>
				</div>
				<div class="clearfix"></div>
			</div>
		<? } ?>
	</div>
</div>
