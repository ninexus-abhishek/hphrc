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
                        <h2>Edit File</h2>                    
                        <div class="clearfix"></div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-9 col-sm-12 col-xs-12">
                        <br/>
                        
                        <?= form_open(route_to('admin.file_edit'.$upload_file_id),
                             ['class'=>'form-horizontal form-label-left','id' => 'edit_causes','name'=>'editcauses','enctype'=>'multipart/form-data']);
                             
                        ?>  
                        <div class="row">
                        <div class="mb-3">
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <label class="control-label label_class" for="upload_file_title" >Title<span class="required">*</span>
                                </label>
                            </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="upload_file_title" value="<?= old('upload_file_title') ?? $single_file['upload_file_title']; ?>"  placeholder="Enter file title" class="form-control col-md-7 col-xs-12" autocomplete="off">
                                    <span class="invalid-feedback"><?= esc($validation->getError('upload_file_title')) ?></span>
                                </div>                                
                            </div>
                        </div>                                             
                        <div class="row">                                
                            <div class="mb-3">
                                <div class="col-md-3 col-sm-3 col-12">
                                    <label class="control-label label_class" for="upload_file_desc">Description<span class="required">*</span>
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <textarea class="field form-control col-md-7 col-xs-12" rows="5" placeholder="Enter file description" name="upload_file_desc"><?= old('upload_file_desc') ?? $single_file['upload_file_desc']; ?></textarea>
                                    <span class="invalid-feedback"><?= esc($validation->getError('upload_file_desc')) ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <div class="col-md-3 col-sm-3 col-12">
                                    <label class="control-label label_class" for="upload_file_ref_no" >Reference File No<span class="required">*</span>
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <input type="text" name="upload_file_ref_no" value="<?= old('upload_file_ref_no') ?? $single_file['upload_file_ref_no']; ?>"  placeholder="Enter ref file number" class="form-control col-md-7 col-xs-12" autocomplete="off">
                                    <span class="invalid-feedback"><?= esc($validation->getError('upload_file_ref_no')) ?></span>
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
                                        <select class="form-control" id="upload_file_type" name="upload_file_type">
                                            <option class="" value="" selected="" disabled=""i>Select File Type</option>       
                                            <?php if($file_type): ?>
                                                <?php foreach ($file_type as $row): ?>
                                                    <option class="" value="<?= $row['category_code']; ?>" <?= set_selected(old('upload_file_type') ?? $single_file['upload_file_type'], $row['category_code']) ?>><?= $row['category_title']; ?></option>   
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
                                        <select class="form-control" name="upload_file_sub_type" required="" id="upload_file_sub_type">                                              
                                            <option class="" value="" selected="" disabled=""i>Select File Sub Type</option> 
                                            <?php if ($file_sub_type): ?>
                                                <?php foreach ($file_sub_type as $row): ?>
                                                    <option class="" value="<?= $row['category_code']; ?>" <?= set_selected(old('upload_file_sub_type') ?? $single_file['upload_file_sub_type'], $row['category_code']) ?>><?= $row['category_title']; ?></option>   
                                                <?php endforeach; ?>
                                            <?php endif; ?> 
                                        </select>
                                        <span class="invalid-feedback"><?= esc($validation->getError('upload_file_sub_type')) ?></span>
                                    </div>
                                                </div>                                                           </div> 
                        </div></div>                     
                            <div class="ln_solid"></div>
                            
                    <div class="row justify-content-center">
                        <div class="col-md-9 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="mb-3">
                                <div class="col-md-3 col-sm-3 col-xs-12"></div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button type="submit" class="btn btn-success" id="btnSubmit">Update</button>    
                                        
                                    </div>  
                                </div>
                            </div>
                        </div></div>
                            <br><br>                          
                        <?= form_close();?> 
                    </div>
                </div>
            </div>
        </div> 
<?= $this->endSection() ?>