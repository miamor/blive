<? include 'header.php' ?>

<h2>Community</h2>

<? 	include MAIN_PATH.'/modules/community/dbModel.php';
 	include MAIN_PATH.'/modules/community/communityController.php';
	include MAIN_PATH.'/modules/community/communityModel.php';
	include MAIN_PATH.'/modules/community/communityView.php';
	$db = communityModel::getInstance();
	$communityModule = new communityController();
	$communityModule->showActivity();
	if (isset($_POST['sub'])) {
		echo $_POST['hoten'].'-'.$_POST['tuoi'];
		$communityModule->insert($_POST['hoten'], $_POST['tuoi']);
	}
?>

<? include 'footer.php' ?>
