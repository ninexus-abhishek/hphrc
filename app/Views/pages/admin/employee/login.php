<?= $this->extend('layouts/employee') ?>

<?= $this->section('title') ?>
    <?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="nk-wrap nk-wrap-nosidebar">
    <div class="nk-content">
        <div class="nk-block nk-block-middle nk-auth-body wide-xs">
            <!-- <div class="brand-logo pb-4 text-center">
                <a href="<?php //echo BASE_URL; ?>" class="logo-link">
                    <img class="logo-light logo-img logo-img-lg" src="<?php //echo EMPLOYEE_ASSETS_FOLDER; ?>images/logo.png" srcset="<?php //echo EMPLOYEE_ASSETS_FOLDER; ?>images/logo2x.png 2x" alt="logo">
                    <img class="logo-dark logo-img logo-img-lg" src="<?php //echo EMPLOYEE_ASSETS_FOLDER; ?>images/logo-dark.png" srcset="<?php //echo EMPLOYEE_ASSETS_FOLDER; ?>images/logo-dark2x.png 2x" alt="logo-dark">
                </a>
            </div>-->
            <div class="card">
                <div class="card-inner card-inner-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Sign-In</h4>
                            <div class="nk-block-des">
                                <p>Enter username and password for access</p>
                            </div>
                        </div>
                    </div>

                    <?= form_open(route_to('emp.login'), [ 'class' => (! empty($validation->getErrors())) ? 'is-alter' : '' ]) ?>
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="default-01">Email or Username</label>
                            </div>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg <?= $validation->hasError('username') ? 'invalid' : '' ?>" name="username" id="default-01" placeholder="Enter your email address or username" autocomplete="off" value="<?= old('username') ?>">
                                <span class="invalid"><?= esc($validation->getError('username')) ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="password">Password</label>                                                
                                <a class="link link-primary link-sm" href="<?= base_url(route_to('forgotPass', 'employee')) ?>">Forgot Code?</a>
                            </div>
                            <div class="form-control-wrap">
                                <a href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                </a>
                                <input type="password" name="password" class="form-control form-control-lg <?= $validation->hasError('password') ? 'invalid' : '' ?>" id="password" placeholder="Enter your password" autocomplete="off" autocomplete="off">
                                <span class="invalid"><?= esc($validation->getError('password')) ?></span>
                            </div>
                        </div>
                            
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <?= echoCaptcha() ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-lg btn-primary btn-block" disabled  id="btnSubmit" >Sign in</button>
                        </div>
                    <?= form_close() ?>        
                </div>
            </div>
        </div>
        <div class="nk-footer nk-auth-footer-full">
            <div class="container wide-lg">
                <div class="row g-3">
                    <div class="col-lg-12">
                        <div class="nk-block-content text-center text-lg-center">
                            <p class="text-soft">&copy; <?= date("Y"); ?> HPSHRC All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>