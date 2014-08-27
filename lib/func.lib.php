<?
function check_db ($db, $condition) {
	$nums = countRecord($db, $condition);
	if (isset($_SESSION[$db])) {
		if ($_SESSION[$db] == $nums) return $nums;
		else {
			$_SESSION[$db] = $nums;
			changeValue('members', "`id` = '$u' ", "`mes_new` = '$nums' ");
			return 'new~'.$nums;
		}
	} else {
		$_SESSION[$db] = -1;
		return -1;
	}
}

function alertChat () {
	global $u;
	$ch = check_db('chat');
	if ($ch > 0) ;
}

function activityAdd($type, $iid) {
	global $u, $current;
	if ($iid) mysql_query("INSERT INTO `activity` (`type`, `privacy`, `uid`, `to_uid`, `iid`, `time`) VALUES ($type, 'public', '$u' ,'$u', '$iid', '$current')");
}

function rrmdir($dir) {
	if (is_dir($dir)) {
		$files = scandir($dir);
		foreach ($files as $file)
			if ($file != "." && $file != "..") rrmdir("$dir/$file");
		rmdir($dir);
	}
	else if (file_exists($dir)) unlink($dir);
}

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

function is_dir_empty ($dir) {
	if (!is_readable($dir)) return NULL; 
	return (count(scandir($dir)) == 2);
}

function generateRandomString ($length) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
}

function friendList ($status) {
	global $u;
	$getRecord = new getRecord();
	$fR = $getRecord -> GET('friend', " (`receive_id` = '$u' OR `uid` = '$u') AND `accept` = 'yes'");
	foreach ($fR as $fR) {
		if ($fR['uid'] == $u) $fRu = $fR['receive_id'];
		else $fRu = $fR['uid'];
		$fRm = getRecord('members', "`id` = '$fRu'");
		$mutualF = 0;
		$lastMes = getRecord('chat', " (`to_uid` = '$fRu' AND `uid` = '$u') OR (`to_uid` = '$u' AND `uid` = '$fRu') ");
		if ($fRm['online'] == $status) {
			echo '<li><a id="'.$fRu.'">
					<span class="user-status'; if ($status == 'online') echo ' success'; else if ($status == 'idle') echo ' warning'; else if ($status == 'offline') echo ' danger'; echo '"></span>
					<img src="'.$fRm['avatar'].'" class="ava-sidebar img-circle" alt="Avatar">
<!--					<i class="fa fa-mobile-phone device-status"></i> -->
					<span class="activity">'.$fRm['username'].'</span>
					<span class="small-caps"> ';
			if ($lastMes['uid'] == $u) echo '<span class="fa fa-mail-forward"></span> ';
			echo $lastMes['content'].'</span>
			</a></li>';
	 	}
	}
}

function right_container ($width, $pages) {
/*	$u = $values['u'];
	$dot = $values['dot'];
	$pdot = $values['pdot'];
	$c = $values['c'];
*/	global $u, $dot, $pdot, $c;
	$getRecord = new getRecord();
	echo '<div id="right-container" style="width:'.$width.'"><style>#content{margin-right:calc('.$width.' + 31px); margin-right:-webkit-calc('.$width.' + 31px)}</style>';
	for ($i = 0; $i < count($pages); $i++) {
		$dataLink = explode('/', $pages[$i]);
		$dataLink = explode('.', $dataLink[1]);
		echo '<div class="right-one-content the-box" id="'.$dataLink[0].'">';
			include $pages[$i];
		echo '</div>';
	}
	echo '</div>';
}

function addNumField ($uid, $coin, $field) {
	$uInfo = getRecord('members', "`id` = '$uid'");
	$oldcoin = (int)$uInfo[$field];
	$newcoin = $oldcoin + $coin;
	$cha = changeValue('members', "`id` = '$uid'", "`$field` = '$newcoin'");
}

function substractNumField ($uid, $coin, $field) {
	$uInfo = getRecord('members', "`id` = '$uid'");
	$oldcoin = (int)$uInfo[$field];
	$newcoin = $oldcoin - $coin;
	changeValue('members', "`id` = '$uid'", "`$field` = '$newcoin'");
}

function addCoin ($u, $coin) {
	addNumField($u, $coin, 'coin');
}

function substractCoin ($u, $coin) {
	substractNumField($u, $coin, 'coin');
}

function addRep ($u, $coin) {
	addNumField($u, $coin, 'reputation');
}

function substractRep ($u, $coin) {
	substractNumField($u, $coin, 'reputation');
}

