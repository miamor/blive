<!-- Answer friends' questions -->

<!--{left-content}-->

<? // $goodDidList = $getRecord -> GET ('promise', "`did` != 'yes' ");
$goodDidList = $getRecord -> GET ('ask', $condition);
if (count($goodDidList) <= 0) echo '<div class="rows">Empty data</div>';
else {
	foreach ($goodDidList as $gdl) {
		$auth = getRecord('members^username,avatar', "id = {$gdl['uid']}"); ?>

<div class="one-good the<? echo $gdl['id'] ?> <? if ($gdl['did'] == 'yes') echo 'did-it'; else if ($gdl['did'] == 'no') echo 'fail-it' ?>" data-p="ask" id="<? echo $gdl['id'] ?>">
	<img title="<? echo $auth['username'] ?>" class="one-good-avatar avatar-circle left" src="<? echo $auth['avatar'] ?>"/>
	<div class="one-good-content">
		<div class="label label-danger one-good-price right"><? echo $gdl['price'] ?></div>
		<? echo tag($gdl['content']) ?>
	</div>
	<div class="one-good-info">
		<? bButtonAsk($gdl['id']) ?>
<!--		<div class="one-good-privacy right">
			Public
		</div> -->
		<div class="one-good-time right gensmall">
			<span class="fa fa-clock-o"></span> <? echo timeFormat($gdl['time']) ?>
		</div>
		<div class="clearfix"></div>
	</div>
	<? if ($gdl['did'] == 'yes' && $gdl['lock'] == 'yes' && $gdl['money'] > 0) echo '<div class="l-money plus-money label label-primary label-square">+'.$gdl['money'].'</div>';
	else if ($gdl['did'] == 'no' && $gdl['money'] > 0) echo '<div class="l-money minus-money label label-danger label-square">-'.$gdl['money'].'</div>' ?>
</div>

<? 	}
} ?>

<script src="<? echo JS ?>/promiseList.js"></script>
