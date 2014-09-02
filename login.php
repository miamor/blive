<?php include 'lib/config.php';
header('Location: ./login'); ?>
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
		<link rel="stylesheet" href="assets/css/_bootstrap.min.css">
		<link rel="stylesheet" href="assets/plugins/flat-ui/css/flat-ui.css"/>
		<!-- MAIN CSS (REQUIRED ALL PAGE)-->
		<link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/css/main.css">
		<link rel="stylesheet" href="assets/css/login.css">
		<!-- FONT CSS -->
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
<? 		echo '<script> var MAIN_URL = "'.MAIN_URL.'"</script>' ?>
	</head>
 
	<body class="tooltips">

<? if ( !$u ) {
	if ( $_GET['act'] == "login" ) {
		// Dùng hàm addslashes() để tránh SQL injection, dùng hàm md5() để mã hóa password
		$username = addslashes( $_POST['username'] );
		$password = md5( addslashes( $_POST['password'] ) );
		$pass = addslashes( $_POST['password'] );
		// Lấy thông tin của username đã nhập trong table members
		$sql_query = @mysql_query("SELECT * FROM `members` WHERE `username` = '{$username}' AND `password` = '{$pass}' ");
		$member = @mysql_fetch_array( $sql_query );
		// Nếu username này không tồn tại thì....
		if ( mysql_num_rows( $sql_query ) <= 0 ) {
			echo 'error';
		}
		// Nếu username này tồn tại thì tiếp tục kiểm tra mật khẩu
		if ( $pass != $member['password'] ) {
			echo 'error';
		}
		// Khởi động phiên làm việc (session)
		$_SESSION['user_id'] = $member['id'];
		$_SESSION['user_admin'] = $member['admin'];
		// Thông báo đăng nhập thành công
		echo $_SESSION['user_id'];
	} else { ?>

<div class="page-content">
	<div class="row full-width full">
		<div class="col-sm-4 right social-login">
			<a id="login-twitter" class="btn btn-twitter btn-block"><i class="fa fa-twitter"></i> Login using twitter</a>
			<a id="login-facebook" class="btn btn-facebook btn-block"><i class="fa fa-facebook"></i> Login with facebook</a>
			<a id="login-google" class="btn btn-google-plus btn-block"><i class="fa fa-google-plus"></i> Login with google</a>
<script>function start_auth (params) {
	start_url = params + "&return_to=<?php echo urlencode($return_to); ?>" + "&_ts=" + (new Date()).getTime();
	window.open(
		MAIN_URL + '/login/examples/widget_authentication/widget' + start_url, 
		"hybridauth_social_sing_on", 
		"location=0,status=0,scrollbars=0,width=800,height=500"
	);  
}</script>
<?	$config = 'login/hybridauth/config.php';
	require_once("login/hybridauth/Hybrid/Auth.php");

	try {
		$hybridauth = new Hybrid_Auth($config);
	} 
	catch (Exception $e) {
		$message = ""; 
		switch ($e->getCode()) {
			case 0 : $message = "Unspecified error."; break;
			case 1 : $message = "Hybriauth configuration error."; break;
			case 2 : $message = "Provider not properly configured."; break;
			case 3 : $message = "Unknown or disabled provider."; break;
			case 4 : $message = "Missing provider application credentials."; break;
			case 5 : $message = "Authentication failed. The user has canceled the authentication or the provider refused the connection."; break;

			default: $message = "Unspecified error!";
		}
?>
		<b>Exception</b>: <?php echo $e->getMessage() ; ?>
		<pre><?php echo $e->getTraceAsString() ; ?></pre>
<?php 
		// diplay error and RIP
		die();
	}

	$provider  = @ $_GET["provider"];
	$return_to = @ $_GET["return_to"];
	
	if (!$return_to) echo "Invalid params!";

	if (! empty( $provider ) && $hybridauth->isConnectedWith($provider)) {
		$return_to = $return_to . ( strpos( $return_to, '?' ) ? '&' : '?' ) . "connected_with=" . $provider ; ?>
<script language="javascript"> 
	if (window.opener) {
		try { window.opener.parent.$.colorbox.close(); } catch(err) {} 
		window.opener.parent.location.href = "<?php echo $return_to; ?>";
	}

	window.self.close();
</script>
<?php
		die();
	}

	if (! empty( $provider )) {
		$params = array();
		if ($provider == "OpenID") $params["openid_identifier"] = @ $_REQUEST["openid_identifier"];
		if (isset($_REQUEST["redirect_to_idp"])) $adapter = $hybridauth->authenticate( $provider, $params );
		else {
			// here we display a "loading view" while tryin to redirect the user to the provider
?>
<table width="100%" border="0">
  <tr>
    <td align="center" height="190px" valign="middle"><img src="images/loading.gif" /></td>
  </tr>
  <tr>
    <td align="center"><br /><h3>Loading...</h3><br /></td> 
  </tr>
  <tr>
    <td align="center">Contacting <b><?php echo ucfirst( strtolower( strip_tags( $provider ) ) ) ; ?></b>. Please wait.</td> 
  </tr> 
</table>
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
			<div id="idps">
				<table width="100%" border="0">
				  <tr>
					<td align="center"><img class="idpico" idp="google" src="images/icons/google.png" title="google" /></td>
					<td align="center"><img class="idpico" idp="twitter" src="images/icons/twitter.png" title="twitter" /></td>
					<td align="center"><img class="idpico" idp="facebook" src="images/icons/facebook.png" title="facebook" /></td>
					<td align="center"><img class="idpico" idp="openid" src="images/icons/openid.png" title="openid" /></td>  
				  </tr>
				  <tr>
					<td align="center"><img class="idpico" idp="yahoo" src="images/icons/yahoo.png" title="yahoo" /></td>
					<td align="center"><img class="idpico" idp="flickr" src="images/icons/flickr.png" title="flickr" /></td>
					<td align="center"><img class="idpico" idp="linkedin" src="images/icons/linkedin.png" title="linkedin" /></td>
				  </tr>
				  <tr> 
					<td align="center"><img class="idpico" idp="blogger" src="images/icons/blogger.png" title="blogger" /></td> 
					<td align="center"><img class="idpico" idp="wordpress" src="images/icons/wordpress.png" title="wordpress" /></td>
					<td align="center"><img class="idpico" idp="livejournal" src="images/icons/livejournal.png" title="livejournal" /></td>  
				  </tr>
				</table> 
			</div>
			<div id="openidid" style="display:none;">
				<table width="100%" border="0">
				  <tr> 
					<td align="center"><img id="openidimg" src="images/loading.gif" /></td>
				  </tr>  
				  <tr> 
					<td align="center"><h3 id="openidm">Please enter your user or blog name</h3></td>
				  </tr>  
				  <tr>
					<td align="center"><input type="text" name="openidun" id="openidun" style="padding: 5px; margin:7px;border: 1px solid #999;width:240px;" /></td>
				  </tr>
				  <tr>
					<td align="center">
						<input type="submit" value="Login" id="openidbtn" style="height:33px;width:85px;" />
						<br />
						<small><a href="#" id="backtolist">back</a></small>
					</td>
				  </tr>
				</table> 
			</div>
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

<?php }
 } else {
	echo '<script>window.location.href = "./"</script>';
} ?>

		<!-- JQUERY (REQUIRED ALL PAGE)-->
		<script src="<?php echo JQUERY ?>/jquery-1.7.2.min.js"></script>
		<script src="<?php echo JQUERY ?>/jquery-ui-1.10.4.js"></script>
		<!-- LOGIN JS -->
		<script src="<?php echo JS ?>/login.js"></script>

<!--		<div class="backstretch" style="left: 0px; top: 0px; overflow: hidden; margin: 0px; padding: 0px; height: 100%; width: 100%; z-index: -999999; position: fixed;"><img style="position: absolute; margin: 0px; padding: 0px; border: none; width: 100%; height: 100%; max-height: none; max-width: none; z-index: -999999; left: 0px; top: 0;" src="assets/img/photo/large/img-14.jpg"></div> -->
		
<style>
</style>

	</body>
</html>
