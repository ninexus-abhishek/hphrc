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
                        <h2>Add Employee</h2>                    
                        <div class="clearfix"></div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-9 col-sm-12 col-xs-12">
                        <br />
                        <?=  form_open(route_to('admin.employee_registration'),  ['class' => 'form-horizontal form-label-left', 'id' => 'employee_register1', 'name' => 'adduser']);
                        ?> 
                        <div class="row">
                            <div class="mb-3">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                <label class="control-label label_class" for="user_firstname">First Name
                                </label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="user_firstname" id="user_firstname"  placeholder="Enter First Name" class="form-control col-md-7 col-xs-12 <?= $validation->haserror('user_firstname') ? 'is-invalid' : '' ?>" value="<?= old('user_firstname') ?>" autocomplete="off">
                                    <div class="invalid-feedback text-start"><?= esc($validation->getError('user_firstname')) ?></div>
                                </div>                                
                            </div> 
                        </div>                                                                        
                        <div class="row">
                            <div class="mb-3">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label class="control-label label_
                                    class" for="user_lastname">Last Name
                                    </label>
                                </div>
                                
                                <div class="col-md-6 col-sm-6 col-12">
                                    <input type="text" name="user_lastname" id="user_lastname"  placeholder="Enter Last Name" class="form-control col-md-7 col-xs-12 <?= $validation->haserror('user_lastname') ? 'is-invalid' : '' ?>" value="<?= old('user_lastname') ?>" autocomplete="off">
                                    <div class="invalid-feedback text-start"><?= esc($validation->getError('user_lastname')) ?></span>
                                </div>                                
                            </div> 
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label class="control-label label_class" for="user_email_id">Email
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="email" name="user_email_id" id="user_email_id"  placeholder="Enter Email" class="form-control <?= $validation->haserror('user_email_id') ? 'is-invalid' : '' ?> " value="<?= old('user_email_id') ?>" autocomplete="off">
                                    <div class="invalid-feedback text-start"><?= esc($validation->getError('user_email_id')) ?></div>
                                </div>                                
                            </div>
                        </div>                  
                       
                        <div class="form-group">
                            <div class="<?= $validation->haserror('employee_roll[]') ? 'is-invalid' : '' ?>">
                            <label class="control-label label_class col-md-3 col-sm-3 xol-xs-12" for="employee_roll[]">Employee Roll
                                </label>
                                <div class="col-md-6 col-sm-6 col-12">
                                <input type="checkbox" name="employee_roll[]" value="executive"> Executive &nbsp;&nbsp;
                                <input type="checkbox" name="employee_roll[]" value="lead"> Lead &nbsp;&nbsp;
                                <input type="checkbox" name="employee_roll[]" value="manager"> Manager &nbsp;&nbsp;
                                <input type="checkbox" name="employee_roll[]" value="director"> Director &nbsp;&nbsp;
                                <input type="checkbox" name="employee_roll[]" value="chairman"> Chairman
                                </div>
                                <br>
                                <div class="invalid-feedback text-start"><?= esc($validation->getError('employee_roll')) ?></div>
                            </div>
                        </div>
                        </div></div>
                        <div class="ln_solid"></div>
                
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-sm-12 col-xs-12">
                            <div class="row">
                            <div class="mb-3">
                                <div class="col-md-3 col-sm-3 col-xs-12"></div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <button class="btn btn-primary" type="reset">Reset</button>
                                        <button type="submit" class="btn btn-success"  id="btnSubmit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                    </div>
                        <br>
                        <br><br>                         
          <?= form_close(); ?>  
                    </div>
                </div>
            </div>
        </div> 
        <?= $this->endSection() ?>