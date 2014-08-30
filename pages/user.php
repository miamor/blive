<? include '../lib/config.php';
include 'system/user.php';
$uIn = getRecord('members', "`id` = '$uid' OR `username` = '$uid' ");
$uid = $uIn['id']; ?>

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

<div class="" id="m_tab">
	<div class="m_tab">
		<div class="tab active" id="timeline">Timeline</div>
		<div class="tab" id="friends">Friends</div>
	</div>

	<div class="tab-index timeline">
		<? include 'views/userPost.php' ?>
	</div>
</div>

<script src="<?php echo JS ?>/community.js"></script>
<style>.pagination{display:none}
.main-content{margin-left:0}
.statu{margin:10px 10px 20px 62px}</style>
