<?
Class communityModel extends dbModel {
	private static $instance;

	function __construct () {
	}

	function __destruct () {
	}

	/*!
	 * Define the Model
	 */
	public static function getInstance() {
		if (!self::$instance) {
			$db_con = new communityModel();
			$db_con->connect();
			self::$instance = $db_con;
		}
		return self::$instance;
        }


	/*!
	 * Add activity
	 */
	public function addActivity ($params) {
		return dbModel::insert('acivity', $params); // Use insert method from dbModel
	}

	public function getActivity() {
		return dbModel::get('activity', ''); // Get from dbModel use dbModel:: or $this->
	}
}
?>
