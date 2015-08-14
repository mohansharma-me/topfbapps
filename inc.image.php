<?php
function getImageData($app,$apiData,$saveToDisk=null) {
	$img=imagecreatetruecolor($app["width"],$app["height"]);
	imagesavealpha($img,true);
	imageAlphaBlending($img, true);
	
	if(isset($app["background"]))
		imagefill($img,0,0,getColorId($img,$app["background"]));
	
	foreach($app["objects"] as $object) {
		switch($object["type"]) {
			case "image":
				if($object["image"]=="profile_picture") {
					$scaleW=128;
					$scaleH=128;
					if(isset($object["scale_w"])) $scaleW=$object["scale_w"];
					if(isset($object["scale_h"])) $scaleH=$object["scale_h"];
					
					$h_tmp=tmpfile();
					fwrite($h_tmp,file_get_contents("http://graph.facebook.com/".$apiData["id"]."/picture?width=$scaleW&height=$scaleW"));
					$object["image"]=stream_get_meta_data($h_tmp)["uri"];
				} else {
					$multiImgs=explode("|",$output["image"]);
					$output["image"]=$multiImgs[rand(0,count($multiImgs)-1)];
				}
				
				list($imgWidth,$imgHeight)=getimagesize($object["image"]);
				$sourceImageString=file_get_contents($object["image"]);
				$srcImage=imagecreatefromstring($sourceImageString);
				$sX=isset($object["source_x"])?$object["source_x"]:0;
				$sY=isset($object["source_y"])?$object["source_y"]:0;
				$sW=isset($object["source_w"])?$object["source_w"]:$imgWidth;
				$sH=isset($object["source_h"])?$object["source_h"]:$imgHeight;
				$dW=isset($object["w"])?$object["w"]:$imgWidth;
				$dH=isset($object["h"])?$object["h"]:$imgHeight;
				imagecopyresampled($img,$srcImage,$object["x"],$object["y"],$sX,$sY,$dW,$dH,$sW,$sH);
				if(isset($h_tmp))
					fclose($h_tmp);
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
				$outputString=$object["text"];
				if(substr($outputString,0,4)=="get_") {
					$outputString=$_REQUEST[str_replace("get_","",$outputString)];
				}
				if(substr($outputString,0,6)=="field_") {
					$outputString=$apiData[str_replace("field_","",$outputString)];
				}
				$fontFile=isset($object["font"])?$object["font"]:"font/app/default.ttf";
				$size=isset($object["size"])?$object["size"]:16;
				$angle=isset($object["angle"])?$object["angle"]:0;
				$rect=imagettfbbox($size,$angle,$fontFile,$outputString);
				//text background logic
				imagettftext($img, $size,$angle,$object["x"],$object["y"], getColorId($img,$object["foreground"]),$fontFile,$outputString);
			break;
		}
	}
	
	ob_clean();
	imagepng($img,$saveToDisk,9,PNG_ALL_FILTERS);
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