function addfriend ($u, $to, $time) {
	$uInfo = getRecord('members', "`id` = '$u'");
	$toInfo = getRecord('members', "`id` = '$to'");
	if (countRecord('friend', "(`uid` = '$u' AND `receive_id` = '$to') OR (`uid` = '$to' AND `receive_id` = '$u')") <= 0) {
		$notinew = $toInfo['friend_new'];
		$notinew++;
		mysql_query("INSERT INTO `friend` (`uid`, `receive_id`) VALUES ('$u', '$to')");
//		mysql_query("INSERT INTO `notification` (`type`, `uid`, `to_uid`, `time`) VALUES ('friend_request', '$u', '$to', '$current')");
		sendNoti('friend_request', '', '', $to);
		changeValue('members', "`id` = '$to'", "`friend_new` = '$notinew'");
	}
}
function acceptfriend ($id_send, $u, $to, $current) {
	$m_send = getRecord('members', "`id` = '$id_send'");
	if (countRecord('friend', "`uid` = '$id_send' AND `receive_id` = '$u' AND (`accept` != 'yes' OR `accept` != 'no')") > 0) {
		$notinew = $m_send['friend_new'];
		$notinew++;
//		$notinewS = $member['friend_new'];
//		$notinewS--;
//		mysql_query("INSERT INTO `notification` (`type`, `uid`, `to_uid`, `time`) VALUES ('accept_friend_request', '$u', '$id_send', '$current')");
		sendNoti('accept_friend_request', '', '', $id_send);
		mysql_query("INSERT INTO `activity` (`type`, `uid`, `to_uid`, `time`) VALUES ('become-friend', '$u', '$id_send', '$current')");
//		mysql_query("DELETE FROM `notification` WHERE `type` = 'friend_request' AND `uid` = '$id_send' AND `to_uid` = '$u'");
		changeValue('members', "`id` = '$id_send'", "`friend_new` = '$notinew'");
//		changeValue('members', "`id` = '$u'", "`friend_new` = '$notinewS'");
		changeValue('friend', "`uid` = '$id_send' AND `receive_id` = '$u'", "`accept` = 'yes'");
	}
}

function addNoti ($u) {
	$getNoti = getRecord('members', "`id` = '$u'");
	$notinum = $getNoti['noti_new'];
	$notinum++;
	changeValue('members', "`id` = '$u'", "`noti_new` = '$notinum'");
}

function subtractNoti ($u) {
	$getNoti = getRecord('members', "`id` = '$u'");
	$notinum = $getNoti['noti_new'];
	$notinum--;
	changeValue('members', "`id` = '$u'", "`noti_new` = '$notinum'");
}

function sendNoti ($type, $i, $pi, $to, $content) {
	global $u, $current, $curint;
	mysql_query("INSERT INTO `notification` (`type`, `i`, `pi`, `uid`, `to_uid`, `content`, `time`) VALUES ('$type', '$i', '$pi', '$u', '$to', '$content', '$curint')");
	addNoti($to);
}

function removeNoti ($type, $from, $to, $i, $pi, $content) {
	mysql_query("DELETE FROM `notification` WHERE `type` = '$type' AND `uid` = '$from' AND `to_uid` = '$to' AND `i` = '$i' AND `pi` = '$pi' AND `content` = '$content'");
	subtractNoti($to);
}

function _content ($content) {
	$need = array("'");
	$replaced = array("\'");
	return str_replace($need, $replaced, nl2br($content));
}

function _GET ($string) {
	if (checkURL('#!') > 0) {
		$ar = explode($string.'=', $_SERVER['REQUEST_URI']);
		$ars = explode('&', $ar[1]);
		return $ars[0];
	} else {
		return $_GET[$string];
	}
}

function timeFormat ($timeInt) {
	$timeAr = str_split($timeInt, 2);
	$y = 2000 + $timeAr[0];
	$m = $timeAr[1];
	$d = $timeAr[2];
	$h = $timeAr[3];
	$i = $timeAr[4];
	return "$d-$m-$y $h:$i";
}

function tag ($content) {
	global $u, $frArN, $member;
	$content = str_replace(array('&nbsp;', '@', '<p><br></p>'), array(' ', '+', ''), _content($content));
	$memTagAr = explode('+', $content);
	for ($j = 1; $j < count($memTagAr); $j++) {
		$thisMem = explode(' ', $memTagAr[$j]);
//		$thisMem = explode('&nbsp;', $thisMem[0]);
		$thisMem = $thisMem[0];
		$thisMemIn = getRecord('members^username', "`username` = '$thisMem' ");
		if (in_array($thisMem, $frArN) || $thisMem == $member['username']) {
			$need[] = '+'.$thisMem.' ';
			$replaced[] = '<a href="#!user?u='.$thisMem.'">+'.$thisMem.'</a> ';
		}
	}
	$displayContent = str_replace($need, $replaced, $content);
	return str_replace("\'", "'", $displayContent);
}

