$.pageClick=function(e) {
	var loader=$("<div class='page-loader'></div>");
	var anchor=$(this);
	var pageName=$(anchor).attr("href");
	var page=pageName;
	$(".page-loader").show();
	if($(".button-collapse").is(":visible")) {
		$(".button-collapse").click();
	}
	
	$.ajax({
		url: page,
		error: function(err) {
			$(".page-loader .flow-text").html("ERROR");
		},
		success: function(data) {
			var div=$("<div>"+data+"</div>");
			document.title=window.title=$(div).find("title").html();
			$(".page").html($(div).find(".page").html());
			window.history.pushState(document.title, document.title, page);
			$(".page-loader").hide();
			$(anchor).parent().parent().find("li").removeClass("active");
			$(anchor).parent().addClass("active");
		}
	});
	return false;
};

$(document).ready(function() {
    $("a.nav-link").click($.pageClick);
});
