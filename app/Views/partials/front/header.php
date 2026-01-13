<header id="header" class="w-100">
    <div class="container-fluid">
        <div class="row justify-content-center navbar-top">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-inline my-2 text-md-start text-center">
                            <li class="list-inline-item">
                                <a class="text-decoration-none" href="tel:+911772627202"><i class="fa fa-phone"></i> +91 177 262 7202</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="text-decoration-none" href="mailto:info@hpshrc.hp.gov.in"><i class="fa fa-envelope"></i> hphrc-shi(at)hp.gov.in</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="row text-md-end text-center">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <a href="#"> <i class="fa fa-facebook"></i> </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"> <i class="fa fa-twitter"></i> </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"> <i class="fa fa-google"></i> </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"> <i class="fa fa-youtube"></i> </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"> <i class="fa fa fa-pinterest-p"></i> </a>
                                </li>
                            </ul>
                        </div>
                        <div class="row text-md-end text-center">
                            <ul class="list-inline mb-1">
                                <?php if (empty(session(SSO_SESSION))): ?>
                                    <!-- <li class="list-inline-item">
                                        <a class="text-decoration-none" href="<?= env('sso.hp.login_url', '') ?>?service_id=<?= env('sso.hp.service_id', 0) ?>">Login</a>
                                    </li> -->
                                    <li class="list-inline-item">
                                        <a href="javascript::void(0)" class="text-decoration-none" onclick="getIframeSSO('<?= env('sso.hp.service_id') ?>', 'login', 'Citizen')">Login</a>
                                    </li>
                                <?php else: ?>
                                    <li class="list-inline-item">
                                        <a class="text-decoration-none" href="<?= FRONT_LOGOUT_LINK ?>">Logout</a>
                                    </li>
                                    <!-- <li class="list-inline-item">
                                        <a class="text-decoration-none" href="<?= FRONT_UPDATE_PROFILE_LINK ?>">Change Password</a>
                                    </li> -->
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div>

                </div>
            </div>
        </div>
        <div class="row justify-content-center navbar-bottom">
            <div class="col-md-8">
                <nav class="navbar navbar-expand-lg pb-0">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="<?= base_url() ?>">
                            <img src="<?= base_url('assets/images/hpshrc-logo-1.png') ?>" alt="logo">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarToggler">
                            <ul class="navbar-nav navbar-nav-scroll ms-auto text-uppercase">
                                <li class="nav-item">
                                    <a class="nav-link <?= uri_string() === '/' ? 'active' : '' ?>" href="<?= base_url() ?>">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= current_url(true)->getPath() === route_to('about') ? 'active' : '' ?>" href="<?= base_url(route_to('about')) ?>">About</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle <?= current_url(true)->getPath() === route_to('complaint.req') ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown">Complaints</a>
                                    <ul class="dropdown-menu py-0">
                                        <li><a class="dropdown-item" href="<?= base_url(route_to('complaint.req')) ?>">Complaint Online</a></li>
                                        <li><a class="dropdown-item" href="<?= base_url(route_to('complaint.download')) ?>">Download Complaint Form</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle <?= current_url(true)->getPath() === route_to('downloads') ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown">Case Status</a>
                                    <ul class="dropdown-menu py-0">
                                        <li><a class="dropdown-item" href="<?= base_url(route_to('downloads')) ?>">Downloads</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle <?= (current_url(true)->getPath() === route_to('case.request') || current_url(true)->getPath() === route_to('case.list')) ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown">Case</a>
                                    <ul class="dropdown-menu py-0">
                                        <li><a class="dropdown-item" href="<?= route_to('case.request') ?>">Requests</a></li>
                                        <li><a class="dropdown-item" href="<?= route_to('case.list') ?>">My Cases</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= current_url(true)->getPath() === route_to('front.budget', ((date("Y")) - 1) . '-' . (date("Y"))) ? 'active' : '' ?>" href="<?= base_url(route_to('front.budget', ((date("Y")) - 1) . '-' . (date("Y")))) ?>">Budget &amp; Finance</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= current_url(true)->getPath() === route_to('gallery') ? 'active' : '' ?>" href="<?= base_url(route_to('gallery')) ?>">Gallery</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= current_url(true)->getPath() === route_to('former') ? 'active' : '' ?>" href="<?= base_url(route_to('former')) ?>">Former Members</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= current_url(true)->getPath() === route_to('contact') ? 'active' : '' ?>" href="<?= base_url(route_to('contact')) ?>">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>