function getRecord ($table, $condition) {
	$con = mysql_connect (DB_SERVER, DB_USER, DB_PASS);
	$db_select = mysql_select_db($dbName);
	if (!$con) die('Error Connection:' . mysql_error());
	if ($table == '') return false;
	if (check($table, '^') > 0) {
		$tableSpl = explode('^', $table);
		$table = $tableSpl[0];
		$col = $tableSpl[1];
	} else $col = '*';
	if ($condition == '' || !$condition) $sql = "SELECT $col FROM `$table` ORDER BY `id` DESC";
	else $sql = "SELECT $col FROM `$table` WHERE $condition ORDER BY `id` DESC";
	$getResult = mysql_query($sql, $con);
	if ($getResult === FALSE) die(mysql_error());
	else return mysql_fetch_array($getResult);
}

function countRecord ($table, $condition) {
	if ($table == '') return false;
	if (!$condition) $getResult = mysql_query("SELECT `id` FROM `$table`");
	else $getResult = mysql_query("SELECT `id` FROM `$table` WHERE $condition");
	if ($getResult === FALSE) die(mysql_error());
	else return mysql_num_rows($getResult);
}

function removeSpace ($content) {
	return str_replace(' ', '', $content);
}
	
function emo ($content) {
	$emodir = IMG.'/emo';
	$kitu = array();
	$em = array();
	$mE = mysql_query("SELECT * FROM `emo` WHERE type='emo' ORDER BY `order` DESC");
	while ($es = mysql_fetch_array ($mE)) {
		$eid = $es['id'];
		$eicon = $es['icon'];
		$ename = $es['name'];
		$edot = $es['dot'];
		$eimg = "<img src='$emodir/{$es['cat']}/{$es['img']}.$edot'/>";
		array_push($kitu, $eicon);
		array_push($em, $eimg);
	}
	$content = str_replace( $kitu, $em, nl2br($content) );
	return $content;
}

function emoTextareaDropdown () {
	$Array = array();
	$mE = mysql_query("SELECT * FROM `emo` WHERE type='emo' ORDER BY `id` ASC LIMIT 12");
	while ($es = mysql_fetch_array ($mE)) {
		$eid = $es['id'];
		$eicon = $es['icon'];
		$ename = $es['name'];
		$edot = $es['dot'];
		$eimg = $es['img'];
		$ecat = $es['cat'];
		echo "'$eicon' : '$ecat/$eimg.$edot', ";
	}
}

function emoTextareaMore () {
	$Array = array();
	$mE = mysql_query("SELECT * FROM `emo` WHERE type='emo' ORDER BY `id` ASC");
	while ($es = mysql_fetch_array ($mE)) {
		$eid = $es['id'];
		$eicon = $es['icon'];
		$ename = $es['name'];
		$edot = $es['dot'];
		$eimg = $es['img'];
		$ecat = $es['cat'];
		if ($eid > 10) echo "'$eicon' : '$ecat/$eimg.$edot', ";
	}
}

function check ($string, $word) {
	return strlen(strstr($string, $word));
}

function checkURL ($word) {
	return check($_SERVER['REQUEST_URI'], $word);
}

function changeValue ($table, $condition, $value) {
	if ($table == '' || countRecord($table, $condition) <= 0) return false;
	if ($condition == '') $result = mysql_query("UPDATE `$table` SET $value");
	else $result = mysql_query("UPDATE `$table` SET $value WHERE $condition");
	if ($result === FALSE) die(mysql_error());
	else return $result;
}

function insert ($tb, $fields, $values) {
	return mysql_query("INSERT INTO $tb ($fields) VALUES ($values)");
}

function delete ($tb, $condition) {
	return mysql_query("DELETE FROM $tb WHERE $condition");
}

function getFields ($tb) {
	$fields = mysql_list_fields(DB_NAME, $tb);
	$columns = mysql_num_fields($fields);
	for ($i = 0; $i < $columns; $i++) $field_array[] = mysql_field_name($fields, $i);
	return $field_array;
}

function pushToCol ($tb, $rowDefine, $iid, $rowToPush, $pi) {
	global $u, $member;
/*	$fields = getFields($tb);
	if (!in_array('uid', $fields)) {
		$rowGet = "$rowDefine,$rowToPush";
		$pIn = getRecord('promise^id,uid', "`id` = '$iid' ");
		$uGet = $pIn['uid'];
		$tbl = 'promise';
	} else {
		$rowGet = "$rowDefine,$rowToPush,uid";
		$tbl = $tb;
	}
*/	$rowGet = "$rowDefine,$rowToPush,uid";
	$rowIn = getRecord("$tb^$rowGet", "`$rowDefine` = '$iid'");
//	if (in_array('uid', $fields)) $uGet = $rowIn['uid'];
	$uGet = $rowIn['uid'];
	if ($rowIn[$rowToPush]) $rowAr = explode(', ', $rowIn[$rowToPush]);
	else $rowAr = array();
	if (!in_array($u, $rowAr)) $rowAr[] = $u;
	$rowStr = implode(', ', $rowAr);
	if ($u != $rowIn['uid']) sendNoti($rowToPush.'-'.$tb, $iid, $pi, $rowIn['uid']);
	return $change = changeValue($tb, "`$rowDefine` = '$iid'", "`$rowToPush` = '$rowStr'");
}

