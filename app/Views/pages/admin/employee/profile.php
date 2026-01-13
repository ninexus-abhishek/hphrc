<?= $this->extend('layouts/employee') ?>

<?= $this->section('title') ?>
    <?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">   
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Profile</h3>
                        </div>
                    </div>
                </div>

                <div class="nk-block nk-block-lg">                   
                    <div class="card">
                        <?php $class_name = (! empty($validation->getErrors())) ? 'is-alter ' : '' ;?>
                        <div class="card-inner">
                             <?= form_open(route_to('emp.profile'), ['id' => 'frm_change_password','class'=> $class_name .'gy-3']) ?>                            
                                <div class="row g-3 align-center">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label float-right" for="user_current_password">Current Password:</label>                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="password" class="form-control" name="user_current_password" id="user_current_password" placeholder="Enter Current Password" autocomplete="off">
                                                <span class="invalid"><?= esc($validation->getError('user_current_password')) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-4">
                                        <div class="form-group">                                            
                                            <label class="form-label float-right" for="user_new_password">New Password:</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="password" class="form-control" name="user_new_password" id="user_new_password" placeholder="Enter New Password" autocomplete="off">
                                                <span class="invalid"><?= esc($validation->getError('user_new_password')) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-4">
                                        <div class="form-group">                                             
                                             <label class="form-label float-right" for="user_confirm_password">Confirm Password: </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="password" class="form-control" name="user_confirm_password" id="user_confirm_password" placeholder="Enter Confirm Password" autocomplete="off">
                                                <span class="invalid"><?= esc($validation->getError('user_confirm_password')) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>                                
                                <div class="row g-3">
                                    <div class="col-lg-7 offset-lg-5">
                                        <div class="form-group mt-2">
                                            <button type="submit" class="btn btn-lg btn-primary">Update</button>                                          
                                        </div>
                                    </div>
                                </div>
                            <?= form_close() ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>