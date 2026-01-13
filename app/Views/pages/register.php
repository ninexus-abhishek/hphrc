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
        <h1 class="page-title">REGISTRATION<span class="title-under"></span></h1>
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
                <?= form_open(route_to('front.register'), ['class' => 'contact-form', 'id' => 'student_register1', 'name' => 'adduser', 'enctype' => 'multipart/form-data']) ?>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <label class="form-label fw-bold" for="customer_first_name">First Name</label>
                            </div>
                            <div class="col-sm-8 col-xs-12">
                                <input type="text" class="form-control <?= $validation->hasError('customer_first_name') ? 'is-invalid': '' ?>" name="customer_first_name" id="customer_first_name" placeholder="Enter First Name" autocomplete="off" value="<?= old('customer_first_name') ?>">
                                <div class="invalid-feedback">
                                    <?= esc($validation->getError('customer_first_name')) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <label class="form-label fw-bold" for="customer_middle_name">Middle Name</label>
                            </div>
                            <div class="col-sm-8 col-xs-12">
                                <input type="text" class="form-control <?= $validation->hasError('customer_middle_name') ? 'is-invalid': '' ?>" name="customer_middle_name" id="customer_middle_name" placeholder="Enter Middle Name" autocomplete="off" value="<?= old('customer_middle_name') ?>">
                                <div class="invalid-feedback">
                                    <?= esc($validation->getError('customer_middle_name')) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <label class="form-label fw-bold" for="customer_last_name">Last Name</label>
                            </div>
                            <div class="col-sm-8 col-xs-12">
                                <input type="text" class="form-control <?= $validation->hasError('customer_last_name') ? 'is-invalid': '' ?>" name="customer_last_name" id="customer_last_name" placeholder="Enter Last Name" autocomplete="off" value="<?= old('customer_last_name') ?>">
                                <div class="invalid-feedback">
                                    <?= esc($validation->getError('customer_last_name')) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <label class="form-label fw-bold" for="customer_father_name">Father Name</label>
                            </div>
                            <div class="col-sm-8 col-xs-12">
                                <input type="text" class="form-control <?= $validation->hasError('customer_father_name') ? 'is-invalid': '' ?>" name="customer_father_name" id="customer_father_name" placeholder="Enter Father Name" autocomplete="off" value="<?= old('customer_father_name') ?>">
                                <div class="invalid-feedback">
                                    <?= esc($validation->getError('customer_father_name')) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <label class="form-label fw-bold" for="customer_mobile_no">Mobile Number</label>
                            </div>
                            <div class="col-sm-8 col-xs-12">
                                <input type="text" class="form-control mobileno <?= $validation->hasError('customer_mobile_no') ? 'is-invalid': '' ?>" name="customer_mobile_no" id="customer_mobile_no" placeholder="Enter Mobile Number " autocomplete="off" value="<?= old('customer_mobile_no') ?>">
                                <div class="invalid-feedback">
                                    <?= esc($validation->getError('customer_mobile_no')) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <label class="form-label fw-bold" for="customer_email_id">Email</label>
                            </div>
                            <div class="col-sm-8 col-xs-12">
                                <input type="email" class="form-control <?= $validation->hasError('customer_email_id') ? 'is-invalid': '' ?>" name="customer_email_id" id="customer_email_id" placeholder="Enter Email" autocomplete="off" value="<?= old('customer_email_id') ?>">
                                <div class="invalid-feedback">
                                    <?= esc($validation->getError('customer_email_id')) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <label class="form-label fw-bold" for="customer_email_password">New Password</label>
                            </div>
                            <div class="col-sm-8 col-xs-12">
                                <input type="password" class="form-control <?= $validation->hasError('customer_email_password') ? 'is-invalid': '' ?>" name="customer_email_password" id="customer_email_password" placeholder="Enter New Password" autocomplete="off" value="<?= old('customer_email_password') ?>">
                                <div class="invalid-feedback">
                                    <?= esc($validation->getError('customer_email_password')) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <label class="form-label fw-bold" for="user_confirm_password">Confirm Password</label>
                            </div>
                            <div class="col-sm-8 col-xs-12">
                                <input type="password" class="form-control <?= $validation->hasError('user_confirm_password') ? 'is-invalid': '' ?>" name="user_confirm_password" id="user_confirm_password" placeholder="Enter Confirm Password" autocomplete="off" value="<?= old('user_confirm_password') ?>">
                                <div class="invalid-feedback">
                                    <?= esc($validation->getError('user_confirm_password')) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <label class="form-label fw-bold" for="customer_dob">Date of Birth</label>
                            </div>
                            <div class="col-sm-8 col-xs-12">
                                <input type="date" class="form-control dob <?= $validation->hasError('customer_dob') ? 'is-invalid': '' ?>" name="customer_dob" autocomplete="off" value="<?= old('customer_dob') ?>">
                                <div class="invalid-feedback">
                                    <?= esc($validation->getError('customer_dob')) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <label class="form-label fw-bold" for="customer_gender">Gender</label>
                            </div>
                            <div class="col-sm-8 col-xs-12">
                                <?php $oldGenderValue = old('customer_gender'); ?>
                                <?php $class = $validation->hasError('customer_gender') ? "form-check-input is-invalid" : "form-check-input"; ?>
                                <div class="form-check">
                                    <input class="<?= $class ?>" id="gender_male" type="radio" <?= empty($oldGenderValue) || $oldGenderValue === "M" ? "checked" : "" ?> name="customer_gender" value="M">
                                    <label class="form-check-label" for="gender_male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="<?= $class ?>" id="gender_female" <?= $oldGenderValue === "F" ? "checked" : "" ?> name="customer_gender" value="F">
                                    <label class="form-check-label" for="gender_female">Female</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="<?= $class ?>" id="gender_other" <?= $oldGenderValue === "O" ? "checked" : "" ?> name="customer_gender" value="O">
                                    <label class="form-check-label" for="gender_other">Other</label>
                                    <div class="invalid-feedback">
                                        <?= esc($validation->getError('customer_gender')) ?>
                                    </div>
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
                    <div class="form-group">
                        <div class="m-auto text-center">    
                            <button type="submit" class="btn btn-secondary"  disabled="true" id="btnRegister">Register</button>
                        </div>
                    </div>
                <?= form_close() ?>  
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>