function rmFromCol ($tb, $rowDefine, $iid, $rowToPush, $pi) {
	global $u, $member;
	$rowIn = getRecord("$tb^$rowDefine,$rowToPush,uid", "`$rowDefine` = '$iid'");
	if ($rowIn[$rowToPush]) $rowAr = explode(', ', $rowIn[$rowToPush]);
	else $rowAr = array();
	if (($key = array_search($u, $rowAr)) !== false) unset ($rowAr[$key]);
	$rowStr = implode(', ', $rowAr);
	removeNoti($rowToPush.'-'.$tb, $u, $rowIn['uid'], $iid, $pi);
	return $change = changeValue($tb, "`$rowDefine` = '$iid'", "`$rowToPush` = '$rowStr'");
}

	function possessive ($uid) {
		$uIn = getRecord('members^id,gender', "`id` = '$uid' ");
		if ($uIn['gender'] == 'male') echo 'his';
		else echo 'her';
		return $possessive;
	}
	function vocative ($uid) {
		$uIn = getRecord('members^id,gender', "`id` = '$uid' ");
		if ($uIn['gender'] == 'male') echo 'he';
		else echo 'she';
		return $possessive;
	}
	function pronoun ($uid) {
		$uIn = getRecord('members^id,gender', "`id` = '$uid' ");
		if ($uIn['gender'] == 'male') echo 'him';
		else echo 'her';
		return $possessive;
	}

