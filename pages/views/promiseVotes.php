<?	if ($gdid['believe']) {
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
		<div class="tab active" id="believe">Believe + (<? echo $gdlBelieve ?>)</div>
		<div class="tab" id="bnot">Believe - (<? echo $gdlBelieveNot ?>)</div>
		<div class="tab" id="know">Know + (<? echo $gdlKnow ?>)</div>
		<div class="tab" id="knot">Know - (<? echo $gdlKnowNot ?>)</div>
	</div>
	<div class="tab-index believe">
		<? for ($j = 0; $j < $gdlBelieve; $j++) {
			$up = $gdlBelieveAr[$j]; ?>
			<div class="one-votes">
				<a href="#!user?u=<? echo $up ?>"><? echo $frArN[$up] ?></a>
			</div>
		<? } ?>
	</div>
	<div class="hide tab-index bnot">
		<? for ($j = 0; $j < $gdlBelieveNot; $j++) {
			$up = $gdlBelieveNotAr[$j]; ?>
			<div class="one-votes">
				<a href="#!user?u=<? echo $up ?>"><? echo $frArN[$up] ?></a>
			</div>
		<? } ?>
	</div>
	<div class="hide tab-index know">
		<? for ($j = 0; $j < $gdlKnow; $j++) {
			$up = $gdlKnowAr[$j]; ?>
			<div class="one-votes">
				<a href="#!user?u=<? echo $up ?>"><? echo $frArN[$up] ?></a>
			</div>
		<? } ?>
	</div>
	<div class="hide tab-index knot">
		<? for ($j = 0; $j < $gdlKnowNot; $j++) {
			$up = $gdlKnowNotAr[$j]; ?>
			<div class="one-votes">
				<a href="#!user?u=<? echo $up ?>"><? echo $frArN[$up] ?></a>
			</div>
		<? } ?>
	</div>
</div>
