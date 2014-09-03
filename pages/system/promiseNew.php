<? require_once( $libPath . '/Facebook/HttpClients/FacebookHttpable.php' );
require_once( $libPath . '/Facebook/HttpClients/FacebookCurl.php' );
require_once( $libPath . '/Facebook/HttpClients/FacebookCurlHttpClient.php' );

require_once( $libPath . '/Facebook/Entities/AccessToken.php' );
require_once( $libPath . '/Facebook/Entities/SignedRequest.php' );

require_once( $libPath . '/Facebook/FacebookSession.php' );
require_once( $libPath . '/Facebook/FacebookRedirectLoginHelper.php' );
require_once( $libPath . '/Facebook/FacebookRequest.php' );
require_once( $libPath . '/Facebook/FacebookResponse.php' );
require_once( $libPath . '/Facebook/FacebookSDKException.php' );
require_once( $libPath . '/Facebook/FacebookRequestException.php' );
require_once( $libPath . '/Facebook/FacebookOtherException.php' );
require_once( $libPath . '/Facebook/FacebookAuthorizationException.php' );
require_once( $libPath . '/Facebook/GraphObject.php' );
require_once( $libPath . '/Facebook/GraphSessionInfo.php' );

use Facebook\HttpClients\FacebookHttpable;
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

$facebook = FacebookSession::setDefaultApplication($social_conf['Facebook']['id'], $social_conf['Facebook']['secret']);

$helper = new FacebookRedirectLoginHelper(MAIN_URL.'/fb.php');

if (isset($_SESSION) && isset($_SESSION['fb_token'])) {
	$session = new FacebookSession($_SESSION['fb_token']);
	try {
		if (!$session->validate()) $session = null;
	} catch (Exception $e) {
		$session = null;
	}
}  

if (isset($session)) {
	$_SESSION['fb_token'] = $session->getToken();
	$session = new FacebookSession( $session->getToken() );
}


$pContent = _content($_POST['p-status']);
$pMoney = $_POST['p-money'];
$pMoneyType = $_POST['p-money-type'];
$pPrivacy = $_POST['p-privacy'];
$link = $_POST['thumb-link'];
$link_img = $_POST['thumb-link-img'];
$link_title = $_POST['thumb-link-title'];
$link_content = $_POST['thumb-link-content'];
$postToFb = $_POST['post-to-fb'];
if ($pContent == '<p><br></p>') $pContent = '';
if ($pContent && countRecord('promise', "`uid` = '$u' AND `content` = '$pContent' ") <= 0) {
	if (countRecord('promise', "`uid` = '$u' AND `content` = '$pContent' ") <= 0) {
		$add = insert('promise', "`uid`, `content`, `money`, `money-type`, `privacy`, `thumb-link`, `thumb-link-img`, `thumb-link-title`, `thumb-link-content`, `time`", " '$u', '$pContent', '$pMoney', '$pMoneyType', '$pPrivacy', '$link', '$link_img', '$link_title', '$link_content', '$curint' ");
		if ($add) {
			$newPromise = getRecord('promise^id,uid,content', "`uid` = '$u' AND `content` = '$pContent' ");
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
			if ($_SESSION['fb_token'] && $member['token'] && $postToFb) {
				$response = (new FacebookRequest(
					$session, 'POST', '/me/feed', array(
						'message' 	=> str_replace(array('<div>', '</div>', '<p>', '</p>'), array('', '', '', ''), $pContent),
						'link' 		=> MAIN_URL.'/promise.php?i='.$newPromise['id']
					)
				))->execute()->getGraphObject()->asArray();
			}
		}
	}
} ?>