/*class gender {
}
$gender = new gender();
*/
function likeStatic ($tb, $iid) {
	global $u, $frAr, $frArN;
	$rowIn = getRecord($tb.'^likes', "id = $iid");
	if ($rowIn['likes']) {
		$likeAr = explode(', ', $rowIn['likes']);
		$likes = count($likeAr);
	} else $likes = 0;
	if ($likes != 0) {
		$otherLikes = 0;
		echo '<div>';
		if (in_array($u, $likeAr)) {
			if (($key = array_search($u, $likeAr)) !== false) unset($likeAr[$key]);
			$likes--;
			for ($j = 0; $j <= $likes; $j++) {
				$oLikeId = $likeAr[$j];
				if ($oLikeId) {
					$otherLikes++;
					if (in_array($oLikeId, $frAr)) {
						$oLikeName = $frArN[$oLikeId];
						$otherLikesFr[] = '<a href="#user?u="'.$oLikeId.'">'.$oLikeName.'</a>';
						$otherLikes--;
					}
				}
			}
//			if (count($otherLikes) == 0) echo 'You liked this';
			if ($likes == 0) echo 'You liked this';
			else if ($otherLikes == 0 && count($otherLikesFr) > 0) {
				if (count($otherLikesFr) == 1) {
					$oLikeA = $otherLikesFr[0];
					echo 'You and '.$oLikeA.' liked this';
				} else if (count($otherLikesFr) == 2) {
					$oLikeA0 = $otherLikesFr[0];
					$oLikeA1 = $otherLikesFr[1];
					echo 'You, '.$oLikeA0.' and '.$oLikeA1.' liked this';
				} else if (count($otherLikesFr) >= 3) {
					$oLikeA0 = $otherLikesFr[0];
					$oLikeA1 = $otherLikesFr[1];
					$oLikeA2 = $otherLikesFr[2];
					echo 'You, '.$oLikeA0.', '.$oLikeA1.' and '.$oLikeA2.' liked this';
				}
			} else if ($otherLikes > 0 && count($otherLikesFr) > 0) {
				if (count($otherLikesFr) == 1) {
					$oLikeA = $otherLikesFr[0];
					echo 'You, '.$oLikeA.' and <a class="sb-open" id="like-list" alt="'.$iid.'">'.$otherLikes.' others</a> liked this';
				} else if (count($otherLikesFr) == 2) {
					$oLikeA0 = $otherLikesFr[0];
					$oLikeA1 = $otherLikesFr[1];
					echo 'You, '.$oLikeA0.', '.$oLikeA1.' and <a class="sb-open" id="like-list" alt="'.$iid.'">'.$otherLikes.' others</a> liked this';
				} else if (count($otherLikesFr) >= 3) {
					$oLikeA0 = $otherLikesFr[0];
					$oLikeA1 = $otherLikesFr[1];
					$oLikeA2 = $otherLikesFr[2];
					echo 'You, '.$oLikeA0.', '.$oLikeA1.', '.$oLikeA2.' and <a class="sb-open" id="like-list" alt="'.$iid.'">'.$otherLikes.' others</a> liked this';
				}
			} else echo 'You and <a class="sb-open" id="like-list" alt="'.$iid.'">'.count($otherLikes).' others</a> liked this';
		} else {
			for ($j = 0; $j <= $likes; $j++) {
				$oLikeId = $likeAr[$j];
				if ($oLikeId) {
					$otherLikes++;
					if (in_array($oLikeId, $frAr)) {
//						$oLikeIn = getRecord('members^username', "id = '$oLikeId'");
//						$oLikeName = $oLikeIn['username'];
						$oLikeName = $frArN[$oLikeId];
						$otherLikesFr[] = '<a href="#user?u="'.$oLikeId.'">'.$oLikeName.'</a>';
						$otherLikes--;
					}
				}
			}
			if ($otherLikes == 0 && count($otherLikesFr) > 0) {
				if (count($otherLikesFr) == 1) {
					$oLikeA = $otherLikesFr[0];
					echo $oLikeA.' liked this';
				} else if (count($otherLikesFr) == 2) {
					$oLikeA0 = $otherLikesFr[0];
					$oLikeA1 = $otherLikesFr[1];
					echo $oLikeA0.' and '.$oLikeA1.' liked this';
				} else if (count($otherLikesFr) >= 3) {
					$oLikeA0 = $otherLikesFr[0];
					$oLikeA1 = $otherLikesFr[1];
					$oLikeA2 = $otherLikesFr[2];
					echo $oLikeA0.', '.$oLikeA1.' and '.$oLikeA2.' liked this';
				}
			} else if ($otherLikes > 0 && count($otherLikesFr) > 0) {
				if (count($otherLikesFr) == 1) {
					$oLikeA = $otherLikesFr[0];
					echo $oLikeA.' and <a class="sb-open" id="like-list" alt="'.$iid.'">'.$otherLikes.' others</a> liked this';
				} else if (count($otherLikesFr) == 2) {
					$oLikeA0 = $otherLikesFr[0];
					$oLikeA1 = $otherLikesFr[1];
					echo $oLikeA0.', '.$oLikeA1.' and <a class="sb-open" id="like-list" alt="'.$iid.'">'.$otherLikes.' others</a> liked this';
				} else if (count($otherLikesFr) >= 3) {
					$oLikeA0 = $otherLikesFr[0];
					$oLikeA1 = $otherLikesFr[1];
					$oLikeA2 = $otherLikesFr[2];
					echo $oLikeA0.', '.$oLikeA1.', '.$oLikeA2.' and <a class="sb-open" id="like-list" alt="'.$iid.'">'.$otherLikes.' others</a> liked this';
				}
			} else echo '<a class="sb-open" id="like-list" alt="'.$iid.'">'.$likes.' people</a> liked this';
		}
		echo '</div>';
	}
}

function toolPost ($tb, $iid) {
	global $u, $member;
	$getRecord = new getRecord();
	$rowIn = getRecord($tb, "id = $iid");
	if ($rowIn['likes']) {
		$likeAr = explode(', ', $rowIn['likes']);
		$solike = count($likeAr);
	} else $solike = 0;
	$solik = $solike - 3;
	$socmt = countRecord($tb.'_cmt', "`iid` = '$iid' AND `pid` = 0");
	$soshare = countRecord('activity', "`type` = 'share' AND `img_url` = '$iid'");
	echo '<div class="tool" id="tool">';
		if (!in_array($u, $likeAr)) echo '<a class="like-button" id="like-post">Like</a>';
		else echo '<a class="like-button" id="like-post">Unlike</a>';
		echo '<a class="comment-button" id="comment-post">Comment</a>
			<a class="share-button" id="share-post">Share</a>';
/*		echo "<a class='lik' id='like_$iid' alt='$up_id'>Like</a>";
		else echo "<a class='unlike' id='unlike_$iid' alt='$up_id'>Unlike</a>";
		echo "</span><a class='cmt' id='cmt_$iid'>Comment</a>
			<a class='share' id='share_$iid'>Share</a>";
*/		echo "<span class='nums'><span>";
		if ($solike > 0) echo "<span id='like'><i class='fa fa-thumbs-up'></i> $solike</span>";
		if ($socmt > 0) echo "<span id='cmt'><i class='fa fa-coffee'></i> $socmt</span>";
		if ($soshare > 0) echo "<span id='share'><i class='fa fa-share-alt'></i> $soshare</span>";
	echo '</span></span>';
	echo '<span class="deta gensmall right"><i class="fa fa-clock-o"></i> '.timeFormat($rowIn['time']).'</span>';
	echo '</div>';
}

