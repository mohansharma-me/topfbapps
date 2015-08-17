$.loginButton=function() {
	var a=$(this).attr("href");
	window.open(a,"_blank","width=575 height=500");
	return false;
};

$.logoutButton=function() {
	
}

$.docReady=function() {
	$(".button-collapse").sideNav();
	if($(".hide-on-med-and-up").is(":visible")) {
		$(".fb-app").addClass("z-depth-0");
	}
	$(".login-now").click($.loginButton);	
};
