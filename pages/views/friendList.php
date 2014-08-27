<? for ($j = 0; $j < count($frAr); $j++) {
	$uf = $frAr[$j];
	$ufi = getRecord('members^id,avatar,status', "`id` = '$uf'");
	echo '<div class="one-friend rows" id="'.$uf.'">
		<img class="avatar-circle thumb left" src="'.$ufi['avatar'].'"/>
		<strong>'.$frArN[$uf].'</strong>
		<div class="last-mes small">Hello!</div>
	</div>';
} ?>
