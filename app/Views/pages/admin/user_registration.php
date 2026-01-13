<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
    <?= $title ?>
<?= $this->endSection() ?>


<?= $this->section('styles') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/modules/DataTables/datatables.min.css') ?>" />

<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Add Complainant</h2>                    
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <?=
                        $attributes = ['class' => 'form-horizontal form-label-left', 'id' => 'student_register1', 'name' => 'adduser', 'enctype' => 'multipart/form-data'];
                         form_open(ADMIN_CUSTOMER_REGISTER_LINK, $attributes);
                        ?>                                                                         
                        <div class="form-group">
                            <label class="control-label" for="customer_first_name">First Name
                            </label>
                            <div class="">
                                <input type="text" name="customer_first_name" id="customer_first_name"  placeholder="Enter First Name" class="form-control col-md-7 col-xs-12 <?= $validation->haserror('customer_first_name') ? 'is-invalid' : '' ?>" value="<?= old('customer_first_name') ?>" autocomplete="off">
                                <div class="invalid-feedback text-start"><?= esc($validation->getError('customer_first_name')) ?></div>
                            </div>                                
                        </div> 
                        <div class="form-group">
                            <label class="control-label" for="customer_middle_name">Middle Name
                            </label>
                            <div class="">
                                <input type="text" name="customer_middle_name" id="customer_middle_name"  placeholder="Enter Middle Name" class="form-control col-md-7 col-xs-12  <?= $validation->haserror('customer_middle_name') ? 'is-invalid' : '' ?>" value="<?= old('customer_middle_name') ?>" autocomplete="off">
                                <div class="invalid-feedback text-start"><?= esc($validation->getError('customer_middle_name')) ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="customer_last_name">Last Name
                            </label>
                            <div class="">
                                <input type="text" name="customer_last_name" id="customer_last_name"  placeholder="Enter Last Name" class="form-control col-md-7 col-xs-12 <?= $validation->haserror('customer_last_name') ? 'is-invalid' : '' ?>"  value="<?= old('customer_last_name') ?>" autocomplete="off">
                                <div class="invalid-feedback text-start"><?= esc($validation->getError('customer_last_name')) ?></div>
                            </div>                                
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="customer_father_name">Father Name
                            </label>
                            <div class="">
                                <input type="text" name="customer_father_name" id="customer_father_name"  placeholder="Enter Father Name" class="form-control col-md-7 col-xs-12 <?= $validation->haserror('customer_father_name') ? 'is-invalid' : '' ?>"  value="<?= old('customer_father_name') ?>" autocomplete="off">
                                <div class="invalid-feedback text-start"><?= esc($validation->getError('customer_father_name')) ?></div>
                            </div>                                
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="customer_mobile_no">Mobile No
                            </label>
                            <div class="">
                                <input type="text" name="customer_mobile_no" id="customer_mobile_no" maxlength="10" minlength="10"  placeholder="Enter Mobile No" class="form-control col-md-7 col-xs-12 mobileno <?= $validation->haserror('customer_mobile_no') ? 'is-invalid': '' ?>" value="<?= old('customer_mobile_no') ?>" autocomplete="off">
                                <div class="invalid-feedback text-start"><?= esc($validation->getError('customer_mobile_no')) ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="customer_email_id">Email
                            </label>
                            <div class="">
                                <input type="email" name="customer_email_id" id="customer_email_id"  placeholder="Enter Email" class="form-control col-md-7 col-xs-12 <?= $validation->haserror('customer_email_id')? 'is-invalid': '' ?>" value="<?= old('customer_email_id') ?>" autocomplete="off">
                                <div class="invalid-feedback text-start"><?= esc($validation->getError('customer_email_id')) ?></div>
                            </div>                                
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="customer_dob">Date of birth
                            </label>
                            <div class="">
                                <input type="date" name="customer_dob" id="customer_dob" data-date-format="yyyy-mm-dd"  placeholder="Select Date of birth" class="form-control col-md-7 col-xs-12 <?= $validation->haserror('customer_dob')? 'is-invalid': '' ?>" autocomplete="off" value="<?= old('customer_dob') ?>" autocomplete="off">
                                <div class="invalid-feedback text-start"><?= esc($validation->getError('customer_dob')) ?></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="customer_gender">Gender
                            </label>
                            <div class="">
                                <?php $oldValue = old('customer_gender'); ?>
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="flat <?= $validation->haserror('customer_gender')? 'is-invalid': '' ?>" name="customer_gender" value="M" <?= (empty($oldValue) || $oldValue === 'M') ? 'checked' : '' ?>> Male
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="flat" name="customer_gender" value="F" <?= $oldValue === 'F' ? 'checked' : '' ?>> Female
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="flat" name="customer_gender" value="O" <?= $oldValue === 'O' ? 'checked' : '' ?>> Other
                                    </label>
                                </div>
                                <div class="invalid-feedback text-start"><?= esc($validation->getError('customer_gender')) ?></div>
                            </div>                                
                        </div>                 
                                                                                                                                    
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-8 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="reset">Reset</button>
                                <button type="submit" class="btn btn-success"  id="btnSubmit">Submit</button>
                            </div>
                        </div>                            
                        <?= form_close(); ?>  
                    </div>
                </div>
            </div>
        </div> 
<?= $this->endSection() ?>