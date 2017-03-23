<?php
if ( session_status() == PHP_SESSION_NONE ) {
    session_start();
}
?><!doctype html>
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="canonical" href="/" />
  <meta name="description" content="" />
  <title>Diamond Search</title>
  
    <link href="./assets/stylesheets/font.css" rel='stylesheet' type='text/css'>
  
    <link href="./assets/stylesheets/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">    
    <link href="./assets/stylesheets/bootstrap.min.3x.css" rel="stylesheet" type="text/css" media="all">
    <link href="./assets/stylesheets/cs.bootstrap.3x.css" rel="stylesheet" type="text/css" media="all">
    <link href="./assets/stylesheets/cs.animate.css" rel="stylesheet" type="text/css" media="all">
    <link href="./assets/stylesheets/cs.global.css" rel="stylesheet" type="text/css" media="all">
    <link href="./assets/stylesheets/cs.style.css" rel="stylesheet" type="text/css" media="all">
    <link href="./assets/stylesheets/cs.media.3x.css" rel="stylesheet" type="text/css" media="all">
    <link href="./assets/stylesheets/site.css" rel="stylesheet" type="text/css" media="all">
    <link rel="icon" href="./images/gfx/favicon.png?v=1" type="image/png" sizes="16x16">
    
    <script src="./assets/javascripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="./assets/javascripts/bootstrap.min.3x.js" type="text/javascript"></script>
</head>
<?php
include 'conf/config.php';

?>
<body itemscope="" itemtype="http://schema.org/WebPage" class="templatePage notouch" onload="document.getElementById('myForm').submit(); ">
  
    <?php include'./url/header.php'; ?>
  
    <div id="content-wrapper-parent">
        <div id="content-wrapper">   
            <!-- Content -->
            <div id="content" class="clearfix">                
                <div id="breadcrumb" class="breadcrumb">
                    <div itemprop="breadcrumb" class="container">
                        <div class="row">
                            <div class="col-md-24">
                                <a href="index.php" class="homepage-link" title="Back to the frontpage">Home</a>
                                <span>/</span>
                                <span class="page-title">Diamond Search</span>
                            </div>
                        </div>
                    </div>
                </div>               
                <section class="content">    
                    <form target="arhaan_iframe" action="http://localhost/git/arhaandiam_complete/coding/labgrown-diamonds" method="post" id="myForm">
                    <input type="hidden" name="api_key" value="77c8d140-05b7-11e7-8867-a725f2ce6e82" />
                    <input type="hidden" name="your_client_unique_identity" value="3" />
                    <input type="hidden" name="style" value="gold" />
                    </form>

                    <iframe name="arhaan_iframe" width="100%" height="700" src="" frameborder="0" scrolling="no" onload="this.style.height=this.contentDocument.body.scrollHeight +'px';"></iframe>
                </section>        
            </div>
        </div>
    </div>

    <?php include './url/footer.php'; ?>
</body>