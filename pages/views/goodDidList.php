<? $goodDidList = $getRecord -> GET ('good', "`did` = 'yes' ");
foreach ($goodDidList as $gdl) { ?>

<div class="one-good">
	<div class="one-good-content">
		<? echo $gdl['content'] ?>
	</div>
</div>

<? } ?>
