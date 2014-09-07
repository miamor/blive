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


if ($_SESSION['fb_token'] && $member['token'] && $postToFb) {
	$response = (new FacebookRequest(
		$session, 'POST', '/me/feed', array(
			'message' 	=> str_replace(array('<div>', '</div>', '<p>', '</p>'), array('', '', '', ''), $pContent),
			'link' 		=> MAIN_URL.'/'.$pageTO.'.php?i='.$newPromise['id']
		)
	))->execute()->getGraphObject()->asArray();
}
?>
