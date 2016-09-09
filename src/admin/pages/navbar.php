<div class="nav_menu">
  <nav>
    <div class="nav toggle">
      <a id="menu_toggle"><i class="fa fa-bars" style="color:#607d8b;"></i></a>
    </div>

    <ul class="nav navbar-nav navbar-right">
      <li class="">
        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <span class="fa fa-user" style="color: #607d8b; font-size: 20px; padding: 4px 10px;"></span><?php echo $_SESSION['username']; ?>
          <span class=" fa fa-angle-down" style="color:#607d8b;"></span>
        </a>
        <ul class="dropdown-menu dropdown-usermenu pull-right">
          <li><a href="../../index.php"> Home</a></li>
          <li><a href="../../account.php"> Account</a></li>
          <li><form method="post" action="../../index.php" id="logoutForm"><input name="action[logout]" hidden/></form><a onclick="document.getElementById('logoutForm').submit();"><i class="fa fa-sign-out pull-right" style="color:#607d8b;"></i> Log Out</a></li>
        </ul>
      </li>
    </ul>
  </nav>
</div>