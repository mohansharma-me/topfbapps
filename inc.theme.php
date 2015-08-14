<?php
// CONTANTS
define("BASIC_PAGE",0x000001);
define("APP_PAGE",0x000002);

// APPLICATION FUNCTIONS

function app_init(&$title) {
	$title=slug(0);
}

// BASIC SLUG FUNCTIONS

function slug($number) {
	return slug_array()[$number];
}

function slug_array() {
	$keys=filter_input(INPUT_GET,"__key");
	return explode("/", isset($keys)?$keys:"home");
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
		case "home": case "contact-us":
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
	echo "<script type='text/javascript'>var pageInited=false;</script>";
	echo "</head>";
}

function start_body() {
	echo "<body>";
}

function end_body() {
	echo "</body>";
}

function page_nav() {
	?>
	<nav class="color blue darken-3" style="position:fixed;z-index:99999">
		<div style="padding-left:20px">
			<a href="/" class="brand-logo"><img src="/imgs/logo.png" style="height:60px;width:240px" /></a>
		</div>
		<ul class="right hide-on-med-and-down">
			<li class="active"><a href="" class="nav-link waves-effect waves-light">APPS</a></li>
			<li><a href="login" class="waves-effect waves-light login-now">LOGIN</a></li>
			<li><a class="nav-link waves-effect waves-light" href="contact-us">CONTACT US</a></li>
		</ul>
		<ul id="slide-out" class="side-nav">
			<li class="active"><a href="#apps" class="nav-link waves-effect waves-light">APPS</a></li>
			<li><a href="#" class="nav-link waves-effect waves-light login-now">LOGIN</a></li>
			<li><a href="#contact-us" class="nav-link waves-effect waves-light">CONTACT US</a></li>
		</ul>
		<a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu" style="padding-left:10px"></i></a>
	</nav>
	<?php
}

function start_content_area($showHeaderImage=true) {
	echo "<div class='content-area'>";
	require_once "./theme/page-loader.php"; // PAGE LOADER (Only Design)
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
	echo '<div class="hide-on-med-and-up"></div>';
	echo "</div>";
}

function include_page($pageName) {
    $pageFile="page.$pageName.php";
	if(is_file($pageFile) && file_exists($pageFile)) require_once $pageFile;
	// custom invalid slug error page in ELSE condition
}

function include_scripts() {
	?>
	<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="/js/materialize.min.js"></script>
	<script type="text/javascript" src="/js/pageLoader.js"></script>
	<script type="text/javascript" src="/js/general.js"></script>
	<script>$(document).ready($.docReady);</script>
	<?php
}