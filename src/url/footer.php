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
            © 2016 <a href="<?php echo $__MAINDOMAIN__.$lang.'/'?>contact">Diamant Secret</a>. <?php echo __("All Rights Reserved"); ?>.
          </div>
          <div id="widget-payment" class="col-md-12" style="text-align:right">
            <img src="<?php echo $__MAINDOMAIN__;?>images/gfx/logo.png" style="width:200px" />
          </div>
        </div>
      </div>
    </div>   
  </footer>

  <script>

  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
  });

  $("#mc-embedded-subscribe-form").submit(function(event){
    event.preventDefault();
    email = $("#email-input").val();
    $.ajax({
      url: '<?php echo $__MAINDOMAIN__;?>url/ajax.php?subscribe='+email,
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