<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
<?= $title ?>
<?= $this->endSection() ?>


<?= $this->section('styles') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div>
    <div class="login_wrapper" id="validdiv1">
        <div class="animate form login_form">
            <section class="login_content">
                <?= form_open(ADMIN_LOGIN_LINK, ['id' => 'loginform']) ?>
                <h1>Login Form</h1>
                <div class="form-group">
                    <input type="text" class="form-control <?= $validation->haserror('username') ? 'is-invalid' : '' ?>" id="username" placeholder="Username" name="username" maxlength="50" autocomplete="off" value="<?= old('username') ?>">
                    <div class="invalid-feedback text-start"><?= esc($validation->getError('username')) ?></div>
                </div>
                <div>

                    <input type="password" class="form-control <?= $validation->haserror('password') ? 'is-invalid' : '' ?>" placeholder="Password" id="password" name="password" autocomplete="off" maxlength="50" autocomplete="off">
                    <div class="invalid-feedback text-start">
                        <?= esc($validation->getError('password')) ?>
                    </div>
                </div>
                <div>
                    <script nonce='S51U26wMQz' type="text/javascript" src="https://www.google.com/recaptcha/api.js" async defer></script>
                    <script nonce='S51U26wMQz' type="text/javascript">
                        function enableLogin() {
                            document.getElementById("btnSubmit").disabled = false;
                        }
                    </script>

                    <div class="g-recaptcha mt-4" data-sitekey="6LdnvCQUAAAAAGmHBukXVzjs5NupVLlaIHJdpFWo" data-callback="enableLogin"></div>
                    <br>
                </div>
                <div class="d-grid gap-2">
                    <input type="submit" id="btnSubmit" disabled="" class="btn primary_btn btn_disabled submit btn-info text-white" value="Log in" name="login" />
                </div>
                <div class="clearfix"></div>

                <div class="separator">
                    <?php
                    if (isset($_SESSION['valid'])) {
                        if ($_SESSION['valid'] == 1) {
                    ?>
                            <center>
                                <div id="validdiv">Invalid Username And Password</div>
                            </center>
                            <br />
                    <?php
                        }
                    }
                    ?>
                    <div>
                        <h1><i class="fa fa-modx"></i> &nbsp; HPSHRC</h1>
                        <p class="copyright">&copy;<?= date("Y"); ?> All Rights Reserved HPSHRC.</p>
                    </div>
                </div>
                <?= form_close(); ?>
            </section>
        </div>
    </div>
</div>
<?= $this->endSection() ?>