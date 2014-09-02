<? use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookCurl;
use Facebook\HttpClients\FacebookCurlHttpClient;

use Facebook\Entities\AccessToken;
use Facebook\Entities\SignedRequest;

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookOtherException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphSessionInfo;

$pContent = _content($_POST['p-status']);
$pMoney = $_POST['p-money'];
$pMoneyType = $_POST['p-money-type'];
$pPrivacy = $_POST['p-privacy'];
if ($pContent == '<p><br></p>') $pContent = '';
if ($pContent && countRecord('promise', "`uid` = '$u' AND `content` = '$pContent' ") <= 0) {
	if (countRecord('promise', "`uid` = '$u' AND `content` = '$pContent' ") <= 0) {
		$add = insert('promise', "`uid`, `content`, `money`, `money-type`, `privacy`, `time`", " '$u', '$pContent', '$pMoney', '$pMoneyType', '$pPrivacy', '$curint' ");
		if ($add) {
			$newPromise = getRecord('promise^id,uid,content', "`uid` = '$u' AND `content` = '$pContent' ");
			$response = (new FacebookRequest(
				$session, 'POST', '/me/feed', array(
					'message' 	=> $pContent,
					'link' 		=> MAIN_URL.'/promise.php?i='.$newPromise['id']
				)
			))->execute()->getGraphObject()->asArray();
			print_r( $response );
			$content = str_replace(array('&nbsp;', '@'), array(' ', '+'), _content($pContent));
			$memTagAr = explode('+', $content);
			for ($j = 1; $j <= count($memTagAr); $j++) {
				$thisMem = explode(' ', $memTagAr[$j]);
				$thisMem = $thisMem[0];
				$thisMemIn = getRecord('members^id,username', "`username` = '$thisMem' ");
				$thisMemU = $thisMemIn['id'];
				if ($thisMemU != $u && in_array($thisMemU, $frAr)) sendNoti('mention-in-promise', $newPromise['id'], '', $thisMemU);
			}
//			if ($pPrivacy != 'draff') 
			insert('activity', "`privacy`, `uid`, `to_uid`, `type`, `iid`, `time`", " '{$pPrivacy}', '{$u}', '{$u}', 'new-promise', '{$newPromise['id']}', '{$curint}' ");
		}
	}
} ?>
