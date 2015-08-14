<div class="row">
    <div class="col s12 m12">
        <div class="grey lighten-3 head-row">
            <div class="row grey lighten-3" style="margin-bottom:0">
                <div class="col s12 m8 l8">
                    <h1 class="flow-text blue-grey-text darken-4" style="padding:0px;margin:25px 0px">
                        <div class="center hide-on-med-and-up fb-login-status">Hey!! You didn't logged onto Facebook.</div>
                        <div class="hide-on-small-only fb-login-status">Hey!! You didn't logged onto Facebook.</div>
                    </h1>
                </div>
                <div class="col s12 m4 l4">
                    <div  style="margin:20px;">
                        <div class="right-align hide-on-small-only">
                            <a class="login-now flow-text waves-effect waves-light btn blue darken-2 z-depth-1 hoverable">LOGIN</a>
                        </div>
                        <div class="center hide-on-med-and-up">
                            <a class="login-now flow-text waves-effect waves-light btn blue darken-2 z-depth-1 hoverable">LOGIN</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col s12 m12 hide">
        <div class="grey lighten-3 head-row">
            <div class="row grey lighten-3" style="margin-bottom:0">
                <div class="col s12 m3 l2">
                    <div class="center">
                        <img src="/imgs/test.png" class="circle fb-profile-pic" />
                    </div>
                </div>

                <div class="col s12 m3 l7 flow-text">
                    <div class="center hide-on-med-and-up">
                        Mohan Sharma<br/><br/>
                    </div>
                    <div class="hide-on-small-only" style="padding-top:20px">
                        Mohan Sharma<br/>
                    </div>
                </div>

                <div class="col s12 m6 l3">
                    <div  style="margin:20px;">
                        <div class="right-align hide-on-small-only">
                            <a class="flow-text waves-effect waves-light btn blue darken-2 z-depth-1 hoverable">LOGOUT</a>
                        </div>
                        <div class="center hide-on-med-and-up">
                            <a class="flow-text waves-effect waves-light btn blue darken-2 z-depth-1 hoverable">LOGOUT</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- GRID -->
<div class="row">
	<div class="col s12 m12">
		<div class="grid">
			<div class="row">
				<?php
				require_once "inc.database.php";
				$appList=apps();
				foreach($appList as $app) {
					$appImgs=explode(",",$app["appShowcaseImgs"]);
					?>
					<div class="col s12 m6 l4">
						<div class="card grey lighten-3">
							<div class="card-image"><a href="/<?=$app["appSlug"]?>" class="black-text"><img title="<?=$app["appShortDesc"]?>" alt="<?=$app["appShortDesc"]?>" src="<?=$appImgs[0]?>"/></a></div>
							<div class="start-button">
								<a class="btn waves-effect waves-light grey-blue darken-3">START</a>
							</div>
							<div class="card-content">
								<a href="/<?=$app["appSlug"]?>" class="black-text"><div class="flow-text"><b><?=$app["appTitle"]?></b></div></a>
							</div>
						</div>
					</div>
					<?php
				}
				?>
				<!--<div class="col s12 m6 l4">
					<div class="card grey lighten-3">
						<div class="card-image"><a href="" class="black-text"><img src="/imgs/banner.jpg"/></a></div>
						<div class="start-button">
							<a class="btn waves-effect waves-light grey-blue darken-3">START</a>
						</div>
						<div class="card-content">
							<a href="" class="black-text"><div class="flow-text"><b>Find your favorite style within a second!!</b></div></a>
						</div>
					</div>
				</div>-->
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
		$(".page .login-now").click($.loginButton);
});
</script>