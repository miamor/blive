<? include '../lib/config.php';
include 'system/user.php';
$uIn = getRecord('members', "`id` = '$uid' OR `username` = '$uid' ");
$uid = $uIn['id'];
$frListsUid = $getRecord -> GET('friend', "`accept` = 'yes' AND (`uid` = '$uid' OR `receive_id` = '$uid') ");
foreach ($frListsUid as $frListsUid) {
	if ($frListsUid['uid'] == $uid) $frU = $frListsUid['receive_id'];
	else $frU = $frListsUid['uid'];
	$frIn = getRecord('members^id,username', "`id` = '$frU'");
	$frArNu[$frU] = $frIn['username'];
}
$frAru = array_keys($frArNu);
	$aWords = countRecord('promise', "`uid` = '$uid' ");
	$sWords = countRecord('promise', "`uid` = '$uid' AND `privacy` != 'draff' AND `lock` = 'yes' AND `did` = 'yes' AND `true` = 'true' ");
	$fWords = countRecord('promise', "`uid` = '$uid' AND `privacy` != 'draff' AND `did` = 'no' ");
	$sWords = countRecord('promise', "`uid` = '$uid' AND `privacy` != 'draff' AND `lock` = 'yes' AND `did` = 'yes' AND `true` = 'true' ");
	$lWords = countRecord('promise', "`uid` = '$uid' AND `privacy` != 'draff' AND `lock` = 'yes' AND `did` = 'yes' AND `true` = 'false' "); ?>

<!-- <? echo $uIn['username'] ?> profile -->

<div class="pf-bg-head">
	<img class="pf-avatar avatar-circle left" src="<? echo $uIn['avatar'] ?>"/>
	<h4><? echo $uIn['username'] ?></h4>
	<div class="pf-menu-bar">
	<? if (in_array($uid, $frAr)) echo '<a class="btn btn-success btn-perspective">Friend</a>';
	else if (in_array($uid, $frToAr)) echo '<a class="btn btn-info btn-perspective">Accept</a>';
	else if (in_array($uid, $frSAr)) echo '<a class="btn btn-default btn-perspective">Friend request sent</a>';
	else echo '<a class="btn btn-info btn-perspective">Add friend</a>'; ?>
	</div>
</div>

<div class="col-sm-4">
	<div class="the-box promise-sta">
		<div class="one-line">
			<b>Promised</b> <span class="label label-info right"><? echo $aWords ?></span>
		</div>
		<div class="one-line">
			<b>Promised made</b> <span class="label label-primary right"><? echo $sWords ?></span>
		</div>
		<div class="one-line">
			<b>Promised broke</b> <span class="label label-danger right"><? echo $fWords ?></span>
		</div>
		<div class="one-line">
			<b>Promised lied</b> <span class="label label-warning right"><? echo $lWords ?></span>
		</div>
	</div>
	<div class="the-box good-sta">
		<div class="one-line">
			<b>Good thing did</b> <span class="label label-primary right"><? echo $aWords ?></span>
		</div>
		<div class="one-line">
			<b>Requests needing help</b> <span class="label label-warning right"><? echo $sWords ?></span>
		</div>
		<div class="one-line">
			<b>Requests helped</b> <span class="label label-success right"><? echo $fWords ?></span>
		</div>
	</div>
	<div class="the-box friend-sta">
		<h4><? echo $uIn['username'] ?>'s friends</h4>
		<? for ($j = 0; $j < 12; $j++) {
			if ($frAru[$j]) {
			$ui = getRecord('members^username,avatar', "`id` = '{$frAru[$j]}' "); ?>
		<div class="avatar-friend-thumb left" title="<? echo $ui['username'] ?>">
			<a href="#!user?u=<? echo $frAru[$j] ?>">
				<img src="<? echo $ui['avatar'] ?>"/>
				<div class="friend-name"><? echo $ui['username'] ?></div>
			</a>
		</div>
		<? 	}
		} ?>
		<div class="clearfix"></div>
	</div>
</div>

<div class="col-sm-8">
	<? include 'views/userPost.php' ?>
</div>

<div class="clearfix">
</div>

<script src="<?php echo JS ?>/community.js"></script>
<script>$('.left-menu-column').hide()</script>
<style>.main-content{margin-left:0}
.statu{margin:10px 10px 20px 62px}</style>
