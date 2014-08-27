<? $goodDidList = $getRecord -> GET ('good', "`did` != 'yes' ");
foreach ($goodDidList as $gdl) {
	$auth = getRecord('members', "id = {$gdl['uid']}") ?>

<div class="one-good">
	<img title="<? echo $auth['username'] ?>" class="one-good-avatar avatar-circle left" src="<? echo $auth['avatar'] ?>"/>
	<div class="one-good-content">
		<? echo $gdl['content'] ?>
	</div>
	<div class="one-good-info">
		<div class="one-good-price left"><? echo $gdl['price'] ?></div>
		<div class="one-good-privacy right">
			Public
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<? } ?>
