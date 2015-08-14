$.loginButton=function() {
	alert("Login");
	return false;
};

function statusChangeCallback(response) {
console.log('statusChangeCallback');
console.log(response);
// The response object is returned with a status field that lets the
// app know the current login status of the person.
// Full docs on the response object can be found in the documentation
// for FB.getLoginStatus().
if (response.status === 'connected') {
  // Logged into your app and Facebook.
  testAPI();
} else if (response.status === 'not_authorized') {
  // The person is logged into Facebook, but not your app.
  $(".fb-login-status").html("Hey!! You didn't logged onto Facebook.!");
} else {
  // The person is not logged into Facebook, so we're not sure if
  // they are logged into this app or not.
  $(".fb-login-status").html("Hey!! You didn't logged onto Facebook.!");
}
}

function checkLoginState() {
FB.getLoginStatus(function(response) {
  statusChangeCallback(response);
});
}

 window.fbAsyncInit = function() {
  FB.init({
    appId      : '1639552879592371',
    cookie     : true,  // enable cookies to allow the server to access // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use version 2.2
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

};
  
$.docReady=function() {
	$(".button-collapse").sideNav();
	if($(".hide-on-med-and-up").is(":visible")) {
		$(".fb-app").addClass("z-depth-0");
	}
	$(".login-now").click($.loginButton);
};
