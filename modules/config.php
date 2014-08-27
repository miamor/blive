<?
class Config {
	public static $u, $nowInt, $now;
	
	function __construct () {
		$this::$u = $_SESSION['user_id'];
		$this::$nowInt = (int)date('ymdHi');
		$this::$now = date('d-m-Y H:i');
	}
}
?>
