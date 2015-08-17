<?php
if(!isset($pageData["app"])) {
	echo "Invalid AppID";
} else {
	$slugCount=count(slug_array());
	$app=$pageData["app"];
	$isPreview=$slugCount>=2;
	if($isPreview)
		$previewImg="/gen-images/".slug(0)."-".slug(1).".png";
?>
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
								<li style="display:inline-block"><a href="javascript:void" onClick='window.open("https://www.facebook.com/sharer/sharer.php?u=http://topfbapps.com/&display=popup&ref=plugin&src=share_button","_blank","width=400, height=400, resizable=false")'><img src="/imgs/social/facebook.png" class="" style="height:48px;width:48px" /></a></li>
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
		<div style="padding:0px;margin:10px">
		<?php
		if($isPreview) {
			?>
			<div class="col s12 m8">
				<img class="responsive-img" style="width:100%" src="/gen-images/<?=slug(0)?>-<?=slug(1)?>.png" />
			</div>
			<div class="col s12 m4">
				<?php
				if($_SESSION["fbAlive"] && $slugCount==2 && $_SESSION["fbUser"]["id"]==slug(1)) {
				?>
				<center>
					<ul>
						<li><a href="http://www.facebook.com/sharer/sharer.php?caption=<?=$app["appShareMessage"]?>&u=http://topfbapps.com/<?=slug(0)?>/<?=slug(1)?>" class="login-now"><img src="/imgs/social/facebook1.png" /></a></li>
						<li><a href="https://twitter.com/intent/tweet?text=<?=$app["appShareMessage"]?>&url=http://topfbapps.com/<?=slug(0)?>/<?=slug(1)?>" class="login-now"><img src="/imgs/social/twitter1.png" /></a></li>
					</ul>
				</center>
				<?php
				} else {
					if($_SESSION["fbAlive"]) {
						?>
						<center>
							<h3 class="flow-text"><?=$app["appIncentive"]?></h3>
							<a href="<?=$_SESSION["fbLoginURI"]?>" class="btn waves-effect waves-light green login-now">CREATE</a>
						</center>
						<?php
					} else {
						?>
						<center>
							<h3 class="flow-text"><?=$app["appLoginIncentive"]?></h3>
							<a href="<?=$_SESSION["fbLoginURI"]?>" class="login-now"><img src="/imgs/social/facebook_login.png" /></a>
						</center>
						<?php
					}
				}
				?>
			</div>
			<?php
		} else {
			if(false) {
			} else {
		?>
			<div class="col s12 m8">
				<img class="responsive-img" style="width:100%" src="/imgs/demo.png" />
			</div>
			<div class="col s12 m4">
				<?php
				if($_SESSION["fbAlive"]) {
					?>
					<center>
						<h3 class="flow-text"><?=$app["appIncentive"]?></h3>
						<a href="<?=$_SESSION["fbLoginURI"]?>" class="btn waves-effect waves-light green login-now">CREATE</a>
					</center>
					<?php
				} else {
					?>
					<center>
						<h3 class="flow-text"><?=$app["appLoginIncentive"]?></h3>
						<a href="<?=$_SESSION["fbLoginURI"]?>" class="login-now"><img src="/imgs/social/facebook_login.png" /></a>
					</center>
					<?php
				}
				?>
				<!--<center>
					<h3 class="flow-text"><?=$app["appIncentive"]?></h3>
					<a href="<?=$_SESSION["fbLoginURI"]?>" class="login-now"><img src="/imgs/social/facebook_login.png" /></a>
				</center>-->
			</div>
		<?php
			}
		}
		?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col s12 m7">
		<div style="padding:10px 15px">
			<div class="fb-comments" data-href="http://topfbapps.com/<?=slug(0)?>" data-numposts="5"></div>
		</div>
	</div>
</div>
<?php
}
?>