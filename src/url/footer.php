<footer id="footer">      
	<div id="footer-content">
		<h6 class="general-title contact-footer-title"><?php echo __("Newsletter"); ?></h6>  
		<div id="widget-newsletter">
			<div class="container">            
				<div class="newsletter col-md-24">
				<form method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank">
					<span class="news-desc"><?php echo __("We promise only send the good things"); ?></span><img id="subscribe-loading-img" src="<?php echo $__MAINDOMAIN__;?>images/gfx/cube.gif" style="margin: 0px 10px; width: 20px; display:none;" />
					<div class="group_input">
					<input class="form-control" type="email" placeholder="<?php echo __("Your Email Address"); ?>" name="email" id="email-input" required="true">
					<div class="unpadding-top"><button class="btn btn-1" type="submit" name="subscribe"><i class="fa fa-paper-plane"></i></button></div>
					</div>              
				</form>
				</div>            
			</div>
		</div>
		
		<div class="footer-content footer-content-top clearfix">
			<div class="container">
				<div class="footer-link-list col-md-6 col-md-offset-2">
					<div class="group">
					<h5 class="general-title"><?php echo __("About Us"); ?></h5>           
					<ul class="list-unstyled list-styled">              
						<li class="list-unstyled">
						</li>           
						<li class="list-unstyled">
						<a href="<?php echo $__MAINDOMAIN__.''.$lang.'/'?>contact"><?php echo __("Contact Us"); ?></a>
						</li>             
					</ul>
					</div>
				</div>   
				<div class="footer-link-list col-md-6 col-md-offset-2">
					<div class="group">
					<h5 class="general-title"><?php echo __("Collections"); ?></h5>            
					<ul class="list-unstyled list-styled">              
						<li class="list-unstyled">
						<a href="<?php echo $__MAINDOMAIN__.$lang.'/'.processUrlParameter(__('Rings'))?>"><?php echo __("Rings"); ?></a>
						</li>             
						<li class="list-unstyled">
						<a href="<?php echo $__MAINDOMAIN__.$lang.'/'.processUrlParameter(__('Earrings'))?>"><?php echo __("Earrings"); ?></a>
						</li>             
						<li class="list-unstyled">
						<a href="<?php echo $__MAINDOMAIN__.$lang.'/'.processUrlParameter(__('Pendants'))?>"><?php echo __("Pendants"); ?></a>
						</li>             
						<li class="list-unstyled">
						<a href="<?php echo $__MAINDOMAIN__.$lang.'/'.processUrlParameter(__('Necklaces'))?>"><?php echo __("Necklaces"); ?></a>
						</li>            
						<li class="list-unstyled">
						<a href="<?php echo $__MAINDOMAIN__.$lang.'/'.processUrlParameter(__('Bracelets'))?>"><?php echo __("Bracelets"); ?></a>
						</li>             
					</ul>
					</div>
				</div>
				<div class="footer-link-list col-md-6 col-md-offset-2">
					<div class="group">
					<h5 class="general-title"><?php echo __("Account"); ?></h5>            
					<ul class="list-unstyled list-styled">              
						<li class="list-unstyled">
						<a href="<?php echo $__MAINDOMAIN__.$lang.'/'?>login"><?php echo __("Preferences"); ?></a>
						</li>             
						<li class="list-unstyled">
						<a href="<?php echo $__MAINDOMAIN__.$lang.'/'?>cart"><?php echo __("My Cart"); ?></a>
						</li>             
						<li class="list-unstyled">
						<a href="<?php echo $__MAINDOMAIN__.$lang.'/'?>account"><?php echo __("Favorites"); ?></a>
						</li>             
					</ul>
					</div>
				</div>
				</div>   
			</div>
		</div>
		<div class="footer-content footer-content-bottom clearfix">
			<div class="container">
				<div class="copyright col-md-12">
					© <?php echo date("Y") ?> <a href="<?php echo $__MAINDOMAIN__.$lang.'/'?>contact">Diamant Secret</a>. <?php echo __("All Rights Reserved"); ?>.
				</div>
				<div id="widget-payment" class="col-md-12" style="text-align:right">
					<img src="<?php echo $__MAINDOMAIN__;?>images/gfx/logo.png" style="width:200px" />
				</div>
			</div>
		</div>
	</div>   
