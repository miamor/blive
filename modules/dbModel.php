<?
class dbModel {
	private $db_host = 'localhost';
	private $db_user = 'root';
	private $db_pass = 'abc123';
	private $db_name = 'goodbooks';
	private $connection;
	private $result = NULL;

	function __construct () {

	}

	function __destruct () {
	}

	function connect () {
		$this->connection = mysql_connect($this->db_host,$this->db_user, $this->db_pass); 
		if (!$this->connection) { 
			die("Database connection failed: " . mysql_error()); 
		} else {
			$db_select = mysql_select_db($this->db_name, $this->connection);
			if (!$db_select) {
				die("Database selection failed: " . mysql_error());
			}
		}
	}

	public function closeConnect () {
		if ($this->connection) {
			mysql_close($this->connection);
			unset($this->connection);
		}
	}


	public function query ($sql) {
		mysql_query("SET NAMES UTF8", $this->connection);
		$this->result = mysql_query($sql, $this->connection);
		if (!$this->result) {
			$output = "Database query failed: " . mysql_error() . "<br /><br />";
			die($output);
		}
		return $this->result;
	}

	public function fetch_array ($first_row = FALSE) {
		if ($this->result) {
			if (!$first_row) {
				$rows = array();
				while ( $row = mysql_fetch_array($this->result))
					$rows[] = $row;
			} else $rows = mysql_fetch_array($this->result);
		}
		return $rows;
	}

        // extend methods
	public function insert ($table, $params) {
		$sql = "INSERT INTO $table VALUES ($params)";
		$this->query($sql);
		return $this->result;
	}


	public function get ($table, $params) {
		if ($params['where']) $where = ' WHERE '.$where;
		$sql = 'SELECT * FROM '.$table.$where;
		$this->result = $this->query($sql);
		return $this->fetch_array();
	}
}
?>