function cmtListPost ($tb, $iid, $num) {
	global $u, $member, $curint, $cmii;
	$getRecord = new getRecord();
	include 'views/comment.php';
/*	$getRecord = new getRecord();
	$rowIn = getRecord($tb, "id = $iid");
	$socmt = countRecord('activity_cmt', "`iid` = '$lid'");
	$cmtL = $getRecord -> GET($tb.'_cmt', "iid = $iid AND pid = 0", '%5');
	foreach ($cmtL as $cl) {
		$au = getRecord('members^username,avatar', "id = {$cl['uid']}"); ?>
		<div class="one-cmt">
			<img class="avatar-circle left" src="<? echo $au['avatar'] ?>"/>
			<a href="#!user?u=<? echo $cl['uid'] ?>" class="cmt-user-name bold left"><? echo $au['username'] ?></a>
			<div class="cmt-content"><? echo $cl['content'] ?></div>
			<div class="cmt-bottom tool" id="tool-cmt" alt="<? echo $cl['id'] ?>">
				<a class="like-button small" id="like-cmt">Like</a>
				<a class="like-button small" id="comment-cmt">Comment</a>
				<span class="gensmall right cmt-time"><? echo timeFormat($cl['time']) ?></span>
			</div>
		</div>
<?	}
*/}

function cmtFormPost ($tb, $iid) {
	global $u, $member, $cmii; ?>
	<form class="one-cmt cmt-post-form">
		<img class="avatar-circle left" src="<? echo $member['avatar'] ?>"/>
		<textarea name="cmt-content" class="no-toolbar left" style="height:60px"></textarea>
<!--		<input type="submit" value="Send" class="right"/> -->
		<div class="clearfix"></div>
	</form>
<? }

