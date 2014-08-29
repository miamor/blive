<!-- What you said -->

<!--{left-content}-->

<h2>Your promises</h2>
<div class="gensmall">Deprecated</div>

<? // $goodDidList = $getRecord -> GET ('promise', "`did` != 'yes' ");
$goodDidList = $getRecord -> GET ('help', $condition);
if (count($goodDidList) <= 0) echo '<div class="rows">Empty data</div>';
else {
	foreach ($goodDidList as $gdl) {
		$auth = getRecord('members^username,avatar', "id = {$gdl['uid']}"); ?>

<div class="one-good statu the-box box-feed the<? echo $gdl['id'] ?>" data-p="promise" id="<? echo $gdl['id'] ?>">
	<div id='option'></div>
	
<!--	<a class="fol_thum" href="#!user?u=<? echo $gdl['uid'] ?>">
		<img src="<? echo $auth['avatar'] ?>" class="thumbnai thumbs"/>
		<div class="bold"><? echo $auth['username'] ?></div>
	</a> -->
<div class="one-good-feed <? if ($gdl['did'] == 'yes') echo 'did-it'; else if ($gdl['did'] == 'no') echo 'fail-it' ?>" data-p="promise" id="<? echo $gdl['id'] ?>">
	<div class="one-good-content">
		<div class="label label-danger one-good-price right"><? echo $gdl['price'] ?></div>
		<? echo tag($gdl['content']) ?>
	</div>
	<div class="one-good-info">
		<a class="right go-to-link" href="#!promise?i=<? echo $gdl['id'] ?>"><span class="fa fa-chevron-circle-right"></span></a>
		<div class="one-good-buttons"><? bButton($gdl['id']) ?></div>
		<div class="one-good-time right gensmall">
			<span class="fa fa-clock-o"></span> <? echo timeFormat($gdl['time']) ?>
		</div>
		<div class="clearfix"></div>
	</div>
	<? if ($gdl['did'] == 'yes' && $gdl['lock'] == 'yes' && $gdl['money'] > 0) echo '<div class="l-money plus-money label label-primary label-square">+'.$gdl['money'].'</div>';
	else if ($gdl['did'] == 'no' && $gdl['money'] > 0) echo '<div class="l-money minus-money label label-danger label-square">-'.$gdl['money'].'</div>' ?>
</div>

</div>
<? 	}
} ?>

<script src="<? echo JS ?>/promiseList.js"></script>
