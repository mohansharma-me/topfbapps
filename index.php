<?php
session_start();
require_once "inc.theme.php";

$defaultTitle="Apps";
$defaultPage="home";
$pageKind=page_init($defaultTitle,$defaultPage);

if($pageKind==APP_PAGE) {
	app_init($defaultTitle);
}

// THEME INIT
start_html();
	start_head($defaultTitle." - TopFBApps");		
	end_head();
	start_body();
		page_nav();
		start_content_area();
			include_page($defaultPage);
		end_content_area();
		include_scripts();
	end_body();
end_html();