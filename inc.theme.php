<?php
// CONTANTS
define("BASIC_PAGE",0x000001);
define("APP_PAGE",0x000002);

// APPLICATION FUNCTIONS

function app_init(&$title) {
	require_once "inc.database.php";
	$app=apps(slug(0));
	if(count($app)==1) {
		$app=$app[0];
		$title=$app["appTitle"];
	}
	return $app;
}

// BASIC SLUG FUNCTIONS

function slug($number) {
	return slug_array()[$number];
}

function slug_array() {
	$keys=filter_input(INPUT_GET,"__key");
	return explode("/", isset($keys)?$keys:"proud-indian");
}

function toslug($text) {
	$text = preg_replace('~[^\\pL\d]+~u', '-', $text);
	$text = trim($text, '-');
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	$text = strtolower($text);
	$text = preg_replace('~[^-\w]+~', '', $text);
	if (empty($text))
	{
		return 'n-a';
	}
	return $text;
}

// BASIC PAGE FUNCTIONS

function page_init(&$title,&$page) {
	switch(slug(0)) {
		case "apps": case "contact-us":
			// title generation logic goes here...
			$page=slug(0);
			return BASIC_PAGE;
		default:
			$page="application";
			return APP_PAGE;
	}
}

function start_html() {
	echo "<!DOCTYPE html>";
	echo "<html>";
}

function end_html() {
	echo "</html>";
}

function start_head($titleOfPage) {
	echo "<head>";
	require_once "./theme/head.php";
	echo "<title>$titleOfPage</title>";
}

function end_head() {
	?>
	<!-- Facebook Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
	n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
	document,'script','//connect.facebook.net/en_US/fbevents.js');

	fbq('init', '1642197346025300');
	fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=1642197346025300&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Facebook Pixel Code -->
	<?php
	echo "</head>";
}

function start_body() {
	echo "<body>";
}

function getPageURL() {
	return "http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI];
}

function end_body() {
	echo "</body>";
}

function page_nav() {
	?>
	<nav class="color blue darken-3" style="position:fixed;z-index:99999">
		<div style="padding-left:20px">
			<a href="/" class="brand-logo">
				<div class="hide-on-med-and-up" style="margin-top:5px"></div>
				<img src="/imgs/logo.png" class="responsive-img" style="margin-top:4%;width:240px;" />
			</a>
		</div>
		<ul class="right hide-on-med-and-down">
			<?php
			if($_SESSION["fbAlive"]) {
			?>
			<li class="active"><a href="javascript:void" style="padding-top:0;padding-bottom:0;"><img src="http://graph.facebook.com/<?=$_SESSION["fbUser"]["id"]?>/picture?width=100&height=100" class="responsive-img fb-profile-pic circle" style="vertical-align:middle;height:50px;width:50px;margin-top:-8px" />&nbsp;&nbsp;<span class="flow-text white-text fb-name" style="font-size:1.3em"><?=$_SESSION["fbUser"]["first_name"]?></span></a></li>
			<li><a href="?fbLogout=yes&redirect=<?=getPageURL()?>">LOGOUT</a></li>
			<?php
			} else {
			?>
			<li><a href="<?=$_SESSION["fbLoginURI"]?>" class="waves-effect waves-light login-now">LOGIN</a></li>
			<?php
			}
			?>
			<li class="active"><a href="/" class="nav-link waves-effect waves-light">APPS</a></li>
		</ul>
		<ul id="slide-out" class="side-nav">
			<li><a href="<?=$_SESSION["fbLoginURI"]?>" class="nav-link waves-effect waves-light login-now">LOGIN</a></li>
			<li class="active"><a href="/" class="nav-link waves-effect waves-light">APPS</a></li>
		</ul>
		<a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu" style="padding-left:10px"></i></a>
	</nav>
	<?php
}

function start_content_area($showHeaderImage=true) {
	echo "<div class='content-area'>";
	//require_once "./theme/page-loader.php"; // PAGE LOADER (Only Design)
	if($showHeaderImage) {
		echo '<div class="header-image"></div>';
	}
	echo '<main class="page container white z-depth-3">';
	echo '<div class="mobile-page hide-on-med-and-up"></div>';
}

function end_content_area($includeFooter=true) {
	echo "</main>";
	if($includeFooter) {
		require_once "./theme/footer.php";
	}
	?>
	<script>
	 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	 })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	 ga('create', 'UA-66297573-1', 'auto');
	 ga('send', 'pageview');

	</script>
	<?php
	echo '<div class="hide-on-med-and-up"></div>';
	echo "</div>";
}

function include_page($pageName,$pageData) {
    $pageFile="page.$pageName.php";
	if(is_file($pageFile) && file_exists($pageFile)) require_once $pageFile;
	// custom invalid slug error page in ELSE condition
}

function include_scripts() {
	?>
	<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="/js/materialize.min.js"></script>	
	<script type="text/javascript" src="/js/general.js"></script>
	<script>$(document).ready($.docReady);</script>
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=1532066743742972";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	<?php
}