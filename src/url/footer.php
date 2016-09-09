<?php
if ( session_status() == PHP_SESSION_NONE ) {
  session_start();
}
?>
  <footer id="footer">      
    <div id="footer-content">
      <h6 class="general-title contact-footer-title">Newsletter</h6>  
      <div id="widget-newsletter">
        <div class="container">            
          <div class="newsletter col-md-24">
          <form method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank">
            <span class="news-desc">We promise only send the good things</span>
            <div class="group_input">
            <input class="form-control" type="email" placeholder="Your Email Address" name="email" id="email-input">
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
            <h5 class="general-title">About Us</h5>           
            <ul class="list-unstyled list-styled">              
              <li class="list-unstyled">
              <a href="./contact.php">Store Location</a>
              </li>           
              <li class="list-unstyled">
              <a href="./contact.php">Contact Us</a>
              </li>             
            </ul>
            </div>
          </div>   
          <div class="footer-link-list col-md-6 col-md-offset-2">
            <div class="group">
            <h5 class="general-title">Collections</h5>            
            <ul class="list-unstyled list-styled">              
              <li class="list-unstyled">
              <a href="./collection_rings.php">Rings</a>
              </li>             
              <li class="list-unstyled">
              <a href="./collection_earrings.php">Earrings</a>
              </li>             
              <li class="list-unstyled">
              <a href="./collection_pendants.php">Pendants</a>
              </li>             
              <li class="list-unstyled">
              <a href="./collection_necklaces.php">Necklaces</a>
              </li>            
              <li class="list-unstyled">
              <a href="./collection_bracelets.php">Bracelets</a>
              </li>             
            </ul>
            </div>
          </div>
          <div class="footer-link-list col-md-6 col-md-offset-2">
            <div class="group">
            <h5 class="general-title">Account</h5>            
            <ul class="list-unstyled list-styled">              
              <li class="list-unstyled">
              <a href="./account.php">Preferences</a>
              </li>             
              <li class="list-unstyled">
              <a href="./cart.php">My Cart</a>
              </li>             
              <li class="list-unstyled">
              <a href="./account.php">Favorites</a>
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
            © 2016 <a href="./about-us.html">Diamant Secret</a>. All Rights Reserved.
          </div>
          <div id="widget-payment" class="col-md-12" style="text-align:right">
            <img src="./assets/images/logo.png" />
          </div>
        </div>
      </div>
    </div>   
  </footer>
  <script>

  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
  });


  </script>