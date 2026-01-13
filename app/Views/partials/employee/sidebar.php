<div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="<?= base_url(route_to('emp.dashboard')) ?>" class="logo-link nk-sidebar-logo">
                <h5>EMPLOYEE PANEL</h5>
            </a>
        </div>
        <div class="nk-menu-trigger mr-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
    </div>
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Employee Panel</h6>
                    </li>

                    <li class="nk-menu-item">
                        <a href="<?= base_url(route_to('emp.dashboard')) ?>" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span>
                            <span class="nk-menu-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nk-menu-item">
                        <a href="<?= base_url(route_to('emp.case.list')) ?>" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-book-read"></em></span>
                            <span class="nk-menu-text">Cases</span>
                        </a>
                    </li>

                    <!-- <li class="nk-menu-item has-sub active current-page">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-book-read"></em></span>
                            <span class="nk-menu-text">Cases</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="<?php echo EMPLOYEE_CASES_LIST_LINK; ?>" class="nk-menu-link"><span class="nk-menu-text">Cases List</span></a>
                                <a href="<?php echo EMPLOYEE_ADD_CASES_LINK; ?>" class="nk-menu-link"><span class="nk-menu-text">Add Cases</span></a>
                            </li>
                        </ul>
                    </li> -->

                    <!-- <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                            <span class="nk-menu-text">Complainant</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="<?php echo EMPLOYEE_CUSTOMER_LIST_LINK; ?>" class="nk-menu-link"><span class="nk-menu-text">Complainant List</span></a>
                                <a href="<?php echo EMPLOYEE_CUSTOMER_REGISTER_LINK; ?>" class="nk-menu-link"><span class="nk-menu-text">Add Complainant</span></a>
                            </li>
                        </ul>
                    </li> -->
                </ul>
            </div>
        </div>
    </div>
</div>