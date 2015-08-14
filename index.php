<?php
session_start();
require_once "inc.theme.php";

if(count(slug_array())==0) {
	header("Location: /proud-indian");
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

// THEME INIT
start_html();
	start_head($defaultTitle." - TopFBApps");
		if(isset($pageData["app"])) {
			?>
			<meta property="description" content="<?=$pageData["app"]["appTitle"]?>" />
			<meta property="keywords" content="<?=$pageData["app"]["appMetaKeyword"]?>" />
			<?php
		}
		if(count(slug_array())>=2) {
			?>
			<meta property="og:title" content="<?=$pageData["app"]["appMetaTitle"]?>" />
			<meta property="og:image" content="http://topfbapps.com/gen-images/<?=$pageData["app"]["appSlug"]?>-<?=slug(1)?>.png"/>
			<meta property="og:description" content="<?=$pageData["app"]["appMetaDesc"]?>" />
			<meta property="og:image:width" content="640" /> 
			<meta property="og:image:height" content="442" />
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