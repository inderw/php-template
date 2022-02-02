<nav class="pcoded-navbar menu-light ">
        <div class="navbar-wrapper  ">
            <div class="navbar-content scroll-div ">

                <div class="">
                    <div class="main-menu-header">
                        <img class="img-radius" src="assets/images/user/avatar-2.jpg" alt="User-Profile-Image">
                        <div class="user-details">
                            <div id="more-details">Admin <i class="fa fa-caret-down"></i></div>
                        </div>
                    </div>
                    <div class="collapse" id="nav-user-link">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="user-profile.php" data-toggle="tooltip" title="View Profile"><i class="feather icon-user"></i></a></li>
                            <li class="list-inline-item"><a href="email_inbox.php"><i class="feather icon-mail" data-toggle="tooltip" title="Messages"></i><small class="badge badge-pill badge-primary">5</small></a></li>
                            <li class="list-inline-item"><a href="logout.php" data-toggle="tooltip" title="Logout" onclick=" return window.confirm('Sure To Log Out');" class="text-danger"><i class="feather icon-power"></i></a></li>
                        </ul>
                    </div>
                </div>

                <ul class="nav pcoded-inner-navbar ">
                    <li class="nav-item pcoded-menu-caption">
                        <label>Navigation</label>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="home.php">My Dashboard</a></li>
                            <li><a href="../index.php">View Website</a></li>
 
                        </ul>
                    </li>
                   
                    
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="fas fa-images"></i></span><span class="pcoded-mtext">Products</span></span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="add_prd.php">Add Products</a></li>
                            <li><a href="mng_prd.php">Manage Products</a></li>
                            
                        </ul>
                    </li>
                   
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-cogs"></i></span><span class="pcoded-mtext">Admin Settings</a>
                        <ul class="pcoded-submenu">
                            <li><a href="a_settings.php">Change Password</a></li>
      
                        </ul>
                    </li>
                 
                    
                </ul>


            </div>
        </div>
    </nav>
    