</footer>
	
<script type="text/javascript">

	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip(); 
	});

	$("#mc-embedded-subscribe-form").submit(function(event){
		event.preventDefault();
		email = $("#email-input").val();
		$.ajax({
			url: '<?php echo $__MAINDOMAIN__;?>url/ajax.php?subscribe='+email+"&lang=<?php  echo $_GET['lang']?>",
			type: 'GET',
			beforeSend: function(){
				$("#subscribe-loading-img").show();
			},
			success: function(result) {
				console.log(result);
				$("#modal-text").text(result);
				$("#notificationBox").html("<span>"+ result +"&nbsp;</span>");
				if ( $("#notificationBox").is(":hidden") ) {
					$("#notificationBox").toggle(500).delay(10000).toggle(500);  
				}
				$("#subscribe-loading-img").hide();
			}
		});

	});

	function getImgTag(id){
		var setNewAlt = $('#'+id+'-getAltTag').attr('alt');
		document.getElementById('newAlt').setAttribute('alt',setNewAlt);

	}



	function quickShop(id) {
	if (id == "") {
		document.getElementById("quick-shop-modal").innerHTML = "";
		return;
	} else { 
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var result = JSON.parse(xmlhttp.responseText);
				console.log(result);
				images = result['images'].split(",");
				//$("#quick-shop-modal").html(xmlhttp.responseText);
				//console.log(xmlhttp.responseText);
				//Item Image
				if ( result['images'] == "" || result['is_img']==0) {
					images[0] = "0.png";
				}   
				$("#quick-shop-image .main-image img").attr("src", "<?php echo $__MAINDOMAIN__;?>images/images_md/" + images[0] + '?v=' + Date.now());
				
				//Remove old Thumbs if any
				var currentThumbs = $(".image-thumb").length;
				for (var i = 0; i < currentThumbs; i++ ) {
					//console.log("1 Item Removed");
					$('#gallery_main_qs').owlCarousel().data('owlCarousel').removeItem();
				}
				
				//Item Thumbnals
				var newThumbAlt = $("#newAlt").attr("alt");
				var serialNo = 0;
				for ( var i = 0; i < images.length-1; i++ ) {
					serialNo++;	
					content = '<a class="image-thumb" onClick="quickDisplay(this)" value="<?php echo $__MAINDOMAIN__;?>images/images_md/'+ images[i] +'?v='+ Date.now() +'" ><img id="'+serialNo+'-newThumbAlt" src="<?php echo $__MAINDOMAIN__;?>images/images_sm/'+ images[i] +'?v='+ Date.now() +'"  alt=""/></a>';
					//console.log("1 Item Added");
					$('#gallery_main_qs').owlCarousel().data('owlCarousel').addItem(content);
					$('.owl-item').toggleClass('show-item');
					$("#"+serialNo+"-newThumbAlt").attr("alt",newThumbAlt+" "+serialNo);
				}

				//Item Name
				$("#quick-shop-title a").text(result['item_name']);

				//Product url in pop-up
				var removeOldProUrl = $("#"+id+"-remOldUrl").attr("href");
				$("#quick-shop-title a").attr("href", removeOldProUrl);				
				
				//Desc
				$("#quick-shop-description").html(result['description']);
				
				//Price
				if ( result['discount'] > 0 ) {
					discount = result['item_value'] - ( (result['discount'] / 100 ) * result['item_value']);
					price = '<span class="price_sale">€'+ discount.toFixed(2) +'</span><span class="dash">/</span><del class="price_compare">€'+ result['item_value'] +'</del>';
				} else {
					price = '<span class="price">€'+ result['item_value'] +'</span><span class="dash">';
				}
				$("#quick-shop-price-container").html(price);

				//Quantity 
				$("#qs-quantity").attr("max", result['pieces_in_stock']);
				
				//Material
				$("#material-carat").text(result['total_carat_weight'] + " ct.");
				$("#quick-shop-material a").each(function(index, element) {
					//alert ($(element).attr("name"));
					if ( $(element).attr("name") !== result['material'] ) {
						$(element).attr("disabled", true);
					} else {
						$(element).attr("disabled", false);
					}
				});
				//Size
				if ( result['category'] == 1 ) {
					sizehtml = "";
					sizes = result['ring_size'].split(",");
					for ( var i = 0; i < sizes.length; i++ ) {
						
							if ( sizes[i].indexOf('-') > -1 ) {
								sizesRange = sizes[i].split('-');
								for ( var j = sizesRange[0]; j <= sizesRange[1]; j++ ) {
									sizehtml += '<a class="btn size-badge" name="'+ j +'" onClick="selectSize(this)">'+ j +'</a>';
								}
							} else {
								sizehtml += '<a class="btn size-badge" name="'+ sizes[i] +'" onClick="selectSize(this)">'+ sizes[i] +'</a>';
							}
					}
					//console.log(sizehtml);
					$("#quick-shop-size-container").html(sizehtml);
					$("#quick-shop-size").show();
				} else {
					$("#quick-shop-size").hide();
				}

				if ( result['pieces_in_stock'] <= 0 ) {
					$("#buttonDiv").html('<button class="btn" name="addToCart" style="position: fixed; bottom: 15px; right: 15px; width: 200px;" disabled><?php echo __("Out of Stock"); ?></button>');
				} else {
					$("#buttonDiv").html('<button class="btn" type="submit" name="addToCart" style="position: fixed; bottom: 15px; right: 15px; width: 200px;"><?php echo __("Add to Cart"); ?></button>');
				}

				$("#quick-shop-unique-key").val(result['unique_key']);
				$("#quick-shop-modal").modal("toggle");
			}
		};

		xmlhttp.addEventListener( "progress" ,function(e) {
			if ( e.lengthComputable ) {
				setTimeout(3000);
				console.log(e.loaded);
			}
		}, false);

		xmlhttp.open("GET","<?php echo $__MAINDOMAIN__;?>url/fetch_item_info.php?id="+id, false);
		xmlhttp.send();

	}
}



	// Generated by Satwinder Sir.
 	function urlclick(currentLang,changeLang){ 
 		var current_url = document.URL;
 		<?php if(basename($_SERVER['PHP_SELF']) == 'product.php'){?>
    		/*	only for product detail page url change */			
			var p_id = $("#product_id").val();
			var subcat = $("#urlSubcategory").val();
			var carat = $("#total_carat_weight").val();
			var quality = $("#gold_quality").val();
			var material = $("#material").val();
			var p_name = $("#product_name").val();
			
			$.ajax({
				    type : "GET",
				    url : "<?php echo $__MAINDOMAIN__ ?>ajax_change_lang.php?lang="+changeLang+"&p_id="+p_id+"&subcat="+subcat+"&carat="+carat+"&quality="+quality+"&material="+material+"&p_name="+p_name,
				    success: function(data){
				    		//alert(data);
				    		window.location.href = data;

				        }
				});
		<?php } else { ?>
			/*all other product listing page language and url change*/

			var phpLang = '';
			<?php if(isset($_GET['lang']) && trim($_GET['lang'])!='') {?>
				phpLang = '<?php echo $_GET['lang']; ?>';
			<?php } ?>
			var productUrl = '';
			if($("#changeURL").length > 0){
				productUrl = $("#changeURL").val();
			}	

			if(productUrl!='' && phpLang!=changeLang){
				
				window.location.href = "<?php echo $__MAINDOMAIN__;?>"+changeLang+"/"+productUrl;
			}else{
				current_url = current_url.replace("/"+currentLang+"/", "/"+changeLang+"/");
				window.location.href = current_url;
			}

		<?php } ?>
		
	}

</script>



<span class="container" style="
		position: fixed;
		/* top: 0px; */
		/* right: 0; */
		/* margin: 25px; */
		/* min-width: 250px; */
		/* min-height: 40px; */
		text-align: center;
		display: none;
		font-size: 18px;
		background: rgba(3, 169, 244, 0.5);
		margin: 20px 15%;
		width: 70%;
		top: 0px;
		z-index: 2000;
		padding: 25px;
		font-variant: small-caps;z-index: 10000;" id="notificationBox">...</span>