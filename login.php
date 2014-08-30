<?php include 'lib/config.php' ?>
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
		$sql_query = @mysql_query("SELECT * FROM members WHERE username='{$username}'");
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
			<a class="btn btn-twitter btn-block" href="./login?login&oauth_provider=twitter"><i class="fa fa-twitter"></i> Login using twitter</a>
			<a class="btn btn-facebook btn-block" href="./login?login&oauth_provider=facebook"><i class="fa fa-facebook"></i> Login with facebook</a>
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
