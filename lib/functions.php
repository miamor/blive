<?
/*! Remove unempty folder */
function rrmdir($dir) {
	if (is_dir($dir)) {
		$files = scandir($dir);
		foreach ($files as $file)
			if ($file != "." && $file != "..") rrmdir("$dir/$file");
		rmdir($dir);
	}
	else if (file_exists($dir)) unlink($dir);
}
/*! Copy all contents in one folder */
function xcopy ($src, $dest) {
	foreach (scandir($src) as $file) {
		if (!is_readable($src . '/' . $file)) continue;
		if (is_dir($file) && ($file != '.') && ($file != '..') ) {
			mkdir($dest . '/' . $file);
			xcopy($src . '/' . $file, $dest . '/' . $file);
		} else {
			copy($src . '/' . $file, $dest . '/' . $file);
		}
	}
}
/*! Copy all contents in one folder */
function rcopy ($src, $dst) {
	if (is_dir($src)) {
		if (!is_dir($dst)) mkdir($dst);
		$files = scandir($src);
		foreach ($files as $file) {
			if ($file != "." && $file != "..") {
				rcopy ("$src/$file", "$dst/$file");
				chmod ("$dst/$file", 0777);
			}
		}
	} else if (file_exists ($src)) copy($src, $dst);
	rrmdir($src);
}
/*! * Replace content */
function _content ($content, $need = array(""), $replaced = array("\'")) {
	return str_replace($need, $replaced, $content);
}
/*! Get id from url */
function _GET ($string) {
	if (checkURL('#!') > 0) {
		$ar = explode($string.'=', $_SERVER['REQUEST_URI']);
		$ars = explode('&', $ar[1]);
		return $ars[0];
	} else {
		return $_GET[$string];
	}
}
/*! Check if characters exist in a string */
function check ($string, $word) {
	return strlen(strstr($string, $word));
}
/*! Check if characters exitst in url */
function checkURL ($word) {
	return check($_SERVER['REQUEST_URI'], $word);
}


/*! Get record 
function getRecord ( $params = array ('table', 'where') ) {
	$con = mysql_connect (DB_SERVER, DB_USER, DB_PASS);
	$db_select = mysql_select_db($dbName);
	if (!$con) die('Error Connection:' . mysql_error());
	$where = join("AND ", $params['where']);
	$sql = "SELECT * FROM {$params['table']} WHERE $where ORDER BY id DESC";
	$getResult = mysql_query($sql, $con);
	if ($getResult === FALSE) die(mysql_error());
	else return mysql_fetch_array($getResult);
} */

/*Get multi records */
class getRecord {
	private function _open_connection() {
		$con = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
		if (!$con) die('Error Connection:' . mysql_error());
		$db_select = mysql_select_db(DB_NAME, $con);
		if (!$db_select) die('Error Selection: ' . mysql_error());
		return $con;
	}
	
	private function _confirm_query($result) {
		if(!$result) die('Error Query: ' . mysql_error());
		return $result;
	}

	function countRecord ($table, $condition) {
		if ($table == '') return false;

		if (!$condition) $getResult = mysql_query("SELECT * FROM `$table`");
		else $getResult = mysql_query("SELECT * FROM `$table` WHERE $condition");

		if ($getResult === FALSE) die(mysql_error());
		else return mysql_num_rows($getResult);
	}

