<!DOCTYPE html>
<html>
<head>
	<?php
        require_once "./theme/head.php";
    ?>
    <title>TopFBApps</title>
</head>
<body>	
    
    <!-- NAVIGATION --> <?php require_once "./theme/nav.php"; ?>

    
    <div class="content-area">
        
        <!-- PAGE LOADER --> <?php require_once "./theme/page-loader.php"; ?>
    
        <!-- HEADER IMAGE --> <?php require_once "./theme/header-image.php"; ?>

        <!-- CONTENT AREA -->
        <main class="page container white z-depth-3">
            <div class="mobile-page hide-on-med-and-up"></div>
            <div class="row">
                <div class="col s12 m12">
                    <div class="grey lighten-3 head-row">
                        <div class="row grey lighten-3" style="margin-bottom:0">
                            <div class="col s12 m8 l8">
                                <h1 class="flow-text blue-grey-text darken-4" style="padding:0px;margin:25px 0px">
                                    <div class="center hide-on-med-and-up">Hey!! You didn't logged onto Facebook.</div>
                                    <div class="hide-on-small-only">Hey!! You didn't logged onto Facebook.</div>
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
                            for($i=1;$i<=3;$i++) {
                            ?>
                            <div class="col s12 m6 l4">
                                <div class="card grey lighten-3">
                                    <div class="card-image"><a href="" class="black-text"><img src="/imgs/banner.jpg"/></a></div>
                                    <div class="start-button">
                                        <a class="btn waves-effect waves-light grey-blue darken-3">START</a>
                                    </div>
                                    <div class="card-content">
                                        <a href="" class="black-text"><div class="flow-text"><b>Find your favorite style within a second!!</b></div></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col s12 m6 l4">
                                <div class="card grey lighten-3">
                                    <div class="card-image"><a href="" class="black-text"><img width="650" src="/imgs/banner.jpg"/></a></div>
                                    <div class="start-button">
                                        <a class="btn waves-effect waves-light grey-blue darken-3">START</a>
                                    </div>
                                    <div class="card-content">
                                        <a href="" class="black-text"><div class="flow-text"><b>Get your love match within your friends <3</b></div></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col s12 m6 l4">
                                <div class="card grey lighten-3">
                                    <div class="card-image"><a href="" class="black-text"><img src="/imgs/banner.jpg"/></a></div>
                                    <div class="start-button">
                                        <a class="btn waves-effect waves-light grey-blue darken-3">START</a>
                                    </div>
                                    <div class="card-content">
                                        <a href="" class="black-text"><div class="flow-text"><b>Matching heros with your personality</b></div></a>
                                    </div>
                                </div>
                            </div>
                            <?php
                            } 
                            ?>  
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- FOOTER -->

        <footer class="page-footer blue darken-3">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">TopFBApps</h5>
                        <p class="grey-text text-lighten-4">We're here to deliver top facebook applications where you can entertain yourself and spread hapiness over globe.</p>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    &copy; <?=date("Y")?> TopFBApps.com
                    <a class="grey-text text-lighten-4 right" href="#!">@madbytes</a>
                </div>
            </div>
        </footer>

        <div class="hide-on-med-and-up"></div>
    </div>        
    <!-- SCRIPT AREA -->
    <script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="/js/materialize.min.js"></script>
    <script type="text/javascript" src="/js/pageLoader.js"></script>
    <script type="text/javascript" src="/js/general.js"></script>
    <script>
    $(document).ready(function() {
        $(".button-collapse").sideNav();
        
        $(".login-now").click(function() {
            
        });
        
        $(".start-button").mouseover(function() {
            
        });
        
        if($(".hide-on-med-and-up").is(":visible")) {
            $(".fb-app").addClass("z-depth-0");
        }
    });
    </script>
</body>
</html>
