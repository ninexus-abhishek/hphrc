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
                        <h2>Add File</h2>                    
                        <div class="clearfix"></div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-9 col-sm-12 col-xs-12">
                        <br />     
                        <?= form_open(route_to('admin.file_add'), ['class'=>'form-horizontal form-label-left','id' => 'add_causes1','name'=>'addcauses','enctype'=>'multipart/form-data']);
                         ;
                       ?>  
                       <div class="row">
                            <div class="mb-3">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label class="control-label label_class" for="upload_file_title">Title
                                    </label>
                                </div>                               
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="upload_file_title" placeholder="Enter file title" class="form-control <?= $validation->haserror('upload_file_title') ? 'is-invalid' : '' ?>" autocomplete="off" value="<?= old('upload_file_title') ?>" id="upload_file_title">
                                    <div class="invalid-feedback text-start"><?= esc($validation->getError('upload_file_title')) ?></div>
                                </div>
                            </div>
                       </div>                                              
                       <div class="row">
                            <div class="mb-3">
                                <div class="col-md-3 col-sm-3 col-12">
                                    <label class="control-label label_class" for="upload_file_desc" >Description
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <textarea class="field form-control <?= $validation->haserror('upload_file_desc') ? 'is-invalid' : '' ?>" rows="5" placeholder="Enter file description" name="upload_file_desc" id="upload_file_desc"><?= old('upload_file_desc') ?></textarea>
                                    <div class="invalid-feedback text-start"><?= esc($validation->getError('upload_file_desc')) ?></div>
                                </div>
                            </div>
                        </div>
                         <div class="row">
                            <div class="mb-3">
                                <div class="col-md-3 col-sm-3 col-12">
                                    <label class="control-label label_class" for="upload_file_ref_no" >Reference File No
                                    </label>
                                </div>
                                
                                <div class="col-md-6 col-sm-6 col-12">
                                    <input type="text" name="upload_file_ref_no"  placeholder="Enter ref file number" class="form-control <?= $validation->haserror('upload_file_ref_no') ? 'is-invalid' : '' ?>" autocomplete="off" value="<?= old('upload_file_ref_no') ?>" id="upload_file_ref_no">
                                    <div class="invalid-feedback text-start"><?= esc($validation->getError('upload_file_ref_no')) ?></div>
                                </div>                                
                            </div>
                        </div> 
                        <div class="row">   
                            <div class="mb-3">
                                <div class="col-md-3 col-sm-3 col-12">
                                    <label class="control-label label_class" for="upload_file_type">File Type
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <select class="form-control <?= $validation->haserror('upload_file_type') ? 'is-invalid' : '' ?>" id="upload_file_type" name="upload_file_type">
                                        <option class="" value="" selected="" disabled=""i>Select File Type</option>
                                        <?php if($file_type): ?>
                                            <?php foreach ($file_type as $row): ?>
                                                <option class="" value="<?= $row['category_code']; ?>" <?= ($row['category_code'] == old('upload_file_type')) ? 'selected' : '' ?>><?= $row['category_title']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>                                           
                                    </select>
                                    <span class="invalid-feedback"><?= esc($validation->getError('upload_file_type')) ?></span>
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <div class="col-md-3 col-sm-3 col-12">
                                    <label class="control-label label_class" for="upload_file_sub_type" >File Sub Type
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <select class="form-control <?= $validation->haserror('upload_file_sub_type') ? 'is-invalid' : '' ?>" name="upload_file_sub_type" id="upload_file_sub_type" data-bv-field="upload_file_sub_type">
                                        <option class="" value="" selected="" disabled=""i>Select File Sub Type</option>
                                        
                                    </select>
                                    <div class="invalid-feedback text-start"><?= esc($validation->getError('upload_file_sub_type')) ?></div>
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <div class="col-md-3 col-sm-3 col-12">
                                    <label class="control-label label_class" for="upload_file_original_name" >Select File
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <input type="file" id="upload_file_original_name" name="upload_file_original_name" class="form-control   <?= $validation->haserror('upload_file_original_name') ? 'is-invalid' : '' ?>" accept="application/pdf,image/jpg,image/jpeg,image/png">
                                    <div class="invalid-feedback text-start"><?= esc($validation->getError('upload_file_original_name')) ?></div>
                                </div>
                            </div>       
                        </div> 
                        </div>                                                     
                        <div class="ln_solid"></div>
                        
                    <div class="row justify-content-center">
                        <div class="col-md-9 col-sm-12 col-xs-12">
                            <div class="row justify-content-center">
                                <div class="mb-3">
                                    <div class="col-md-3 col-sm-3 col-xs-12"></div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <button class="btn btn-primary" type="reset">Reset</button>
                                        <button type="submit" class="btn btn-success"  id="btnLogin">Submit</button>
                                    </div>
                                </div>  
                            </div>
                            </div>
                        </div>
                    </div>

                        <br> <br><br>
                       <?= form_close();?>  
                    </div>
                    

                </div>
            </div>
        </div> 
<?= $this->endSection() ?>