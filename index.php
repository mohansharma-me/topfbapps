<?php
session_start();
if(isset($_GET["fbLogout"])) {
	unset($_SESSION["fbLoginURI"]);
	unset($_SESSION["fbToken"]);
	$redirect=filter_input(INPUT_GET,"redirect");
	if(isset($redirect)) {
		header("Location: ".$redirect);
	}
}
require_once "./inc.theme.php";
require_once "./Facebook/autoload.php";
$_SESSION["fbAppID"]="1639552879592371";
$_SESSION["fbSecretID"]="36e2def6e6e955f819eb90fcbf6c9d36";
$fbApp = new Facebook\Facebook([
	'app_id' => $_SESSION["fbAppID"],
	'app_secret' => $_SESSION["fbSecretID"],
	'default_graph_version' => 'v2.4',
]);
$fbHelper = $fbApp->getRedirectLoginHelper();
$_SESSION["fbAlive"]=isset($_SESSION["fbToken"]);
if(!$_SESSION["fbAlive"]) {
	$permissions = ['email', 'public_profile'];
	$loginUrl = "";
	try {
		if(!isset($_SESSION["fbLoginURI"])) {
			$_SESSION["fbLoginUri"]=$fbHelper->getLoginUrl('http://topfbapps.com/fb_callback.php', $permissions);
			$_SESSION["fbLoginUri"].="&display=iframe";
		}
	} catch( FacebookRequestException $e ) {
		echo 'Graph returned an error: ' . $e->getMessage();
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
	}
}

if(!isset($_GET['__key']))
{
	header('Location: /real-proud-indian');
}

if(isset($_SESSION["fbToken"]) && !isset($_SESSION["fbUser"])) {
	$url="https://graph.facebook.com/me/?access_token=".$_SESSION["fbToken"]."&fields=id,first_name,last_name,email,about,address,age_range,bio,birthday,education,gender,location,hometown";
	$_SESSION["fbUser"]=json_decode(file($url)[0],true);
}

$defaultTitle="Apps";
$defaultPage="application";
$pageKind=page_init($defaultTitle,$defaultPage);
$pageData=array();

if($pageKind==APP_PAGE) {
	$newTitle=$defaultTitle;
	$pageData["app"]=app_init($newTitle);
	if(count($pageData["app"])>0) {
		$defaultTitle=$newTitle;
		$defaultPage="application";
	} else {
		$defaultPage="apps";
	}
}

if(isset($_GET["redirect"]) && $_SESSION["fbAlive"] && isset($pageData["app"]) && (count(slug_array())==1 || $_SESSION["fbUser"]["id"]!=slug(1))) {
	$imgPath="./gen-images/".slug(0)."-".$_SESSION["fbUser"]["id"].".png";
	if(!file_exists($imgPath) || !is_file($imgPath)) {
		require_once "inc.image.php";
		require_once "inc.database.php";
		exeSQL('insert into users(userData) values("'.addslashes(json_encode($_SESSION["fbUser"])).'")');
		getImageData(json_decode($pageData["app"]["appJSON"],true),$_SESSION["fbUser"],$imgPath);
	}
	header("Location: /".slug(0)."/".$_SESSION["fbUser"]["id"]);
	exit(0);
}

// THEME INIT
start_html();
	start_head($defaultTitle." - TopFBApps");
		if(isset($pageData["app"])) {
			?>
			<meta property="description" content="<?=$pageData["app"]["appTitle"]?>" />
			<meta property="keywords" content="<?=$pageData["app"]["appMetaKeyword"]?>" />
			<meta property="og:image" content="<?=$pageData["app"]["appMetaImage"]?>"/>
			<?php
		}
		if(count(slug_array())>=2) {
			?>
			<meta property="og:title" content="<?=$pageData["app"]["appMetaTitle"]?>" />
			<meta property="og:image" content="http://topfbapps.com/gen-images/<?=$pageData["app"]["appSlug"]?>-<?=slug(1)?>.png"/>
			<meta property="og:description" content="<?=$pageData["app"]["appMetaDesc"]?>" />
			
			<?php
		}
	end_head();
	start_body();
		page_nav();
		start_content_area();
			include_page($defaultPage,$pageData);
		end_content_area();
		include_scripts();
	end_body();
end_html();