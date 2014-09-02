<?php
    # start a new PHP session
	include '../../../lib/config.php';
//    session_start();

	// we need to know it
	$CURRENT_URL = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	
	// change the following paths if necessary 
	$config   = dirname(__FILE__) . '/../../../hybridauth/config.php';
	require_once( "../../../hybridauth/Hybrid/Auth.php" );

	try{
		$hybridauth = new Hybrid_Auth( $config );
	}
	catch( Exception $e ){
		echo "Ooophs, we got an error: " . $e->getMessage();
	}

	$provider = ""; 
	
	// handle logout request
	if( isset( $_GET["logout"] ) ){
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
//			if ($_SESSION['user_id']) header('Location: ' . MAIN_URL);
		}

		// include authenticated user view
		include "inc_authenticated_user.php";
		
		die();
	} // if user connected to the selected provider 

	// if not, include unauthenticated user view
	include "inc_unauthenticated_user.php";
