<!DOCTYPE html>
<html>
<head>
	<?php require_once "./theme/head.php"; ?>
    <title><?=$TITLE?></title>
</head>
<body>	
    
    <!-- NAVIGATION --> <?php require_once "./theme/nav.php"; ?>

    
    <div class="content-area">
        
        <!-- PAGE LOADER --> <?php require_once "./theme/page-loader.php"; ?>
    
        <!-- HEADER IMAGE --> <?php require_once "./theme/header-image.php"; ?>

        <!-- CONTENT AREA -->
        <main class="page container white z-depth-3">
            <div class="mobile-page hide-on-med-and-up"></div>
            <!-- CONTENT PAGE --> <?php require_once "page.".$PAGE.".php"; ?>
        </main>

        <!-- FOOTER --> <?php require_once "./theme/footer.php"; ?>
        
        <div class="hide-on-med-and-up"></div>
        
    </div>        
    
    <!-- SCRIPT AREA --> <?php require_once "./theme/jquery.php"; ?>
</body>
</html>
