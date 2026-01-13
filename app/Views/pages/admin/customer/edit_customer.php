<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
    <?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Add Complainant</h2>                    
                        <div class="clearfix"></div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-9 col-sm-12 col-xs-12">
                        <br />
                        <?=  form_open(route_to('admin.edit_customer', $customer_id),
                         ['class' => 'form-horizontal form-label-left', 'id' => 'edit_customer1', 'name' => 'edituser', 'enctype' => 'multipart/form-data']);
                        
                        ?>   
                        <div class="row">                                                                      
                        <div class="mb-3">
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <label class="control-label label_class" for="customer_first_name">First Name
                                </label>
                            </div>
                            
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="customer_first_name" value="<?= old('customer_first_name') ?? $single_customer['customer_first_name']; ?>" id="customer_first_name"  placeholder="Enter First Name" class="form-control col-md-7 col-xs-12" autocomplete="off">
                                <span class="invalid-feedback"><?= esc($validation->getError('customer_first_name')) ?></span>
                            </div>                                
                        </div> 
                        </div>
                        <div class="row">
                        <div class="mb-3">
                            <div class="col-md-3 col-sm-3 col-12">
                                <label class="control-label label_class" for="customer_middle_name">Middle Name
                                </label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <input type="text" name="customer_middle_name" value="<?= old('customer_middle_name') ?? $single_customer['customer_middle_name']; ?>" id="customer_middle_name" placeholder="Enter Middle Name" class="form-control col-md-7 col-xs-12" autocomplete="off">
                                <span class="invalid-feedback"><?= esc($validation->getError('customer_middle_name')) ?></span>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="mb-3">
                            <div class="col-md-3 col-sm-3 col-12">
                                <label class="control-label label_class" for="customer_last_name">Last Name
                                </label>
                            </div>
                            
                            <div class="col-md-6 col-sm-6 col-12">
                                <input type="text" name="customer_last_name" value="<?= old('customer_last_name') ?? $single_customer['customer_last_name']; ?>" id="customer_last_name"  placeholder="Enter Last Name" class="form-control col-md-7 col-xs-12" autocomplete="off">
                                <span class="invalid-feedback"><?= esc($validation->getError('customer_last_name')) ?></span>
                            </div>                                
                        </div></div>
                        <div class="row">
                        <div class="mb-3">
                            <div class="col-md-3 col-sm-3 col-12">
                                <label class="control-label label_class" for="customer_father_name">Father Name
                                </label>
                            </div>
                            
                            <div class="col-md-6 col-sm-6 col-12">
                                <input type="text" name="customer_father_name" value="<?= old('customer_father_name') ?? $single_customer['customer_father_name']; ?>" id="customer_father_name"  placeholder="Enter Father Name" class="form-control col-md-7 col-xs-12">
                                <span class="invalid-feedback"><?= esc($validation->getError('customer_father_name')) ?></span>
                            </div>                                
                        </div></div>
                        <div class="row">
                        <div class="mb-3">
                            <div class="col-md-3 col-sm-3 col-12">
                                <label class="control-label" for="customer_mobile_no">Mobile No
                                </label>
                            </div>
                            
                            <div class="col-md-6 col-sm-6 col-12">
                                <input type="text" name="customer_mobile_no" value="<?= old('customer_mobile_no') ?? $single_customer['customer_mobile_no']; ?>" id="customer_mobile_no" maxlength="10" minlength="10"  placeholder="Enter Mobile No" class="form-control col-md-7 col-xs-12 mobileno" autocomplete="off">
                                <span class="invalid-feedback"><?= esc($validation->getError('customer_mobile_no')) ?></span>
                            </div>                                
                        </div></div>
                        <div class="row">
                        <div class="mb-3">
                            <div class="col-md-3 col-sm-3 col-12">
                                <label class="control-label label_class" for="customer_email_id">Email
                                </label>
                            </div>
                            
                            <div class="col-md-6 col-sm-6 col-12">
                                <input type="email" name="customer_email_id" value="<?= old('customer_email_id') ?? $single_customer['customer_email_id']; ?>" id="customer_email_id"  placeholder="Enter Email" class="form-control col-md-7 col-xs-12" autocomplete="off">
                                <span class="invalid-feedback"><?= esc($validation->getError('customer_email_id')) ?></span>
                            </div>                                
                        </div></div>
                        <div class="row">
                        <div class="mb-3">
                            <div class="col-md-3 col-sm-3 col-12">
                                <label class="control-label label_class" for="customer_dob">Date of birth
                                </label>
                            </div>
                            
                            <div class="col-md-6 col-sm-6 col-12">
                                <input type="date" name="customer_dob" value="<?= old('customer_dob') ?? $single_customer['customer_dob']; ?>" id="customer_dob" data-date-format="yyyy-mm-dd"  placeholder="Select Date of birth" class="form-control col-md-7 col-xs-12" autocomplete="off" >
                                <span class="invalid-feedback"><?= esc($validation->getError('customer_dob')) ?></span>
                            </div>
                        </div></div>
                        <div class="row">
                        <div class="mb-3">
                            <div class="col-md-3 col-sm-3 col-12">
                                <label class="control-label label_class" for="customer_gender">Gender
                                </label>
                            </div>
                            
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="flat" name="customer_gender" value="M" <?= set_cheked('M', old('customer_gender') ?? $single_customer['customer_gender']) ?>> Male
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="flat" name="customer_gender" value="F" <?= set_cheked('F', old('customer_gender') ?? $single_customer['customer_gender']) ?>> Female
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="flat" name="customer_gender" value="O" <?= set_cheked('O', old('customer_gender') ?? $single_customer['customer_gender']) ?>> Other
                                    </label>
                                </div>
                                <span class="invalid-feedback"><?= esc($validation->getError('customer_gender')) ?></span>
                            </div>                                
                        </div>     </div>
                        </div></div>                                                                                                                                                     
                        <div class="ln_solid"></div>
                
                    <div class="row justify-content-center">
                        <div class="col-md-9 col-sm-12 col-xs-12">
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
                    <br><br>                           
                        <?= form_close(); ?>  
                    </div>
                </div>
            </div>
 </div> 
<?= $this->endSection() ?>