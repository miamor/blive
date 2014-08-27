<?php include '../lib/config.php';
$uid = $_GET['u'];
$uInfo = getRecord('members^id,username,avatar', "`id` = '$uid' ");

if ($_GET['act'] == 'send') include 'system/chat.php';
else { ?>
<div class="chat-stick-one" data-u="<?php echo $uid ?>">
		<div class="chat-head">
			<ul class="nav nav-tabs">
<!--				<li class="chat-minimize"></li> -->
				<li class="chat-username"><? echo $uInfo['username'] ?></li>
<!--				<li class="tabs" id="about-tab"><a><span class="fa fa-question-circle"></span></a></li> -->
				<li class="dropdown chat-drop-li right">
					<a class="dropdown-toggle">
						<span class="fa fa-cog"></span> <span class="caret"></span>
					</a>
					<ul class="dropdown-menu info" role="menu">
						<li><a class="chat-video"><span class="fa fa-video-camera"></span> Video call</a></li>
						<li><a class="chat-add-friends"><span class="fa fa-users"></span> Add friends to chat</a></li>
						<li><a class="chat-poke"><span class="fa fa-"></span> Poke</a></li>
						<li class="divider"></li>
						<li><a class="chat-mute"><span class="fa fa-microphone-slash"></span> Mute</a></li>
					</ul>
				</li>
			</ul>
		</div>
		
		<div class="chat-body">
			<div class="chat-content">
				<?php include 'views/chatContent.php' ?>
			</div>
			<form class="chat-submit" method="post" id="form<?php echo $uid ?>">
<!--				<input type="text" placeholder="Write something..." name="chat-content-<?php echo $uid ?>" class="chat-text non-sce"/> -->
				<textarea placeholder="Write something..." name="chat-content-<?php echo $uid ?>" class="chat-text non-sce"></textarea>
				<div class="chat-form-buttons">
					<div class="fa fa-smile-o"></div>
					<div class="fa fa-camera-retro"></div>
				</div>
			</form>
		</div>
</div>
<?php } ?>
