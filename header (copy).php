<? header("Content-Type: text/html; charset=UTF-8");
require_once 'lib/config.php' ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="description" content="8dot, effective eLearning site">
		<meta name="keywords" content="8dot,eLearning,social">
		<meta name="author" content="Miamor West">
		<title>Keep your words</title>
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMG ?>/color.ico"/>

		<!-- BOOTSTRAP CSS (REQUIRED ALL PAGE)-->
		<link rel="stylesheet" href="assets/css/_bootstrap.min.css">
<!--		<link rel="stylesheet" href="assets/css/font.css"> -->
		<link rel="stylesheet" href="assets/plugins/flat-ui/css/flat-ui.css"/>
		<link rel="stylesheet" href="assets/plugins/chosen/chosen.min.css">
		<!-- MAIN CSS (REQUIRED ALL PAGE)-->
		<link rel="stylesheet" href="assets/css/style.css"/>
 		<link rel="stylesheet" href="assets/css/main.css"/>
		<link rel="stylesheet" href="assets/plugins/sceditor/minified/themes/default.min.css"/>
		<!-- FONT CSS -->
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
<? 		echo '<script> var MAIN_URL = "'.MAIN_URL.'"</script>' ?>
	</head>
 
	<body class="tooltips">
	
		<div class="topbar">
			<div class="navbar">
				<a class=""><span class="fa fa-th"></span></a>
				<li class="active"><a>Home</a></li>
				<li><a>Resources</a></li>
			</div>
		</div>
				
			<div class="user-info-fixed">
				<div class="user-right-bar">
<!--					<div class="btn btn-square btn-primary"><span class="fa fa-bell"></span></div>
					<div class="btn btn-square btn-info"><span class="fa fa-bell"></span></div>
					<div class="btn btn-square btn-success"><span class="fa fa-bell"></span></div>
					<div class="btn btn-square btn-warning"><span class="fa fa-bell"></span></div>
					<div class="btn btn-square btn-danger"><span class="fa fa-bell"></span></div> -->
					<a class="one-square"><span class="fa fa-bell"></span> <? if ($notiNum) echo '<span class="badge badge-primary">'.$notiNum.'</span>' ?></a>
					<div class="leftPopup left-caret dark-caret notificationPopup">
						<div class="popTop">Notifications <a class="popClose">x</a></div>
						<div class="popContainer notiContainer">
							<? include 'pages/views/notification.php' ?>
						</div>
					</div>

					<a class="one-square"><span class="fa fa-comments"></span> <span class="badge badge-danger">2</span></a>
					<div class="leftPopup left-caret dark-caret messagePopup">
						<div class="popTop">Messages <a class="popClose">x</a></div>
						<div class="popContainer notiContainer">
							<li>
							</li>
						</div>
					</div>

					<a class="one-square last-square"><span class="fa fa-user"></span> <span class="badge badge-info">2</span></a>
					<div class="leftPopup left-caret dark-caret frRequestPopup">
						<div class="popTop">Friend requests <a class="popClose">x</a></div>
						<div class="popContainer notiContainer">
							<li>
							</li>
						</div>
					</div>

					<a class="one-square cog-square last active"><span class="fa fa-cog"></span></a>
					<div class="leftPopup up-caret dark-caret profilePopup">
						<div class="popTop"><? echo $glob_displayName ?> <a class="popClose">x</a></div>
						<div class="popContainer">
							<li><a href="#!user?u=<? echo $u ?>">View profile</a></li>
							<li><a href="#!profile">Edit profile</a></li>
						</div>
					</div>
				</div>
				<img class="user-avatar" src="<? echo $member['avatar'] ?>"/>
				<div class="user-name">
					<? echo $glob_displayName ?>
				</div>
			</div>

		<div class="left-sidebar sidebar-nicescroller no-width">
			<div class="switch-menu">
				<li id="promise" class="active" title="Promise" data-placement="right"><span class="fa fa-cloud"></span></li>
				<li id="ask" title="Ask" data-placement="right"><span class="fa fa-cloud"></span></li>
			</div>
			<div class="user-quick-sta" id="promise">
				<li id="all" title="All" data-placement="right"><span class="fa fa-cloud"></span> All <? if ($aWords > 0) echo '<span class="badge badge-primary">'.$aWords.'</span>' ?></li>
				<li id="waiting"><span class="fa fa-tags"></span> Awaiting <? if ($wWords > 0) echo '<span class="badge badge-warning">'.$wWords.'</span>' ?></li>
				<li id="success"><span class="fa fa-tags"></span> Succeeded <? if ($sWords > 0) echo '<span class="badge badge-success">'.$sWords.'</span>' ?></li>
				<li id="fail"><span class="fa fa-tasks"></span> Failed <? if ($fWords > 0) echo '<span class="badge badge-danger">'.$fWords.'</span>' ?></li>
				<li id="open" class="active"><span class="fa fa-coffee"></span> Opened <? if ($oWords > 0) echo '<span class="badge badge-info">'.$oWords.'</span>' ?></li>
				<li id="lock"><span class="fa fa-lock"></span> Locked <? if ($lWords > 0) echo '<span class="badge badge-default">'.$lWords.'</span>' ?></li>
				<li id="draff" class="last"><span class="fa fa-trash-o"></span> Draff <? if ($dWords > 0) echo '<span class="badge badge-default">'.$dWords.'</span>' ?></li>
			</div>
			<div class="user-quick-sta hide" id="ask">
				<li id="all" title="All" data-placement="right"><span class="fa fa-cloud"></span> All <? if ($aAsk > 0) echo '<span class="badge badge-primary">'.$aAsk.'</span>' ?></li>
				<li id="answered" title="Answered" data-placement="right"><span class="fa fa-tags"></span> Answered <? if ($anAsk > 0) echo '<span class="badge badge-success">'.$anAsk.'</span>' ?></li>
				<li id="unanswered" class="last" title="Unanswered" data-placement="right"><span class="fa fa-tags"></span> Unanswered <? if ($uAsk > 0) echo '<span class="badge badge-warning">'.$uAsk.'</span>' ?></li>
			</div>
		</div>

<div class="page-content">
		<div class="left-menu-column sidebar-nicescroller" id="left-sidebar">
			<? include 'pages/views/promiseForm.php' ?>
<!--			<div class="overflow-scroll" id="left-content">
			</div>
-->		</div>

		<div class="right-sidebar sidebar-nicescroller">
			<div class="top-section">
				<span class="s-title"><span class="fa fa-chevron-left toggle-chat-area"></span> <span class="toggle-form">Chat</span></span>
			</div>
			<div class="overflow-scroll" id="right-content">
				<div class="friend-list">
					<? include 'pages/views/friendList.php' ?>
				</div>
			</div>
		</div>
		<div class="chat-area hide">
		</div>
		
		<div class="chat-stick"></div>
		
		<div class="main-content sidebar-nicescroller">
			<div class="overflow-scroll" id="content">