function bButton ($iid) {
	global $u;
	$disabled = $dis = false;
	$gdi = getRecord('promise^encourage,did,`lock`,believe_lock,believe_not_lock,know_lock,know_not_lock,uid', "id = $iid");
	$gdid = getRecord('promise_did^believe,believe_not,know_did,know_didnot', "iid = $iid");
	if ($gdi['encourage']) {
		$encourageAr = explode(', ', $gdi['encourage']);
		$encourage = count($encourageAr);
	} else $encourage = 0;
	if ($gdi['did']) {
//		$gdid = getRecord('promise_did', "`iid` = $iid");
		if ($gdid['believe']) {
			$gdlBelieveAr = explode(', ', $gdid['believe']);
			$gdlBelieve = count($gdlBelieveAr);
		} else $gdlBelieve = 0;
		if ($gdid['believe_not']) {
			$gdlBelieveNotAr = explode(', ', $gdid['believe_not']);
			$gdlBelieveNot = count($gdlBelieveNotAr);
		} else $gdlBelieveNot = 0;
		if ($gdid['know_did']) {
			$gdlKnowAr = explode(', ', $gdid['know_did']);
			$gdlKnow = count($gdlKnowAr);
		} else $gdlKnow = 0;
		if ($gdid['know_didnot']) {
			$gdlKnowNotAr = explode(', ', $gdid['know_didnot']);
			$gdlKnowNot = count($gdlKnowNotAr);
		} else $gdlKnowNot = 0;
		if ($gdi['lock'] == 'yes' && $gdi['did'] == 'yes') {
			$gdlBelieveDisAr = array_slice($gdlBelieveAr, 0, $gdi['believe_lock']);
			$gdlBelieveNotDisAr = array_slice($gdlBelieveNotAr, 0, $gdi['believe_not_lock']);
			$gdlKnowDisAr = array_slice($gdlKnowAr, 0, $gdi['know_lock']);
			$gdlKnowNotDisAr = array_slice($gdlKnowNotAr, 0, $gdi['know_not_lock']);
			if (in_array($u, $gdlBelieveDisAr) || in_array($u, $gdlBelieveNotDisAr) || in_array($u, $gdlKnowDisAr) || in_array($u, $gdlKnowNotDisAr)) $dis = true;
		}
		if ($gdi['uid'] == $u || in_array($u, $gdlBelieveAr) || in_array($u, $gdlBelieveNotAr) || in_array($u, $gdlKnowAr) || in_array($u, $gdlKnowNotAr)) $disabled = true;
	}
	$totalVotes = $gdlBelieve + $gdlBelieveNot + $gdlKnow + $gdlKnowNot ?>
		<div class="right hide-on-list"><a class="view-all-vote">View all votes</a></div>
		<div class="b-button encourage-button plus-before left <? if ($gdi['did']) echo 'did disabled'; if (in_array($u, $encourageAr)) echo ' active' ?>" id="encourage" alt="<? echo $gdi['id'] ?>"><b><? echo $encourage ?></b></div>
<? if ($gdi['did']) { ?>
		<div class="b-buttons <? if ($dis == true) echo 'dis disabled'; else if ($disabled == true) echo 'disabled' ?>">
			<div class="b-button believe-button plus-before left <? if (in_array($u, $gdlBelieveAr)) echo 'active' ?>" id="believe" alt="<? echo $gdl['id'] ?>">Believe <b><? echo $gdlBelieve ?></b></div>
			<div class="b-button believe-not-button minus-before left <? if (in_array($u, $gdlBelieveNotAr)) echo 'active' ?>" id="believe-not" alt="<? echo $gdl['id'] ?>"><? echo $gdlBelieveNot ?></div>
			<div class="b-button know-button plus-before left <? if (in_array($u, $gdlKnowAr)) echo 'active' ?>" id="know" alt="<? echo $gdl['id'] ?>" title="I know <? echo vocative($gdi['uid']) ?> did">Know <b><? echo $gdlKnow ?></b></div>
			<div class="b-button know-not-button minus-before left <? if (in_array($u, $gdlKnowNotAr)) echo 'active' ?>" id="know-not" alt="<? echo $gdl['id'] ?>" title="I know <? echo vocative($gdi['uid']) ?> didn't"><? echo $gdlKnowNot ?></div>
		</div>
		<div class="clearfix"></div>
<?	if ($gdi['lock'] == 'yes' && $gdi['did'] == 'yes') { ?>
		<div class="votes-sta hide-on-list">
			This item is locked by <a class="votes-sta-details"><b><? echo $gdi['believe_lock'] + $gdi['believe_not_lock'] + $gdi['know_lock'] + $gdi['know_not_lock'] ?></b> first votes</a>
			<ul>
				<li><b><? echo $gdi['believe_lock'] ?></b> believe +</li>
				<li><b><? echo $gdi['believe_not_lock'] ?></b> believe -</li>
				<li><b><? echo $gdi['know_lock'] ?></b> know +</li>
				<li><b><? echo $gdi['know_not_lock'] ?></b> know -</li>
			</ul>
		</div>
<?	}
	if ($gdi['lock'] != 'yes' && $gdi['uid'] == $u) { ?>
		<div class="votes-and-lock hide-on-list gensmall">
			<a class="btn btn-danger lock-it" data-content="By locking this item, everyone who voted before will not be able to change their votes anymore (This won't effect to those who vote after this is locked) Remember, this can't be undone" data-href="#!promise?i=<? echo $iid ?>&do=lock"><span class="fa fa-lock"></span> Lock</a>
		</div>
<?	}
}
//	echo '<div class="clearfix"></div>';
 }