	public function GET ($table, $condition, $display, $order) {
		$query = "SELECT COUNT(id) FROM `$table`";

		$miis = $display;
		if (check($display, '^') > 0) {
			$display = explode('^', $display);
			$display = $display[1];
		}
		if ($display && $display != 0 && check($display, '%') <= 0) {
			if (isset($_GET['page']) && (int)$_GET['page'] >= 0) {
				$page = $_GET['page'];
			} else {
				$result = mysql_query($query);
				$rows = mysql_fetch_array($result);
				if ($table == 'comment_quest_new') $record = countRecord ("comment_quest", $condition);
				else $record = countRecord ($table, $condition);
				if($record > $display) $page = ceil($record/$display);
				else $page = 1;
			}
			$start = (isset($_GET['start']) && (int)$_GET['start'] >= 0) ? $_GET['start'] : 0;
			$current = ($start/$display)+1;
			$next = $start + $display;
			$previous = $start - $display;
			$last = ($page - 1)*$display;
			if (check($miis, '^') <= 0) {
				if ($current >= 4) {
					$start_page = $current - 2;
					if ($page > $current + 2) $end_page = $current + 2;
					else if ($current <= $page && $current > $page - 3) {
						$start_page = $page - 3;
						$end_page = $page;
					} else $end_page = $page;
				} else {
					$start_page = 1;
					if ($page > 4) $end_page = 4;
					else $end_page = $page;
				}
			} else {
				$start_page = 1;
				$end_page = $page;
			}

			$fl = explode('goodbooks', $_SERVER['REQUEST_URI']);
			$fl = $fl[1];
			$fls = explode("?", $fl);
			$mm = $fls[1].'&';
			echo '<div class="pagination primary right">';
			if ($current > 1) echo "<li><a href='".MAIN_URL.$fls[0]."?".$mm."start=0&page=$page' data-toggle='tooltip' title='To the first page'><i class='fa fa-chevron-left'></i></a></li>";
			else echo "<li class='disabled'><a data-toggle='tooltip' title='To the first page'><i class='fa fa-chevron-left'></i></a></li>";
			for ($i = $start_page; $i <= $end_page; $i++) {
				if ($current == $i) echo "<li class='active'><a>$i</a></li>";
				else {
					if (strlen(strstr($fl, '?')) <= 0) echo "<li><a class='page' href='".MAIN_URL.$fls[0]."?start=".($display*($i-1))."&page=$page'>$i</a></li>";
					else {
						echo "<li><a class='page' href='".MAIN_URL.$fls[0]."?".$mm."start=".($display*($i-1))."&page=$page'>$i</a></li>";
					}
				}
			}
			if ($current < $page) echo "<li><a data-toggle='tooltip' href='".MAIN_URL.$fls[0]."?".$mm."start=$last' title='To the last page'><i class='fa fa-chevron-right'></i></a></li>";
			else echo "<li class='disabled'><a data-toggle='tooltip' title='To the last page'><i class='fa fa-chevron-right'></i></a></li>";
			echo '</div>';
		}

		if (!$condition) {
			if (check($display, '%') > 0) {
				$dis = explode('%', $display);
				if ($order) $sql = "SELECT * FROM `$table` ORDER BY $order LIMIT ".$dis[1];
				else $sql = "SELECT * FROM `$table` ORDER BY `id` DESC LIMIT ".$dis[1];
			} else if ($display == 0 || !$display) {
				if ($order) $sql = "SELECT * FROM `$table` ORDER BY $order";
				else $sql = "SELECT * FROM `$table` ORDER BY `id` DESC";
			} else {
				if ($order) $sql = "SELECT * FROM `$table` ORDER BY $order LIMIT $start, $display";
				else $sql = "SELECT * FROM `$table` ORDER BY `id` DESC LIMIT $start, $display";
			}
		} else {
			if (check($display, '%') > 0) {
				$dis = explode('%', $display);
				if ($order) $sql = "SELECT * FROM `$table` WHERE $condition ORDER BY $order LIMIT ".$dis[1];
				else $sql = "SELECT * FROM `$table` WHERE $condition ORDER BY `id` DESC LIMIT ".$dis[1];
			} else if ($display == 0 || !$display) {
				if ($order) $sql = "SELECT * FROM `$table` WHERE $condition ORDER BY $order";
				else $sql = "SELECT * FROM `$table` WHERE $condition ORDER BY `id` DESC";
			} else {
				if ($order) $sql = "SELECT * FROM `$table` WHERE $condition ORDER BY $order LIMIT $start, $display";
				else $sql = "SELECT * FROM `$table` WHERE $condition ORDER BY `id` DESC LIMIT $start, $display";
			}
		}

		$db = $this -> _open_connection();
		$result = mysql_query($sql, $db);
		$Array = array();
		
		if ($this -> _confirm_query($result)) {
			while ($r = mysql_fetch_array($result)) {
				$row = array();
				foreach ($r as $k=>$v){
					$row[$k] = $v;
				}
				array_push($Array, $row);
				unset($row);
			}
		}
		
		return $Array;
	}
}

$getRecord = new getRecord();

?>
