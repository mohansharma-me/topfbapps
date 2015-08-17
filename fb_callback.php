<?php
session_start();
require_once "./Facebook/autoload.php";
$fbApp = new Facebook\Facebook([
	'app_id' => '1639552879592371',
	'app_secret' => '36e2def6e6e955f819eb90fcbf6c9d36',
	'default_graph_version' => 'v2.4',
]);
$fbHelper = $fbApp->getRedirectLoginHelper();
try {
	$code=filter_input(INPUT_GET,"code");
	$state=filter_input(INPUT_GET,"state");
	if(isset($code,$state)) {
		$fbHelper = $fbApp->getRedirectLoginHelper();
		$accessToken = $fbHelper->getAccessToken();
		$_SESSION['fbToken'] = (string) $accessToken;
		$url="https://graph.facebook.com/me/?access_token=".$_SESSION["fbToken"]."&fields=id,first_name,last_name,email,about,address,age_range,bio,birthday,education,gender,location,hometown";
		$_SESSION["fbUser"]=json_decode(file($url)[0],true);
		?>
		<script>
			window.opener.location=window.opener.location+"?redirect=yes";
			window.close();
		</script>
		<?php
		exit(0);
	}
} catch( FacebookRequestException $e ) {
	echo 'Graph returned an error: ' . $e->getMessage();
} catch(Facebook\Exceptions\FacebookSDKException $e) {
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
}