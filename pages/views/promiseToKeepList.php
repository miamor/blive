<!-- What you said -->

<? // $goodDidList = $getRecord -> GET ('promise', "`did` != 'yes' ");
$goodDidList = $getRecord -> GET ('promise', "uid = $u");
foreach ($goodDidList as $gdl) {
	$auth = getRecord('members^username,avatar', "id = {$gdl['uid']}"); ?>

<div class="one-good" id="<? echo $gdl['id'] ?>">
	<img title="<? echo $auth['username'] ?>" class="one-good-avatar avatar-circle left" src="<? echo $auth['avatar'] ?>"/>
	<div class="one-good-content">
		<div class="label label-danger one-good-price right"><? echo $gdl['price'] ?></div>
		<? echo tag($gdl['content']) ?>
	</div>
	<div class="one-good-info">
		<? bButton($gdl['id']) ?>
<!--		<div class="one-good-privacy right">
			Public
		</div> -->
		<div class="one-good-time right gensmall">
			<span class="fa fa-clock-o"></span> <? echo timeFormat($gdl['time']) ?>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<? } ?>

<script src="<? echo JS ?>/promiseList.js"></script>
