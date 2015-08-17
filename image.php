<?php
session_start();
$appSlug=$_REQUEST["app"];
require_once "inc.image.php";
require_once "inc.database.php";
$app=apps($appSlug);
$apiData=$_SESSION["fbUser"];
$imgPath="./gen-images/".$appSlug."-".$apiData["id"].".png";
header("Content-Type: image/png");
if(!file_exists($imgPath) || !is_file($imgPath)) {
	require_once "inc.database.php";
	exeSQL('insert into users(userData) values("'.addslashes(json_encode($apiData)).'")');
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
