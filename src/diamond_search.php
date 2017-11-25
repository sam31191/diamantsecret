<?php
if ( session_status() == PHP_SESSION_NONE ) {
    session_start();
}
include 'conf/config.php';
?><!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="/" />
  <meta name="description" content="" />
  <title><?php echo __("Diamond Search"); ?></title>
  
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/font.css" rel='stylesheet' type='text/css'>
  
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">    
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/bootstrap.min.3x.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.bootstrap.3x.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.animate.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.global.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.style.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/cs.media.3x.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo $__MAINDOMAIN__;?>assets/stylesheets/site.css" rel="stylesheet" type="text/css" media="all">
    <link rel="icon" href="<?php echo $__MAINDOMAIN__;?>images/gfx/favicon.png?v=1" type="image/png" sizes="16x16">
    
    <script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="<?php echo $__MAINDOMAIN__;?>assets/javascripts/bootstrap.min.3x.js" type="text/javascript"></script>
    <script type="text/javascript">
    	function resizeFrame(elem) {
    		setInterval(function() {
	    		elem.style.height=elem.contentDocument.body.scrollHeight +'px';
    		}, 1000);
    	}	
    </script>
</head>
<?php
/*include 'conf/config.php';*/

?>
<body itemscope="" itemtype="http://schema.org/WebPage" class="templatePage notouch" >
<?php
    $link = '';
    if(isset($_GET['lang'])){
        if($_GET['lang']=='fr'){
            $link = 'diamond-search';
        }else{
            $link = 'recherche-de-diamants';
        }
    }
?>
    <input type="hidden" name="changeURL" id="changeURL" value="<?php echo $link; ?>">
    
    <?php include'./url/header.php'; ?>
  
    <div id="content-wrapper-parent">
        <div id="content-wrapper">   
            <!-- Content -->
            <div id="content" class="clearfix">                
                <div id="breadcrumb" class="breadcrumb">
                    <div itemprop="breadcrumb" class="container">
                        <div class="row">
                            <div class="col-md-24">
                                <a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'; ?>" class="homepage-link" title="<?php echo __("Back to the frontpage"); ?>"><?php echo ucfirst(__("home")); ?></a>
                                <span>/</span>
                                <span class="page-title"><?php echo __("Diamond Search"); ?></span>
                            </div>
                        </div>
                    </div>
                </div>               
                <section class="content">    
                    <form target="dsframe" action="<?php echo DIAMOND_SEARCH_URL; ?>" method="post" id="myForm">
                    <input type="hidden" name="api_key" value="<?php echo DIAMOND_SEARCH_API; ?>" />

                    <?php 
                    if ( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] ) {
                    ?>
                    <input type="hidden" name="unique_identifier" value="<?php echo $_SESSION['username']; ?>" />
                    <input type="hidden" name="custom_argument1" value="arhaangroup" />
                    <input type="hidden" name="custom_argument2" value="login_value:_none_" />
                    <input type="hidden" name="custom_argument3" value="login_msg:Please login to access diamond cart" />
                    <input type="hidden" name="custom_argument4" value="" />
                    <?php
                    } else {
                    ?>
                    <input type="hidden" name="unique_identifier" value="_none_" />
                    <input type="hidden" name="custom_argument1" value="arhaangroup" />
                    <input type="hidden" name="custom_argument2" value="login_value:_none_" />
                    <input type="hidden" name="custom_argument3" value="login_msg:Please login to access diamond cart" />
                    <input type="hidden" name="custom_argument4" value="" />
                    <?php 
                    }
                    ?>
                    <input type="hidden" name="style" value="<?php echo DIAMOND_SEARCH_THEME; ?>" />
                    </form>

                    <iframe name="dsframe" id="dsframe" width="100%" height="1500" src="<?php echo $__MAINDOMAIN__.$lang.'/'?>dssearch" frameborder="0" scrolling="no" onload="resizeFrame(this)"></iframe>
                </section>        
            </div>
        </div>
    </div>

    <?php include './url/footer.php'; ?>
</body>