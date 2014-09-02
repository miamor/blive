<?php
    # start a new PHP session
//    session_start();

	include 'lib/config.php';
	// we need to know it
	$CURRENT_URL = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	
	// change the following paths if necessary 
	$config   = 'login/hybridauth/config.php';
	require_once("login/hybridauth/Hybrid/Auth.php" );

	try{
		$hybridauth = new Hybrid_Auth( $config );
	}
	catch (Exception $e) {
		echo "Ooophs, we got an error: " . $e->getMessage();
	}

	$provider = ""; 
	
	// handle logout request
	if (isset( $_GET["logout"])) {
		$provider = $_GET["logout"];

		$adapter = $hybridauth->getAdapter( $provider );

		$adapter->logout();
		
		header( "Location: index.php"  );
		
		die();
	}

	// if the user select a provider and authenticate with it 
	// then the widget will return this provider name in "connected_with" argument 
	else if ( isset( $_GET["connected_with"] ) && $hybridauth->isConnectedWith( $_GET["connected_with"] ) ) {
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
	} // if user connected to the selected provider 

	// if not, include unauthenticated user view
?>

	<center>
		<h1>A simple login Widget integration</h1>
		<br />
		<br /> 
		<table width="380" border="0" cellpadding="2" cellspacing="2">
		  <tr>
			<td valign="top"><fieldset>
				<legend>Sign-in form</legend>
				<table width="00%" border="0" cellpadding="2" cellspacing="2">
				  <tr>
					<td><div align="right"><strong>login</strong></div></td>
					<td><input type="text" name="textfield" id="textfield" /></td>
				  </tr>
				  <tr>
					<td><div align="right"><strong>password</strong></div></td>
					<td><input type="text" name="textfield2" id="textfield2" /></td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td><div align="center">
						<input type="submit" value="Um supposed to be a Submit button, but i do nothing :)" />
					  </div></td>
				  </tr>
				</table>
			  </fieldset></td>
		  </tr>
		  <tr>
			<td valign="top" align="right">
				<img src="arrow.gif" align="texttop" style="margin-top:-5px;" >
				<!-- CODE REQUIRED BY THE WIDGET -->
					<link media="screen" rel="stylesheet" href="../widget/css/colorbox.css" />
					<script src="../widget/js/jquery.min.js"></script>
					<script src="../widget/js/jquery.colorbox.js"></script> 
					<script>
						$(document).ready(function(){
							$(".widget_link").colorbox({iframe:true, innerWidth:430, innerHeight:222});
						}); 
					</script>
				<!-- /WIDGET -->
				<!-- 
					LINK TO THE WIDGET 
						return_to: call back this page after authenticatin the user
						ts: nocache
				--> 
					<a href="login/?_ts=<?php echo time(); ?>&return_to=<?php echo urlencode( $CURRENT_URL ); ?>" class='widget_link' title="HybridAuth Social Sign On Widget">Or sign-in with another identity provider</a>
			</td>
		  </tr>
		</table> 
		<br /><br /><br />
		<b>Note:</b> This is just a proof of concept! it works good enough to try out on Firefox or on Chrome.
	</center> 
