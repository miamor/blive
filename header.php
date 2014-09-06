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
		<link rel="stylesheet" href="assets/plugins/meditor/jquery.meditor.css"/>
		<link rel="stylesheet" href="assets/plugins/owl-carousel/owl.carousel.min.css">
		<link rel="stylesheet" href="assets/plugins/owl-carousel/owl.theme.min.css">
		<link rel="stylesheet" href="assets/plugins/owl-carousel/owl.transitions.min.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
		<!-- FONT CSS -->
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
<? 		echo '<script>var MAIN_URL = "'.MAIN_URL.'"</script>';
		if (!$u && checkURL('about') <= 0 && checkURL('register') <= 0 && checkURL('login') && checkURL('fb') <= 0)
			echo '<script>window.location.href = "./about.php"</script>'; ?>
	</head>
 
	<body class="tooltips">
		<div class="topbar">
			<div class="navbar">
				<a class=""><span class="fa fa-th"></span></a>
				<li class="active"><a href="#!">Home</a></li>
				<li><a href="#!promise">Promises</a></li>
				<li><a href="#!request">Requests</a></li>
				<li><a>Resources</a></li>
			</div>
			<div class="noti-right-bar right">
				<ul class="nav-user navbar-left">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown">
							<? if ($notiNums > 0) echo '<span class="badge badge-primary icon-count">'.$notiNums.'</span>' ?>
							<i class="fa fa-globe" style="font-size:17px"></i>
						</a>
						<ul class="dropdown-menu pull-right square with-triangle">
							<li>
								<div class="nav-dropdown-heading">
									Notifications
								</div>
								<div class="nav-dropdown-content scroll-nav-dropdown">
									<ul class="notification-load">
										<? include 'pages/views/notification.php' ?>
									</ul>
								</div>
								<button class="btn btn-primary btn-square btn-block">See all notifications</button>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="user-right-bar">
				<ul class="nav-user navbar-right">
					<li class="dropdown">
						  <a class="dropdown-toggle" data-toggle="dropdown">
							<img src="<? echo $member['avatar'] ?>" class="avatar img-circle">
							Hi, <strong><? echo $member['username'] ?></strong>
						</a>
						<ul class="head-dropdown dropdown-menu square primary margin-list-rounded with-triangle">
							<li class="one-account current-account">
								<img class="head-info-ava left" src="<? echo $member['avatar'] ?>"/>
								<div class="account-info">
									<span style="margin-top:6px" class="right label label-default">Elita</span>
									<div style="height:31px">
										<a href="#!user?u=<? echo $u ?>"><h3 class="text-primary left"><? echo $member['username'] ?></h3></a>
										<div class="left" style="margin:-4px 5px"><a class="gensmall" href="#!information"><i class="fa fa-edit"></i></a></div>
									</div>
									<div title="Exp: 0%" class="progress progress-sm progress-striped active">
										<div class="progress-bar progress-bar-default" style="width: 0%">
											<div class="small"></div>
										</div>
									</div>
									<div class="exp-coin">
										<div class="left" style="width:120px"><img style="margin-top:-2px" src="assets/img/dollar_coin.png"> 0</div>
										<div class="left"><img style="margin-top:-3px" src="assets/img/famfamfam/silk/coins.png"> 0</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="clearfix"></div>
							</li>
							<div class="head-dropdown-bottom">
								<a class="head-dropdown-button btn-primary left" href="#!newaccount"><span class="fa fa-plus"></span> New account</a>
								<a class="head-dropdown-button btn-danger right" href="#!logout"><span class="fa fa-sign-out"></span> Log out</a>
								<a class="head-dropdown-button btn-warning right" style="margin-right:5px" href="#!lock"><span class="fa fa-lock"></span> Lock screen</a>
								<div class="clearfix"></div>
							</div>
						</ul>
					</li>
				</ul>
			</div>
		</div>

<div class="page-content">
		<div class="left-menu-column" id="left-sidebar">
			<? include 'pages/views/promiseForm.php' ?>
<!--			<div class="switch-menu">
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
-->
		</div>

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

		<div class="hide small-board sb-logout"></div>
		<div class="hide small-board sb-like-list"></div>
		<div class="hide small-board sb-stt-likelist"></div>

<!--		<input type="text"/>
		<input type="submit"/>
		<a class="btn">Btn</a>
-->		
		<div class="main-content">
			<div class="overflow-scroll" id="content">
