<?= $this->extend('layouts/employee') ?>

<?= $this->section('title') ?>
    <?= $title ?>
<?= $this->endSection() ?>


<?= $this->section('styles') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/modules/DataTables/datatables.min.css') ?>" />
<link type="text/css" href="<?= base_url('assets/modules/summernote/summernote.min.css') ?>" rel="stylesheet">
<?= $this->endSection() ?>



<?= $this->section('content') ?>
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">   
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Edit Case</h3>
                        </div>
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block nk-block-lg">                   
                    <div class="card">
                        <div class="card-inner">  
                            <?=
                             $class_name = (! empty($validation->getErrors())) ? 'is-alter ' : '' ;
                            $attributes = ['class' => 'gy-3', 'id' => 'edit_cases1', 'name' => 'addcases'];
                             form_open(route_to('emp.case.edit'.$cases_res['cases_id']), $attributes);
                            ?>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right" for="case_no">Case No:</label>
                                    </div>
                                </div> 
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control <?= $validation->hasError('case_no') ? 'invalid' : '' ?>" name="case_no" value="<?= old('case_no') ?? $cases_res['case_no']; ?>" id="case_no" placeholder="Enter Case No" autocomplete="off" <?= (!empty($cases_res['case_no'])) ? "readonly" : "" ?>>
                                            <span class="invalid"><?= esc($validation->getError('case_no')) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right" for="cases_title">Title:</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                        <input type="text" class="form-control <?= $validation->hasError('cases_title') ? 'invalid' : '' ?>" name="cases_title" value="<?= old('cases_title') ?? $cases_res['cases_title']; ?>" id="cases_title" placeholder="Enter Title" autocomplete="off" <?= (!empty($cases_res['cases_title'])) ? "readonly" : "" ?>>
                                            <span><?= esc( $validation->hasError('cases_title') ? 'invalid' : '' ) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            
                                <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right" for="cases_party_name">Party Name:</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control <?= $validation->hasError('cases_party_name') ? 'invalid' : '' ?>" name="cases_party_name" value="<?= old('cases_party_name') ?? $cases_res['cases_party_name']; ?>" id="cases_party_name" placeholder="Enter Party Name" autocomplete="off">
                                            <span><?= esc($validation->hasError('cases_party_name') ? 'invalid' : '') ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right" for="cases_party_address">Party Address:</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <textarea class="form-control form-control-sm <?= $validation->hasError('cases_party_address') ? 'invalid' : '' ?>" name="cases_party_address" id="cf-default-textarea" placeholder="Enter Party Address"><?= old('cases_party_address') ?? $cases_res['cases_party_address']; ?></textarea>
                                            <span><?= esc($validation->hasError('cases_party_address') ? 'invalid' : '') ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right" for="cases_party_number">Party Contact Number:</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control mobileno <?= $validation->hasError('cases_party_number') ? 'invalid' : '' ?>" name="cases_party_number" value="<?= old('cases_party_number') ?? $cases_res['cases_party_number']; ?>" id="cases_party_number" placeholder="Enter Party Mobile Number" maxlength="10" minlength="10" autocomplete="off">
                                            <span class="invalid"><?= esc($validation->getError('cases_party_number')) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>                                                                                    
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label float-right" for="cases_assign_to">Assign to:</label>                                            
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <select class="form-control <?= $validation->hasError('cases_assign_to') ? 'invalid' : '' ?>" id="cases_assign_to" name="cases_assign_to" tabindex="-1" aria-hidden="true">
                                                <option class="" value="" disabled="" selected="">------ Select Employee ------</option>
                                                <?php if (!empty($res_employee)): ?>
                                                    <?php foreach ($res_employee as $row): ?>
                                                        <option value="<?= $row['employee_user_id']; ?>" <?= set_selected($row['employee_user_id'], old('cases_assign_to') ?? $cases_res['cases_assign_to']); ?>>
                                                            <?= $row['user_firstname'] . ' ' . $row['user_lastname']; ?>
                                                        </option>    
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                            <span class="invalid"><?= esc($validation->getError('cases_assign_to')) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right" for="cases_message">Description:</label>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-control-wrap">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <textarea class="summernote-basic-id" id="summernote" name="cases_message">
                                                    <?= old('cases_message') ?? $cases_res['cases_message'] ?>
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                                        
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right">Priority:</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio1" name="cases_priority" class="custom-control-input" value="Low" <?= set_cheked('Low', old('cases_priority') ?? $cases_res['cases_priority']) ?>>
                                                <label class="custom-control-label" for="customRadio1">Low</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio2" name="cases_priority" class="custom-control-input" value="Medium" <?= set_cheked('Medium', old('cases_priority') ?? $cases_res['cases_priority']) ?>>
                                                <label class="custom-control-label" for="customRadio2">Medium</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio3" name="cases_priority" class="custom-control-input <?= $validation->hasError('cases_priority') ? 'invalid' : '' ?>" value="High" <?= set_cheked('High', old('cases_priority') ?? $cases_res['cases_priority']) ?>>
                                                <label class="custom-control-label" for="customRadio3">High</label>
                                            </div>
                                        </div>
                                        <span class="invalid"><?= esc($validation->getError('cases_priority')) ?></span>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="row g-3">
                                <div class="col-lg-7 offset-lg-5">
                                    <div class="form-group mt-2">
                                        <button type="submit" class="btn btn-lg btn-primary" id="btnSubmit">Submit</button>                                          
                                    </div>
                                </div>
                            </div>
                            <?= form_close(); ?>  
                        </div>
                    </div><!-- card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script type="text/javascript" nonce="<?= SCRIPT_NONCE ?>" src="<?= base_url('assets/modules/summernote/summernote.min.js') ?>"></script>
<script nonce="<?= SCRIPT_NONCE ?>">
    $(document).ready(() => {
        $('#summernote').summernote({
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'strikethrough', 'clear']],
                ['font', ['superscript', 'subscript']],
                ['color', ['color']],
                ['fontsize', ['fontsize', 'height']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['view', ['fullscreen']],
                
            ],
        });
    });
</script>
<?= $this->endSection() ?>