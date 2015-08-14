<?php
$appSlug=$_REQUEST["app"];
require_once "inc.image.php";
require_once "inc.database.php";
$app=apps($appSlug);
require_once "./Facebook/autoload.php";
$fb = new Facebook\Facebook([
	'app_id' => '1639552879592371',
	'app_secret' => '36e2def6e6e955f819eb90fcbf6c9d36',
	'default_graph_version' => 'v2.2',
]);
$url="https://graph.facebook.com/me/?access_token=".$_REQUEST["token"]."&fields=id,first_name,last_name,email,about,address,age_range,bio,birthday,education,gender,location,hometown";
$apiData=json_decode(file($url)[0],true);
$imgPath="./gen-images/".$appSlug."-".$apiData["id"].".png";
header("Content-Type: image/png");
if(!file_exists($imgPath) || !is_file($imgPath)) {
	getImageData(json_decode($app[0]["appJSON"],true),$apiData,$imgPath);
}
if(file_exists($imgPath) && is_file($imgPath)) {
	header("Location: ".$imgPath);
}
exit(0);
require_once "inc.image.php";
$canvasProp=array();
$canvasProp["height"]=630;
$canvasProp["width"]=1200;
$canvasProp["background"]="88000000";
$canvasProp["objects"]=array();

$obj=array();
$obj["type"]="image";
$obj["image"]="./imgs/app1.png";
$obj["x"]=$obj["y"]=0;
$obj["w"]=1200;
$obj["h"]=630;
$canvasProp["objects"][]=$obj;

$obj["x"]=864;
$obj["y"]=156;
$obj["type"]="image";
$obj["w"]=252;
$obj["h"]=252;
$obj["image"]="profile_picture";
$obj["scale_w"]=$obj["scale_h"]=255;
$canvasProp["objects"][]=$obj;

$obj["y"]=120;
$obj["type"]="box";
$obj["h"]=350;
$obj["w"]=350;
$obj["foreground"]="FF000000";
$obj["background"]="FF00FF00";
//$canvasProp["objects"][]=$obj;

$obj["x"]=10;
$obj["y"]=10;
$obj["type"]="text";
$obj["text"]="field_first_name";
$obj["foreground"]="FF000000";
$canvasProp["objects"][]=$obj;

file_put_contents("sample.json",json_encode($canvasProp));

$json=json_decode(file_get_contents("sample.json"), true);

if(isset($_GET["debug"])) {
	echo "<pre>";
	print_r($json);
	echo "</pre>";
} else {
	header("Content-Type: image/png");
	print getImageData($json);
}
