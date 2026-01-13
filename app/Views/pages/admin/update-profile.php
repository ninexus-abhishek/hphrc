<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
    <?= $title ?>
<?= $this->endSection() ?>


<?= $this->section('styles') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/modules/DataTables/datatables.min.css') ?>" />

<?= $this->endSection() ?>
<?= $this->section('content') ?>
<style>
     .update_submit{
        margin-left:17%;
     }
</style>
<div class="row">   
    <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                <div class="x_title">
                         <h2>Update Profile</h2>                    
                    <div class="clearfix"></div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="x_content">
                                <br />
                                <!-- <form method="post" id="frm_change_password" class="form-horizontal form-label-left" action="<?php echo ADMIN_UPDATE_PROFILE_LINK ?>"> -->
                                    
                                    <?php
                                        $attributes = ['id' => 'frm_change_password','class'=>'form-horizontal form-label-left'];
                                        echo form_open(ADMIN_UPDATE_PROFILE_LINK,$attributes);
                                    ?> 
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="control-label col-sm-2" for="user_current_password">Current Password:</label>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control  <?= $validation->haserror('user_current_password') ? 'is-invalid' : '' ?>  col-md-7 col-xs-12 " name="user_current_password" id="user_current_password" placeholder="Enter Current Password"  autocomplete="off">
                                                <div class="invalid-feedback text-start">
                                                        <?= esc($validation->getError('user_current_password')) ?>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="control-label col-sm-2" for="user_new_password">New Password:</label>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control  <?= $validation->haserror('user_new_password') ? 'is-invalid' : '' ?> col-md-7 col-xs-12" name="user_new_password" id="user_new_password" placeholder="Enter New Password"  autocomplete="off">
                                                <div class="invalid-feedback text-start">
                                                        <?= esc($validation->getError('user_new_password')) ?>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="control-label label col-sm-2" for="user_confirm_password">Confirm Password: </label>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control  <?= $validation->haserror('user_confirm_password') ? 'is-invalid' : '' ?>  col-md-7 col-xs-12" name="user_confirm_password" id="user_confirm_password" placeholder="Enter Confirm Password"  autocomplete="off">
                                                <div class="invalid-feedback text-start">
                                                        <?= esc($validation->getError('user_confirm_password')) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                                                                                                                         
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="update_submit">
                                            <button type="submit" id="btnSubmit"  class="btn btn-success ">Update</button>
                                        </div>
                                    </div>
                                <?= form_close();?> 
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                
            
</div>
<?= $this->endSection() ?>