function bButtonAsk ($iid) {
	global $u;
	$disabled = $dis = false;
	$gdi = getRecord('ask^did,`lock`,believe_lock,believe_not_lock,know_lock,know_not_lock,uid', "id = $iid");
	$gdid = getRecord('ask_answer^believe,believe_not,know_did,know_didnot', "iid = $iid");
	if ($gdi['did']) {
//		$gdid = getRecord('promise_did', "`iid` = $iid");
		if ($gdid['believe']) {
			$gdlBelieveAr = explode(', ', $gdid['believe']);
			$gdlBelieve = count($gdlBelieveAr);
		} else $gdlBelieve = 0;
		if ($gdid['believe_not']) {
			$gdlBelieveNotAr = explode(', ', $gdid['believe_not']);
			$gdlBelieveNot = count($gdlBelieveNotAr);
		} else $gdlBelieveNot = 0;
		if ($gdid['know_did']) {
			$gdlKnowAr = explode(', ', $gdid['know_did']);
			$gdlKnow = count($gdlKnowAr);
		} else $gdlKnow = 0;
		if ($gdid['know_didnot']) {
			$gdlKnowNotAr = explode(', ', $gdid['know_didnot']);
			$gdlKnowNot = count($gdlKnowNotAr);
		} else $gdlKnowNot = 0;
		if ($gdi['lock'] == 'yes' && $gdi['did'] == 'yes') {
			$gdlBelieveDisAr = array_slice($gdlBelieveAr, 0, $gdi['believe_lock']);
			$gdlBelieveNotDisAr = array_slice($gdlBelieveNotAr, 0, $gdi['believe_not_lock']);
			$gdlKnowDisAr = array_slice($gdlKnowAr, 0, $gdi['know_lock']);
			$gdlKnowNotDisAr = array_slice($gdlKnowNotAr, 0, $gdi['know_not_lock']);
			if (in_array($u, $gdlBelieveDisAr) || in_array($u, $gdlBelieveNotDisAr) || in_array($u, $gdlKnowDisAr) || in_array($u, $gdlKnowNotDisAr)) $dis = true;
		}
		if ($gdi['uid'] == $u || in_array($u, $gdlBelieveAr) || in_array($u, $gdlBelieveNotAr) || in_array($u, $gdlKnowAr) || in_array($u, $gdlKnowNotAr)) $disabled = true;
	}
	$totalVotes = $gdlBelieve + $gdlBelieveNot + $gdlKnow + $gdlKnowNot ?>
		<div class="right hide-on-list"><a class="view-all-vote">View all votes</a></div>
	<? 	if ($gdi['did']) { ?>
		<div class="b-buttons <? if ($dis == true) echo 'dis disabled'; else if ($disabled == true) echo 'disabled' ?>">
			<div class="b-button believe-button plus-before left <? if (in_array($u, $gdlBelieveAr)) echo 'active' ?>" style="margin-left:0" id="believe" alt="<? echo $gdl['id'] ?>">Believe <b><? echo $gdlBelieve ?></b></div>
			<div class="b-button believe-not-button minus-before left <? if (in_array($u, $gdlBelieveNotAr)) echo 'active' ?>" id="believe-not" alt="<? echo $gdl['id'] ?>"><? echo $gdlBelieveNot ?></div>
			<div class="b-button know-button plus-before left <? if (in_array($u, $gdlKnowAr)) echo 'active' ?>" id="know" alt="<? echo $gdl['id'] ?>" title="I know <? echo vocative($gdi['uid']) ?> did">Know <b><? echo $gdlKnow ?></b></div>
			<div class="b-button know-not-button minus-before left <? if (in_array($u, $gdlKnowNotAr)) echo 'active' ?>" id="know-not" alt="<? echo $gdl['id'] ?>" title="I know <? echo vocative($gdi['uid']) ?> didn't"><? echo $gdlKnowNot ?></div>
		</div>
		<div class="clearfix"></div>
<?	if ($gdi['lock'] == 'yes' && $gdi['did'] == 'yes') { ?>
		<div class="votes-sta hide-on-list">
			This item is locked by <a class="votes-sta-details"><b><? echo $gdi['believe_lock'] + $gdi['believe_not_lock'] + $gdi['know_lock'] + $gdi['know_not_lock'] ?></b> first votes</a>
			<ul>
				<li><b><? echo $gdi['believe_lock'] ?></b> believe +</li>
				<li><b><? echo $gdi['believe_not_lock'] ?></b> believe -</li>
				<li><b><? echo $gdi['know_lock'] ?></b> know +</li>
				<li><b><? echo $gdi['know_not_lock'] ?></b> know -</li>
			</ul>
		</div>
<?	} ?>
	<? if ($gdi['lock'] != 'yes' && $gdi['uid'] == $u) { ?>
		<div class="votes-and-lock gensmall hide-on-list">
			<a class="btn btn-danger lock-it" data-content="By locking this item, everyone who voted before will not be able to change their votes anymore (This won't effect to those who vote after this is locked) Remember, this can't be undone" data-href="#!promise?i=<? echo $iid ?>&do=lock"><span class="fa fa-lock"></span> Lock</a>
		</div>
	<? }
	}
//	echo '<div class="clearfix"></div>';
 }

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
				$record = countRecord ($table, $condition);
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

//			$fl = $_SERVER['REQUEST_URI'];
			$fl = explode('blive', $_SERVER['REQUEST_URI']);
			$fl = $fl[1];
			$fls = explode("?", $fl);
			$mm = $fls[1].'&';
			echo '<div class="pagination primary right">';
			//echo '<span class="bold" title="<b>'.$page.'</b> pages available">['.$page.']</span>';
			if ($current > 1) echo "<li><a href='".MAIN_URL.$fls[0]."?".$mm."start=0&page=$page' data-toggle='tooltip' title='To the first page'><i class='fa fa-chevron-left'></i></a></li>";
			else echo "<li class='disabled'><a data-toggle='tooltip' title='To the first page'><i class='fa fa-chevron-left'></i></a></li>";
			for ($i = $start_page; $i <= $end_page; $i++) {
				if ($current == $i) echo "<li class='active'><a>$i</a></li>";
				else {
					if (strlen(strstr($fl, '?')) <= 0) echo "<li><a class='page' href='".MAIN_URL.$fls[0]."?start=".($display*($i-1))."&page=$page'>$i</a></li>";
					else echo "<li><a class='page' href='".MAIN_URL.$fls[0]."?".$mm."start=".($display*($i-1))."&page=$page'>$i</a></li>";
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
