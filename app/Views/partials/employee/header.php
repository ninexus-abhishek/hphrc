<div class="nk-header nk-header-fixed is-light">
        <div class="container-fluid">
            <div class="nk-header-wrap">
                <div class="nk-menu-trigger d-xl-none ml-n1">
                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                </div>
                <div class="nk-header-brand d-xl-none">
                    <a href="<?php echo EMPLOYEE_DASHBOARD_LINK; ?>" class="logo-link">
                    </a>
                </div>
                <!-- .nk-header-brand -->
                <div class="nk-header-tools">
                    <ul class="nk-quick-nav">
                        <li class="dropdown user-dropdown">
                            <?php $user = session('employee'); ?>
                            <a href="#" class="dropdown-toggle mr-n1" data-toggle="dropdown">
                                <div class="user-toggle">
                                    <div class="user-avatar sm">
                                        <em class="icon ni ni-user-alt"></em>
                                    </div>
                                    <div class="user-info d-none d-xl-block">
                                        <!--<div class="user-status user-status-unverified">Unverified</div>-->
                                        <div class="user-name dropdown-indicator"><?= $user['user_firstname'].' '.$user['user_lastname'] ?></div>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                    <div class="user-card">
                                        <div class="user-avatar">
                                            <span><?= substr($user['user_firstname'], 0, 1) . substr($user['user_lastname'], 0, 1)?></span>
                                        </div>
                                        <div class="user-info">
                                            <span class="lead-text"><?= $user['user_firstname'].' '.$user['user_lastname'] ?></span>
                                            <span class="sub-text"><?= $user['user_email_id'] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-inner">
                                    <ul class="link-list">
                                        <li><a href="<?php echo EMPLOYEE_UPDATE_PROFILE_LINK; ?>"><em class="icon ni ni-user-alt"></em><span>Change Password</span></a></li>
                                        <!--<li><a href="html/user-profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>-->
                                        <!--<li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>-->
                                    </ul>
                                </div>
                                <div class="dropdown-inner">
                                    <ul class="link-list">
                                        <li><a href="<?php echo EMPLOYEE_LOGOUT_LINK; ?>"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!-- .nk-header-wrap -->
        </div><!-- .container-fliud -->
    </div>