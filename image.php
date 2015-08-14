<?php
$canvasProp=array();
$canvasProp["height"]=480;
$canvasProp["width"]=640;
$canvasProp["background"]="88000000";
$canvasProp["objects"]=array();

$obj=array();
$obj["x"]=10;
$obj["y"]=0;
$obj["h"]=32;
$obj["w"]=620;
$obj["type"]="box";
$obj["background"]="FF0000FF";
$obj["foreground"]="FFFFFFFF";

$canvasProp["objects"][]=$obj;

$obj["x"]=40;
$obj["y"]=40;
$obj["type"]="text";
$obj["text"]="Welcome";
$obj["foreground"]="FF00FF00";
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

function calculateTextBox($fontSize,$fontAngle,$fontFile,$text) { 
    $rect = imagettfbbox($fontSize,$fontAngle,$fontFile,$text); 
    $minX = min(array($rect[0],$rect[2],$rect[4],$rect[6])); 
    $maxX = max(array($rect[0],$rect[2],$rect[4],$rect[6])); 
    $minY = min(array($rect[1],$rect[3],$rect[5],$rect[7])); 
    $maxY = max(array($rect[1],$rect[3],$rect[5],$rect[7])); 
    
    return array( 
     "left"   => abs($minX) - 1, 
     "top"    => abs($minY) - 1, 
     "width"  => $maxX - $minX, 
     "height" => $maxY - $minY, 
     "box"    => $rect 
    ); 
} 