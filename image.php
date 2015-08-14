<?php
$canvasProp=array();
$canvasProp["height"]=480;
$canvasProp["width"]=640;
$canvasProp["background"]="88000000";
$canvasProp["objects"]=array();

$obj=array();
$obj["type"]="image";
$obj["image"]="./imgs/banner.jpg";
$obj["x"]=$obj["y"]=0;
$obj["w"]=640;
$obj["h"]=480;
$canvasProp["objects"][]=$obj;

$obj["x"]=40;
$obj["y"]=40;
$obj["type"]="text";
$obj["text"]="Welcome";
$obj["font"]="./font/app/default.ttf";
$obj["foreground"]="FF000000";
$canvasProp["objects"][]=$obj;

$obj["y"]=80;
$obj["type"]="image";
$obj["image"]="./imgs/test.png";
$obj["w"]=120;
$obj["h"]=120;
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

function getImageData($app,$data=null) {
	$img=imagecreatetruecolor($app["width"],$app["height"]);
	imagesavealpha($img,true);
	imageAlphaBlending($img, true);
	
	if(isset($app["background"]))
		imagefill($img,0,0,getColorId($img,$app["background"]));
	
	foreach($app["objects"] as $object) {
		switch($object["type"]) {
			case "image":
				list($imgWidth,$imgHeight)=getimagesize($object["image"]);
				$srcImage=imagecreatefromstring(file_get_contents($object["image"]));
				$sX=isset($object["source_x"])?$object["source_x"]:0;
				$sY=isset($object["source_y"])?$object["source_y"]:0;
				$sW=isset($object["source_w"])?$object["source_w"]:$imgWidth;
				$sH=isset($object["source_h"])?$object["source_h"]:$imgHeight;
				$dW=isset($object["w"])?$object["w"]:$imgWidth;
				$dH=isset($object["h"])?$object["h"]:$imgHeight;
				imagecopyresampled($img,$srcImage,$object["x"],$object["y"],$sX,$sY,$dW,$dH,$sW,$sH);
			break;
			
			case "box":
				$borderWidth=0;
				if(isset($object["foreground"])) {
					$borderWidth=1;
					imagerectangle($img,$object["x"],$object["y"],$object["x"]+$object["w"],$object["y"]+$object["h"],getColorId($img,$object["foreground"]));
				}
				if(isset($object["background"]))
					imagefilledrectangle($img,$object["x"]+$borderWidth,$object["y"]+$borderWidth,$object["x"]+$object["w"]-($borderWidth*2),$object["y"]+$object["h"]-($borderWidth*2),getColorId($img,$object["background"]));
			break;
			
			case "text":
				$fontFile=isset($object["font"])?$object["font"]:"font/app/default.ttf";
				$size=isset($object["size"])?$object["size"]:16;
				$angle=isset($object["angle"])?$object["angle"]:0;
				$rect=imagettfbbox($size,$angle,$fontFile,$object["text"]);
				//text background logic
				imagettftext($img, $size,$angle,$object["x"],$object["y"], getColorId($img,$object["foreground"]),$fontFile,$object["text"]);
			break;
		}
	}
	
	ob_clean();
	imagepng($img);
	$imgData=ob_get_clean();
	return $imgData;
}

function getColorId($image,$str) {
	$a=hexdec(substr($str,0,2));
	$a=100-($a*100/255);
	$r=substr($str,2,2);
	$g=substr($str,4,2);
	$b=substr($str,6,2);
	return imagecolorallocatealpha($image, hexdec($r), hexdec($g), hexdec($b), $a);
}