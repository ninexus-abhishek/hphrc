<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>
    <?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<style>
    .btn_disabled{
        pointer-events: none;
        background-color: #c3bdbd;
        opacity: 15.9;
    }
</style>
<div class="page-heading text-center">
    <div class="container zoomIn animated">
        <h1 class="page-title">LOGIN<span class="title-under"></span></h1>
        <p class="page-description">
            Himachal Pradesh Human Rights Commission , Minister House No. 3, Grant Lodge, Shimla-171002, HP.
        </p>
    </div>
</div>
<div class="main-container fadeIn animated">
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-8 col-sm-12 col-form"> 
                <!--<h2 class="title-style-2">Registration FORM <span class="title-under"></span></h2>-->
                <?php if(! is_null(session()->getFlashdata('error'))): ?>
                    <div class="alert alert-danger alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?= esc(session()->getFlashdata("error")) ?>
                    </div>
                <?php endif; ?>
                <?= form_open(FRONT_LOGIN_LINK, ['class' => 'contact-form', 'id' => 'userlogin', 'name' => 'loginuser']) ?>
                    <div class="mb-3">
                        <div class="row"> 
                            <div class="col-sm-4 col-xs-12">
                                <label class="form-label fw-bold" for="customer_email_password">Email/Username</label>
                            </div>
                            <div class="col-sm-8 col-xs-12">
                                <input type="text" class="form-control <?= $validation->hasError('username') ? 'is-invalid' : '' ?>" name="username" id="username" placeholder="Enter your email address or username" autocomplete="off" value="<?= old('username') ?>">
                                <div class="invalid-feedback">
                                    <?= esc($validation->getError('username')) ?>
                                </div>
                            </div>
                        </div>
                    </div>          
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <label class="form-label fw-bold" for="password">Password</label>
                            </div>
                            <div class="col-sm-8 col-xs-12">
                                <input type="password" class="form-control <?= $validation->hasError('password') ? 'is-invalid' : '' ?>" name="password" id="password" placeholder="Enter your password" autocomplete="off">
                                <div class="invalid-feedback">
                                    <?= esc($validation->getError('password')) ?>
                                </div>
                            </div>
                        </div>
                    </div>                                                
                    <div class="mb-3">                    
                        <div class="row">                        
                            <script nonce="<?= SCRIPT_NONCE ?>" type="text/javascript" src="https://www.google.com/recaptcha/api.js" async defer></script>
                            <script nonce="<?= SCRIPT_NONCE ?>" type="text/javascript">
                                function enableRegister() {
                                    $("#btnRegister").removeClass('btn_disabled');
                                    document.getElementById("btnRegister").disabled = false;
                                }
                            </script>
                            <label class="control-label col-sm-4 col-xs-12" for="ptsp"></label>
                            <div class="col-sm-8 col-xs-12">
                                <div class="g-recaptcha" data-sitekey="<?= env('RE_CAPTCHA_SITE_KEY', '') ?>" data-callback="enableRegister"></div>
                            </div>
                        </div>
                    </div>                                                              
                    <div class="mb-3">
                        <div class="m-auto text-center">    
                            <button type="submit" class="btn btn-secondary" disabled="true" id="btnRegister">Login</button>
                            <a href="<?= FORGET_PASSWORD_LINK.'customer'; ?>" class="btn btn-outline-secondary">Foreget Password</a>
                        </div>
                    </div>
                <?= form_close() ?>
            </div>
        </div>     
    </div>
</div>
<?= $this->endSection() ?>