<? include '../lib/config.php';
$key = $_POST['key'];
if (!$key) {
	for ($j = 0; $j < count($frAr); $j++) {
		$frU = $frAr[$j];
		$frN = $frArN[$frU];
		echo '<a class="one-friend-search">'.$frN.'</a>';
	}
} else {
	$q = str_replace("+", "", $key);
	$q = str_replace('@', '', $q);
	$q = str_replace(" ", "", $q);
	$get = null;
	foreach ($frArN as $frN) {
//		echo $frN.'~~'.substr($q, 0, strlen($q)).'~~'.check($frN, substr($q, 0, strlen($q)));
		if (strpos($frN, substr($q, 0, strlen($q))) !== false) {
			$uin = getRecord('members^avatar', "`username` = '{$frN}' ");
			$subs = strlen($q) - strlen($frN);
			if ($subs == 0) $strLeft = '';
			else $strLeft = substr($frN, $subs);
			echo '<div class="one-fr-search" title="'.$frN.'" alt="'.$frN.'">
				<img src="'.$uin['avatar'].'" class="avatar-circle thumb left"/>
				<a class="addname"><b>'.$q.'</b>'.$strLeft.'</a>
			</div>';
		}
	}
//	echo ($get === null) ? 'Nothing found' : $get;
/*	$sql_res = mysql_query("select * from members where username like '%$q%' order by id LIMIT 5");
	while ($row = mysql_fetch_array($sql_res)) {
		$uname = $row['username'];
		$img = $row['avatar']; ?>
		<div class="display_box" >
			<img src="user_img/<?php echo $img ?>" class="avatar-circle thumb left"/>
			<a href="#" class='addname' title='<?php echo $uname ?>'><?php echo $uname ?></a>
		</div>
<?
	} */
}
