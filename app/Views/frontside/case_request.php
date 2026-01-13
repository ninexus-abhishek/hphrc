<style>
    .btn_disabled{
        pointer-events: none;
        background-color: #c3bdbd;
        opacity: 15.9;
    }
    .howtocontact{
        display: none !important;
    }
</style>
<div class="page-heading text-center">
    <div class="container zoomIn animated">
        <h1 class="page-title">CASE REQUEST<span class="title-under"></span></h1>
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
                <?php
                $attributes = ['class' => 'contact-form', 'id' => 'add_complaint', 'name' => 'addcases', 'enctype' => 'multipart/form-data'];
                echo form_open(CASE_REQUEST_LINK, $attributes);                
                ?>                                                    
                <div class="form-group">
                    <div class="row">
                        <label class="control-label col-sm-4 col-xs-12" for="cases_title">Title:</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" class="form-control" name="cases_title" id="cases_title" placeholder="Enter Title" autocomplete="off" value="<?= old('cases_title') ?>">
                            <span class="text-danger"><?= esc($validation->getError('cases_title')) ?></span>
                        </div>
                    </div>
                </div>
                <?php if(!isset($_SESSION['customer']['customer_id'])): ?>
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-4 col-xs-12" for="howtocontact">How to contact:</label>
                            <div class="col-sm-8 col-xs-12">
                                <select class="form-control" id="howtocontact" name="howtocontact" tabindex="-1" aria-hidden="true">
                                    <?php $oldValue = old('howtocontact'); ?>
                                    <option value="" <?= $oldValue === "" ? "selected" : "" ?>>------ Select ------</option>                                                
                                    <option value="Email" <?= $oldValue === "Email" ? "selected" : "" ?>>Email</option>                                                          
                                    <option value="Mobile" <?= $oldValue === "Mobile" ? "selected" : "" ?>>Mobile</option>                                                          
                                    <option value="Both" <?= $oldValue === "Both" ? "selected" : "" ?>>Both</option>                                                          
                                </select>
                                <span class="text-danger"><?= esc($validation->getError('howtocontact')) ?></span>
                            </div>
                        </div>
                    </div>                
                    <div class="form-group howtocontact howtocontact_email">
                        <div class="row">
                            <label class="control-label col-sm-4 col-xs-12" for="customer_email">Complainant Email:</label>
                            <div class="col-sm-8 col-xs-12">                            
                                <input type="email" class="form-control" name="customer_email" id="customer_email" placeholder="Enter Complainant email" autocomplete="off" value="<?= old('customer_email') ?>">
                                <span class="text-danger"><?= esc($validation->getError('customer_email')) ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group howtocontact howtocontact_mobile">
                        <div class="row">
                            <label class="control-label col-sm-4 col-xs-12" for="customer_contact">Complainant Mobile:</label>
                            <div class="col-sm-8 col-xs-12">
                                <input type="tel" class="form-control mobileno" name="customer_contact" id="customer_contact" placeholder="Enter Complainant mobile number" maxlength="10" minlength="10" autocomplete="off" value="<?= old('customer_contact') ?>">
                                <span class="text-danger"><?= esc($validation->getError('customer_contact')) ?></span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>                           
                <div class="form-group">
                    <div class="row">
                        <label class="control-label col-sm-4 col-xs-12" for="cases_party_name">Party Name:</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" class="form-control" name="cases_party_name" id="cases_party_name" placeholder="Enter Party Name" autocomplete="off" value="<?= old('cases_party_name') ?>">
                            <span class="text-danger"><?= esc($validation->getError('cases_party_name')) ?></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="control-label col-sm-4 col-xs-12" for="cases_party_address">Party Address:</label>
                        <div class="col-sm-8 col-xs-12">
                            <textarea class="form-control" rows="5" placeholder="Enter Party Address" name="cases_party_address"><?= old('cases_party_address') ?></textarea>
                            <span class="text-danger"><?= esc($validation->getError('cases_party_address')) ?></span>
                        </div>
                    </div>
                </div> 
                <div class="form-group">
                    <div class="row">
                        <label class="control-label col-sm-4 col-xs-12" for="cases_party_number">Party Contact Number:</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="tel" class="form-control mobileno" name="cases_party_number" id="cases_party_number" placeholder="Enter Party Mobile Number" maxlength="10" minlength="10" autocomplete="off" value="<?= old('cases_party_number') ?>">
                            <span class="text-danger"><?= esc($validation->getError('cases_party_number')) ?></span>
                        </div>
                    </div>
                </div>
                

                <div class="form-group case_files_file_div">
                    <div class="row">
                        <label class="control-label col-sm-4 col-xs-12" for="case_files_file">Files:
                        </label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="file" id="case_files_file" multiple name="case_files_file[]" accept="application/pdf,image/jpg,image/jpeg,image/png">
                            <span class="text-danger"><?= esc($validation->getError('case_files_file')) ?></span>
                        </div> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="control-label col-sm-4 col-xs-12" for="cases_message">Description:
                        </label>
                        <div class="col-sm-8 col-xs-12">
                            <textarea id="summernote" name="cases_message"><?= old('cases_message') ?></textarea>                            
                        </div> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <script nonce='S51U26wMQz' type="text/javascript" src="https://www.google.com/recaptcha/api.js" async defer></script>
                        <script nonce='S51U26wMQz' type="text/javascript">
                            function enableRegister() {                                
                                document.getElementById("btnSubmit").disabled = false;
                            }
                        </script>
                        <label class="control-label col-sm-4 col-xs-12" for="ptsp"></label>
                        <div class="col-sm-8 col-xs-12">
                            <div class="g-recaptcha" data-sitekey="6LdnvCQUAAAAAGmHBukXVzjs5NupVLlaIHJdpFWo" data-callback="enableRegister"></div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div class="m-auto text-center">    
                        <button type="submit" class="btn warning_btn"  disabled="true" id="btnSubmit">Submit</button>
                    </div>
                </div>
                <!--</form>-->
                <?php 
                echo form_close(); 
                ?>  
            </div>
        </div> <!-- /.row -->       
    </div>
</div>