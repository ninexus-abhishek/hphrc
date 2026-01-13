<div class="top_nav">
    <div class="nav_menu">
        <nav>
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <div class="nav navbar-nav navbar-right">
            <li class="open">
                <a href="#"  class="user-profile" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?= base_url ('assets/images/default.png')?> " alt=""><?php echo $_SESSION['admin']['user_firstname']; ?>
                <span class=" fa fa-angle-down"></span>
            </a>
            <ul class="dropdown-menu dropdown-usermenu pull-right">
                <li><a href="<?= base_url(route_to('admin.update')) ?>" class="dropdown-item">Profile</a></li>                                         
                <li><a href="<?= base_url(route_to('admin.logout'))?>" class="dropdown-item"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
            </ul>
            </li>
        </ul>
        </nav>
    </div>
  </div>