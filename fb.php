<? //include 'header.php'
include 'lib/config.php' ?>

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
		<link rel="stylesheet" href="assets/plugins/flat-ui/css/flat-ui.css"/>
		<link rel="stylesheet" href="assets/plugins/chosen/chosen.min.css">
		<!-- MAIN CSS (REQUIRED ALL PAGE)-->
		<link rel="stylesheet" href="assets/css/style.css"/>
 		<link rel="stylesheet" href="assets/css/main.css"/>
		<link rel="stylesheet" href="assets/plugins/sceditor/minified/themes/default.min.css"/>
		<!-- FONT CSS -->
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
<? 		echo '<script>var MAIN_URL = "'.MAIN_URL.'"</script>'; ?>
	</head>
 
	<body class="tooltips">


<?
use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookCurl;
use Facebook\HttpClients\FacebookCurlHttpClient;

use Facebook\Entities\AccessToken;
use Facebook\Entities\SignedRequest;

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookOtherException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphSessionInfo;


if ( !isset( $session ) || $session === null ) {
  try {
    $session = $helper->getSessionFromRedirect();
  } catch( FacebookRequestException $ex ) {
    print_r( $ex );
  } catch( Exception $ex ) {
    print_r( $ex );
  }
  
}

if ( isset( $session ) ) {
	$_SESSION['fb_token'] = $session->getToken();
	$session = new FacebookSession( $session->getToken() );
  
	$request = new FacebookRequest( $session, 'GET', '/me' );
	$response = $request->execute();
	$graphObject = $response->getGraphObject()->asArray();

	$userAvatar = 'https://graph.facebook.com/'.$graphObject['id'].'/picture?width=150&height=150';
	$tokenID = $_SESSION['fb_token'];
  
	if ($userAvatar) $avatar = $userAvatar;
	else $avatar = 'avatar.jpg';
		$checkLogin = false;
		if (countRecord('members', "`email` = '{$graphObject['email']}' AND `oauth_uid` = '{$graphObject['id']}' AND `oauth_provider` = 'facebook' ") <= 0) {
			$add = insert('members', "`username`, `avatar`, `gender`, `name`, `email`, `oauth_uid`, `oauth_provider`, `token`, `time`", " '{$graphObject['name']}', '{$avatar}', '{$gender}', '{$graphObject['name']}', '{$graphObject['email']}', '{$graphObject['id']}', 'facebook', '{$tokenID}', '{$curint}' ");
			if ($add) $checkLogin = true;
		} else {
			echo $tokenID.'~~~~~~';
			$change = changeValue('members', "`email` = '{$graphObject['email']}' AND `oauth_uid` = '{$graphObject['id']}' AND `oauth_provider` = 'facebook' ", "`token` = '{$tokenID}' ");
			if ($change) $checkLogin = true;
		}
		if ($checkLogin == true) {
			$member = getRecord('members', "`email` = '{$graphObject['email']}' AND `oauth_uid` = '{$graphObject['id']}' AND `oauth_provider` = 'facebook' AND `token` = '{$tokenID}' ");
			$_SESSION['user_id'] = $member['id'];
			$_SESSION['user_admin'] = $member['admin'];
//			if ($_SESSION['user_id']) header('Location: ' . MAIN_URL);
		}

	echo '<pre>' . print_r( $graphObject, 1 ) . '</pre>';
  
	echo '<a href="' . $helper->getLogoutUrl( $session, 'http://yourwebsite.com/app/logout.php' ) . '">Logout</a>';

	if ($_GET['act'] == 'submit') {
		$mes = $_POST['status'];
		$response = (new FacebookRequest(
			$session, 'POST', '/me/feed', array(
				'message' 	=> $mes,
				'link' 		=> MAIN_URL.'/promise.php?i='.$iid
			)
		))->execute()->getGraphObject()->asArray();
		print_r( $response );
	} else echo '<form method="post" action="./fb.php?act=submit">
		<textarea name="status"></textarea>
		<input type="submit" value="Submit"/>
	</form>'; ?>
<script language="javascript"> 
	if (window.opener) {
		try { window.opener.parent.$.colorbox.close(); } catch(err) {} 
		window.opener.parent.location.href = MAIN_URL;
	}
	window.self.close();
</script>
<? } else {
//	echo '<a href="' . $helper->getLoginUrl( array( 'email', 'user_friends' ) ) . '">Login</a>'; ?>
<div align="center" class="loading">
	<div class="spinner"> <div></div> <div></div> <div></div> </div>
	<h3>Loading...</h3>
	<b>Facebook</b>. Please wait.
</div>
<script>window.location.href = '<? echo $helper->getLoginUrl(array( 'email', 'user_friends' )) ?>' </script>
<? 	//header('Location: '.$helper->getLoginUrl( array( 'email', 'user_friends' ) ));
} ?>

	</body>
</html>
