<?

$lang = array (
	'like' 	=>	'Like',
	'unlike' 			=>		'Like',
	'share' 			=>		'Share',
	'comment' 			=>		'Comment',
	'view-all-vote' 		=> 		'View all votes',
	'believe-button'		=>		'Believe',
	'believe-not-button'	=>		'',
	'know-button'		=>		'Know',
	'know-not-button'		=>		'',
	'believe-title'		=>		'I believe '.possessive($gdi['uid']),
	'believe-not-title'		=>		'No I don\'t believe '.possessive($gdi['uid']),
	'know-title'			=>		'I know '.vocative($gdi['uid']).' did',
	'know-not-title'		=>		'I know '.vocative($gdi['uid']).' didn\'t',
);

function possessive ($uid) {
	$uIn = getRecord('members^id,gender', "`id` = '$uid' ");
	if ($uIn['gender'] == 'female') $possessive = 'her';
	else $possessive = 'him';
//	$lang['possessive'] = $possessive;
	return $possessive;
}
function vocative ($uid) {
	$uIn = getRecord('members^id,gender', "`id` = '$uid' ");
	if ($uIn['gender'] == 'female') $vocative = 'she';
	else $vocative = 'he';
//	$lang['vocative'] = $vocative;
	return $vocative;
}
function pronoun ($uid) {
	$uIn = getRecord('members^id,gender', "`id` = '$uid' ");
	if ($uIn['gender'] == 'female') $pronoun = 'her';
	else $pronoun = 'him';
//	$lang['pronoun'] = $pronoun;
	return $pronoun;
}
?>
