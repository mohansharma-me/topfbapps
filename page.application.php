<?php
if(!isset($pageData["app"])) {
	echo "Invalid AppID";
} else {
	$app=$pageData["app"];
	$isPreview=count(slug_array())>=2;
	if($isPreview)
	$previewImg="/gen-images/".slug(0)."-".slug(1).".png";
?>
<script>
var appPage=true;
var appSlug="<?=slug(0)?>";
var appShareURI="";
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=652082934872301";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="row">
    <div class="col s12 m12">
        <div class="grey lighten-3 head-row">
            <div class="row grey lighten-3" style="margin-bottom:0">
                <div class="col s12 m8 l8">
                    <h1 class="flow-text black-text darken-4" style="padding:0px;margin:8px 0px">
                        <div class="center hide-on-med-and-up -fb-login-status">
								<?=$app["appTitle"]?>
							</div>
                        <div class="hide-on-small-only -fb-login-status">
								<?=$app["appTitle"]?>
							</div>
                    </h1>
						<div class="hide-on-med-and-up center">
							<label class="black-text"><?=$app["appShortDesc"]?></label>
						</div>
						<div class="hide-on-small-only">
							<label class="black-text"><?=$app["appShortDesc"]?></label>
						</div>
					</div>
					<div class="col s12 m4 l4">
						<div class="hide-on-small-only right-align">
							<ul style="margin:0;margin-top:9px">
								<li style="display:inline-block"><a href="javascript:void" onClick='window.open("https://twitter.com/intent/tweet?text=Top Facebook Applications&tw_p=tweetbutton&url=http://topfbapps.com&via=topfbapps.com","_blank","width=400, height=400, resizable=false")'><img src="/imgs/social/twitter.png" class="" style="height:48px;width:48px" /></a></li>
								<li style="display:inline-block"><a href="javascript:void" onClick='window.open("https://www.facebook.com/sharer/sharer.php?u=http://topfbapps.com/&display=popup&ref=plugin&src=share_button","_blank","resizable=false")'><img src="/imgs/social/facebook.png" class="" style="height:48px;width:48px" /></a></li>
							</ul>
						</div>
					</div>
            </div>
        </div>
    </div>
</div>
<div class="row">
	<div class="col s12 m12">
		<div style="padding:0px 15px">
			<p><?=$app["appHTMLDesc"]?></p>
		</div>
	</div>
	
	<div class="col s12 m12">
		<div style="padding:0px 15px;margin:10px" class="center">
			<div class="staticDisplay" style="display:none">
				<div class="col s12 m12">
					<div class="col s12 m7">
						<?php
						$images=explode(",",$app["appShowcaseImgs"]);
						?>
						<img src="<?=$images[1]?>" class="output-img responsive-img" />
					</div>
					<div class="col s12 m5">
						<h5>You can create your own "Proud Indian" photo</h5>
						<br/><br/>
						<a class="login-now" href="javascript:void"><img src="/imgs/social/facebook_login.png" /></a>
					</div>
				</div>
			</div>
			<div class="app-output<?=$isPreview?"a":""?>" style="">
				<div class="output" style="display:none<?=$isPreview?"a":""?>">
					<div class="col s12 m12">
						<div class="col s12 m8">
							<img src="<?=$isPreview?$previewImg:""?>" class="output-img responsive-img" />
						</div>
						<div class="col s12 m4">
							<?php
							if($isPreview) {
								?>
								<h5>You can create your own "Proud Indian" photo</h5>
								<br/><br/>
								<a class="login-now" href="javascript:void"><img src="/imgs/social/facebook_login.png" /></a>
								<?php
							} else {
								?>
								<div class="left-algn">
									<ul>
										<li><a href="javascript:void" onClick='window.open("https://www.facebook.com/sharer/sharer.php?u="+$.shareURI+"&display=popup&ref=plugin&src=share_button","_blank","resizable=false")'><img src="/imgs/social/facebook1.png" /></a></li>
										<li><a href="javascript:void" onClick='window.open("https://twitter.com/intent/tweet?hashtags=ProudIndian&text=I am a Proud Indian, Are you?&tw_p=tweetbutton&url="+$.shareURI+"&via=topfbapps.com","_blank","width=400, height=400, resizable=false")'><img src="/imgs/social/twitter1.png" /></a></li>
										<li><a href="javascript:void" onClick='window.open("https://plus.google.com/share?url="+$.shareURI,"_blank","width=500, height=400, resizable=false")'><img src="/imgs/social/googleplus.png" /></a></li>
									</ul>
								</div>
								<?php
							}
							?>
						</div>
					</div>
				</div>
				<div class="preloader-wrapper big active output-loader <?=$isPreview?"hide":""?>">
				<div class="spinner-layer spinner-blue-only">
				<div class="circle-clipper left">
				<div class="circle"></div>
				</div><div class="gap-patch">
				<div class="circle"></div>
				</div><div class="circle-clipper right">
				<div class="circle"></div>
				</div>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col s12 m12">
		<div class="center">
		<?php
		//$images=explode(",",$app["appShowcaseImgs"]);
		unset($images[0]);
		unset($images[1]);
		foreach($images as $img) {
			?>
			<div class="col s12 m3">
				<div class="card">
					<div class="card-image">
						<img src="<?=$img?>" class="responsive-img" />
					</div>
				</div>
			</div>
			<?php
		}
		?>
		</div>
	</div>
</div>
<div class="row" style="margin-top:20px">
	<div class="col s12 m6">
		<div style="padding:10px 15px">
			<div class="fb-comments" style="width:100px" data-href="http://topfbapps.com/<?=slug(0)?>" data-numposts="5"></div>
		</div>
	</div>
	<div class="col s12 m6">
	</div>
</div>
<?php
}
?>