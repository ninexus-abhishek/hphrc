<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
    <?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- page content -->
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit Sub Category</h2>                    
                        <div class="clearfix"></div>
                    </div>
                    <div class="row justify-content-center">
                        <br/>
                        <div class="col-md-9 col-sm-12 col-xs-12">
                        <?= form_open(route_to('admin.sub_category', $category_code), ['class'=>'form-horizontal form-label-left','id' => 'edit_category','name'=>'editcategory']) ?>                                               
                            <div class="row">
                            <div class="form-group">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label class="control-label form-label label_class" for="ref_category_code">Main Category</label>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" id="ref_category_code" name="ref_category_code">                                              
                                        <option class="" value="" selected="" disabled=""i>Select File Type</option>       
                                        <?php if($file_type): ?>
                                            <?php foreach ($file_type as $row): ?>
                                                <option class="" value="<?= $row['category_code']; ?>" <?= set_selected(old('ref_category_code') ?? $category['ref_category_code'], $row['category_code']) ?>><?= $row['category_title']; ?></option>   
                                            <?php endforeach; ?>
                                        <?php endif; ?>                                           
                                    </select>
                                    <span class="invalid-feedback"><?= esc($validation->getError('ref_category_code')) ?></span>
                                </div>
                            </div>
                            </div>    
                            <div class="row">
                                <div class="mb-3">
                                    <div class="col-md-3 col-sm-3 col-12">
                                        <label class="control-label form-label label_class" for="category_code">Category Code</label>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <input type="text" name="category_code" value="<?= old('category_code') ?? $category['category_code']; ?>"  placeholder="Enter Category Code" class="form-control col-md-7 col-xs-12" autocomplete="off">
                                        <span class="invalid-feedback"><?= esc($validation->getError('category_code')) ?></span>
                                    </div>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <div class="col-md-3 col-sm-3 col-12">
                                        <label class="control-label label_class" for="category_title">Category Title</label>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <input type="text" name="category_title" value="<?= old('category_title') ?? $category['category_title']; ?>"  placeholder="Enter Category Title" class="form-control col-md-7 col-xs-12" autocomplete="off">
                                        <span class="invalid-feedback"><?= esc($validation->getError('category_title')) ?></span>
                                    </div>                                
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <div class="col-md-3 col-sm-3 col-12">
                                        <label class="control-label label_class" for="category_description">Description</label>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <textarea class="field form-control col-md-7 col-xs-12" rows="5" placeholder="Enter description" name="category_description"><?= old('category_description') ?? $category['category_description']; ?></textarea>
                                        <span class="invalid-feedback"><?= esc($validation->getError('category_description')) ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                         
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-sm-12 col-xs-12">   
                            <div class="row">
                                <div class="mb-3">
                                <div class="col-md-3 col-sm-3 col-xs-12"></div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <button type="submit" class="btn btn-success" id="btnSubmit">Update</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                    </div>
                        </div>
                        <?= form_close();?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>  
<?= $this->endSection() ?>