<?php include 'header.php';

$result = mysql_query("SHOW TABLES FROM `blive`");

while ($row = mysql_fetch_row($result)) {
	$tbl = $row[0];
	$tb = $tbl;
	echo '<h2>Table: '.$row[0].'</h2>';
	$get = $getRecord -> GET($tb, '', '', '');
	foreach ($get as $get) {
		$field = 'avatar';
		$oval = $get[$field];
		$imgg = str_replace(':8080', '', $oval);
		$id = $get['id'];
		$change = mysql_query("UPDATE `$tb` SET `$field` = '$imgg' WHERE `id` = '$id' ");
		if ($change) echo 'Done<br/>';
	}

}
?>
