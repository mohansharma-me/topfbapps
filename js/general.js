$.loginButton=function() {
	alert("Login");
	return false;
};

$.docReady=function() {
	$(".button-collapse").sideNav();
	if($(".hide-on-med-and-up").is(":visible")) {
		$(".fb-app").addClass("z-depth-0");
	}
	$(".login-now").click($.loginButton);
};
