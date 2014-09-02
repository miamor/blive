<?php include '../lib/config.php';
if ($u) header('Location: '.MAIN_URL);
else { ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="description" content="8dot, effective eLearning site">
		<meta name="keywords" content="8dot,eLearning,social">
		<meta name="author" content="Miamor West">
		<title>8dot</title>
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMG ?>/8dot.png"/>

		<!-- BOOTSTRAP CSS (REQUIRED ALL PAGE)-->
		<link rel="stylesheet" href="../assets/css/_bootstrap.min.css">
		<link rel="stylesheet" href="../assets/plugins/flat-ui/css/flat-ui.css"/>
		<!-- MAIN CSS (REQUIRED ALL PAGE)-->
		<link rel="stylesheet" href="../assets/css/style.css">
		<link rel="stylesheet" href="../assets/css/main.css">
		<link rel="stylesheet" href="../assets/css/login.css">
		<!-- FONT CSS -->
		<link rel="stylesheet" href="../assets/plugins/font-awesome/css/font-awesome.min.css">
<? 		echo '<script> var MAIN_URL = "'.MAIN_URL.'"</script>' ?>
	</head>
 
	<body class="tooltips">

<? 	$CURRENT_URL = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

	$config = 'hybridauth/config.php';
	require_once("hybridauth/Hybrid/Auth.php");

	try {
		$hybridauth = new Hybrid_Auth( $config );
	}
	catch (Exception $e) {
		echo "Ooophs, we got an error: " . $e->getMessage();
	}
	$provider = ""; 
	if (isset( $_GET["logout"])) {
		$provider = $_GET["logout"];
		$adapter = $hybridauth->getAdapter( $provider );
		$adapter->logout();
		header('Location: '.MAIN_URL.'/about.php');
		die();
	} else if (isset( $_GET["connected_with"] ) && $hybridauth->isConnectedWith( $_GET["connected_with"])) {
		$provider = $_GET["connected_with"];
		$adapter = $hybridauth->getAdapter( $provider );
		$user_data = $adapter->getUserProfile();
		if ($user_data->photoURL) $avatar = $user_data->photoURL;
		else $avatar = 'avatar.jpg';
		$checkLogin = false;
		if (countRecord('members', "`email` = '{$user_data->email}' AND `oauth_uid` = '{$user_data->identifier}' AND `oauth_provider` = '{$adapter->id}' ") <= 0) {
			$add = insert('members', "`username`, `avatar`, `gender`, `name`, `email`, `oauth_uid`, `oauth_provider`", " '{$user_data->displayName}', '{$avatar}', '', '{$user_data->displayName}', '{$user_data->email}', '{$user_data->identifier}', '{$adapter->id}' ");
			if ($add) $checkLogin = true;
		} $checkLogin = true;
		if ($checkLogin == true) {
			$member = getRecord('members', "`email` = '{$user_data->email}' AND `oauth_uid` = '{$user_data->identifier}' AND `oauth_provider` = '{$adapter->id}' ");
			$_SESSION['user_id'] = $member['id'];
			$_SESSION['user_admin'] = $member['admin'];
			if ($_SESSION['user_id']) header('Location: ' . MAIN_URL);
		}
		// include authenticated user view
		include "inc_authenticated_user.php";
		die();
	}

	include "inc_unauthenticated_user.php";
?>

<script>function start_auth (params) {
	start_url = params + "&return_to=<?php echo urlencode($return_to); ?>" + "&_ts=" + (new Date()).getTime();
	window.open(
		start_url, 
		"hybridauth_social_sing_on", 
		"location=0,status=0,scrollbars=0,width=800,height=500"
	);  
}</script>
		<!-- JQUERY (REQUIRED ALL PAGE)-->
		<script src="<?php echo JQUERY ?>/jquery-1.7.2.min.js"></script>
		<script src="<?php echo JQUERY ?>/jquery-ui-1.10.4.js"></script>
		<!-- LOGIN JS -->
		<script src="<?php echo JS ?>/login.js"></script>

<style>
</style>

	</body>
</html>
<? } ?>
