<?php
//Current language variable.
$description ="";
if(isset($_GET['lang'])){ 
	if( $_GET['lang'] =='fr'){
		$lang = 'fr';
		$description = $itemInfo['description_french'];
	}else{
		$lang = 'en';
		$description = $itemInfo['description'];
	}
}
?>
<meta property="og:locale:alternate" content="<?php echo $lang; ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?php echo ucfirst($img_alt); ?>">
<meta property="og:description" content="<?php echo $description; ?>">
<meta property="og:url" content="<?php echo $__MAINDOMAIN__.substr($_SERVER['REQUEST_URI'],1); ?>" />
<meta property="og:image" content="<?php echo $__MAINDOMAIN__.'images/images_md/'.$images[0]; ?>" />
<meta name="twitter:card" content="summary">
<meta name="twitter:creator" content="@lexception">
<meta name="twitter:site" content="@lexception">
<meta name="twitter:title" content="<?php echo $itemInfo['product_name']; ?>">
<meta name="twitter:description" content="<?php echo $description; ?>">
<meta name="twitter:image" content="<?php echo $__MAINDOMAIN__.'images/images_md/'.$images[0]; ?>"> <!-- If real product image does not exist, then a dummy image appears on 0-index -->
<link rel="alternate" href="<?php echo $__MAINDOMAIN__.substr($_SERVER['REQUEST_URI'],1); ?>" hreflang="<?php echo $lang; ?>">
