<div class="left_col scroll-view">
  <div class="navbar nav_title" style="border: 0;">
    <a href="../../index.php" class="site_title"><img src="../../assets/images/logo.png"></a>
  </div>

  <div class="clearfix"></div>

  <!-- menu profile quick info -->
  <div class="profile">
    <div class="profile_info">
      <span>Welcome,</span>
      <h2><?php echo $_SESSION['username']; ?></h2>
    </div>
  </div>
  <!-- /menu profile quick info -->

  <br />

  <!-- sidebar menu -->
  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <h3>General</h3>
      <ul class="nav side-menu">
        <li><a><i class="fa fa-home"></i> Items <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="all_items.php">All</a></li>
            <li><a href="rings.php">Rings</a></li>
            <li><a href="earrings.php">Earrings</a></li>
            <li><a href="pendants.php">Pendants</a></li>
            <li><a href="necklaces.php">Necklaces</a></li>
            <li><a href="bracelets.php">Bracelets</a></li>
          </ul>
        </li>
        <li><a><i class="fa fa-cogs"></i> Management <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="all_users.php">Users</a></li>
            <li><a href="newsletter.php">Newsletter</a></li>
          </ul>
        </li>
        <li><a><i class="fa fa-table"></i> Excel <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="import_excel.php">Import via Excel</a></li>
            <li><a href="export_excel.php">Export to Excel</a></li>
            <li><a href="excel_download.php">Excel Sheets</a></li>
            <li><a href="../excel_files/format.xlsx"><i class="fa fa-download"></i>Download Format</a></li>
          </ul>
        </li>
      </ul>
    </div>

  </div>
  <!-- /sidebar menu -->

  <!-- /menu footer buttons -->
  <div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Settings">
      <span class="fa fa-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
      <span class="fa fa-arrows-alt" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
      <span class="fa fa-lock" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout">
      <span class="fa fa-power-off" aria-hidden="true"></span>
    </a>
  </div>
  <!-- /menu footer buttons -->
</div>