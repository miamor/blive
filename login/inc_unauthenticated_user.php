<?	try{ 
		$hybridauth = new Hybrid_Auth( $config );
	}
	// if sometin bad happen
	catch (Exception $e) {
		$message = ""; 
		
		switch( $e->getCode() ){ 
			case 0 : $message = "Unspecified error."; break;
			case 1 : $message = "Hybriauth configuration error."; break;
			case 2 : $message = "Provider not properly configured."; break;
			case 3 : $message = "Unknown or disabled provider."; break;
			case 4 : $message = "Missing provider application credentials."; break;
			case 5 : $message = "Authentication failed. The user has canceled the authentication or the provider refused the connection."; break;

			default: $message = "Unspecified error!";
		}
?>
<style>
PRE {
	background:#EFEFEF none repeat scroll 0 0;
	border-left:4px solid #CCCCCC;
	display:block;
	padding:15px;
	overflow:auto;
	width:740px;
}
HR {
	width:100%;
	border: 0;
	border-bottom: 1px solid #ccc; 
	padding: 50px;
}
</style>
<div class="alerts alert-error">
	<h3>Something bad happen!</h3>
	<?php echo $message ; ?>
		<b>Exception</b>: <?php echo $e->getMessage() ; ?>
		<pre><?php echo $e->getTraceAsString() ; ?></pre>
</div>
<?php 
		// diplay error and RIP
		die();
	}

	$provider  = @ $_GET["provider"];
	$return_to = @ $_GET["return_to"];
	
	if( ! empty( $provider ) && $hybridauth->isConnectedWith( $provider ) )
	{
		$return_to = $return_to . ( strpos( $return_to, '?' ) ? '&' : '?' ) . "connected_with=" . $provider ;
?>
<script language="javascript"> 
	if(  window.opener ){
		try { window.opener.parent.$.colorbox.close(); } catch(err) {} 
		window.opener.parent.location.href = "<?php echo $return_to; ?>";
	}

	window.self.close();
</script>
<?php
		die();
	}

	if( ! empty( $provider ) )
	{
		$params = array();

		if( $provider == "OpenID" ){
			$params["openid_identifier"] = @ $_REQUEST["openid_identifier"];
		}

		if( isset( $_REQUEST["redirect_to_idp"] ) ){
			$adapter = $hybridauth->authenticate( $provider, $params );
		}
		else{
			// here we display a "loading view" while tryin to redirect the user to the provider
?>
<div align="center" class="loading">
	<div class="spinner"> <div></div> <div></div> <div></div> </div>
	<h3>Loading...</h3>
	<b><?php echo ucfirst( strtolower( strip_tags( $provider ) ) ) ; ?></b>. Please wait.
</div>
<script>
	window.location.href = window.location.href + "&redirect_to_idp=1";
</script>
<?php
		}

		die();
	}
?>

	<style>
		.idpico{
			cursor: pointer;
			cursor: hand;
		}
		#openidm{
			margin: 7px;
		}
	</style>

<? 	if (!$return_to || !$_GET['provider']) { ?>

<div class="page-content">
	<div class="row full-width full">
		<div class="col-sm-4 right social-login" id="idps">
			<a idp="facebook" id="login-facebook" class="btn btn-facebook btn-block idpicos"><i class="fa fa-facebook"></i> Login with facebook</a>
<!--			<a idp="facebook" class="btn btn-facebook btn-block idpico"><i class="fa fa-facebook"></i> Login with facebook</a> -->
			<a idp="twitter" class="btn btn-twitter btn-block idpico"><i class="fa fa-twitter"></i> Login with twitter</a>
			<a idp="google" class="btn btn-google-plus btn-block idpico"><i class="fa fa-google-plus"></i> Login with google</a>
			<a idp="flickr" class="btn btn-flickr btn-block idpico"><i class="fa fa-flickr"></i> Login with flickr</a>
			<a idp="linkedin" class="btn btn-linkedin btn-block idpico"><i class="fa fa-linkedin"></i> Login with linkedin</a>
<!--			<a idp="yahoo" class="btn btn-google-plus btn-block idpico"><i class="fa fa-google-plus"></i> Login with yahoo</a>
			<a idp="blogger" class="btn btn-google-plus btn-block idpico"><i class="fa fa-google-plus"></i> Login with blogger</a>
			<a idp="wordpress" class="btn btn-google-plus btn-block idpico"><i class="fa fa-google-plus"></i> Login with wordpress</a>
			<a idp="livejournal" class="btn btn-google-plus btn-block idpico"><i class="fa fa-google-plus"></i> Login with livejournal</a>
-->		</div>
		<div class="col-sm-4 right social-login" align="center" id="openidid" style="display:none;padding-top:30px">
			<img id="openidimg" src="images/loading.gif" />
			<h4 id="openidm">Please enter your user or blog name</h4>
			<input type="text" name="openidun" id="openidun"/>
			<input class="btn" type="submit" value="Login" id="openidbtn" style="height:33px;width:85px;margin-top:10px" />
			<br />
			<small><a href="#" id="backtolist">back</a></small>
		</div>
		<div class="col-sm-8">
			<div class="front-login front-signin statu">
				<h2>Already a member?</h2>
				<form id="login" method="post" action="./login.php?act=login">
					<input type="text" name="username" tabindex="1" class="text text-input" placeholder="Username" style="width:100%;margin-bottom:5px"><br/>
					<input type="submit" name="submit" tabindex="3" class="btn btn-primary login-button" value="Login" style="float:right;margin:2px">
					<input type="password" name="password" tabindex="2" class="text text-input" placeholder="Password" style="width:67%;margin-bottom:10px">
				</form>
				<div class="form-bottom">
					<a class="forgot-password">Forgot password?</a>
					<a class="btn btn-warning right">Register</a>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="front-copyright statu">
		<div class="copyright">
			<div class="c-info">© 2013 blive. All rights reserved.
			<div class="c-links right">
				<a href="<?php echo MAIN_URL ?>/about">About</a> <a href="<?php echo MAIN_URL ?>/help">Help</a> <a href="<?php echo MAIN_URL ?>/terms">Terms</a> <a href="<?php echo MAIN_URL ?>/privacy">Privacy</a>
				<a href="<?php echo MAIN_URL ?>/advertise">Advertise</a> <a href="<?php echo MAIN_URL ?>/resource">Resources</a> <a href="<?php echo MAIN_URL ?>/developers">Developers</a>
				</div>
			</div>
			<div class="developer"><a href="<?php echo MAIN_URL ?>/user.php?u=1">Miamor West</a></div>
		</div>
	</div>
</div>

<? } ?>
