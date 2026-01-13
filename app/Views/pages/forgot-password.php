<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>
    <?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .btn_disabled{
        pointer-events: none;
        background-color: #c3bdbd;
        opacity: 15.9;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
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
            <!-- content -->
            <div class="col-md-8 col-sm-12 col-form"> 
                <!--<h2 class="title-style-2">Registration FORM <span class="title-under"></span></h2>-->
                <?= form_open(route_to('forgotPass', $user_type), ['class' => 'contact-form']) ?>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <label class="form-label fw-bold" for="userName">Email</label>
                        </div>

                        <div class="col-sm-8 col-xs-12">
                            <input type="email" name="username" class="form-control <?= $validation->hasError('username') ? 'is-invalid' : '' ?>" placeholder="User Name">
                            <div class="invalid-feedback">
                                <?= esc($validation->getError('username')) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <script nonce="<?= SCRIPT_NONCE ?>" type="text/javascript" src="https://www.google.com/recaptcha/api.js" async defer></script>
                        <script nonce="<?= SCRIPT_NONCE ?>" type="text/javascript">function enableRegister() {
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
                        <button type="submit" class="btn btn-secondary" disabled id="btnRegister">Submit</button>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
        </div>  
    </div>
</div>
<?= $this->endSection() ?>