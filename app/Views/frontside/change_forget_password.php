<style>
    .btn_disabled{
        pointer-events: none;
        background-color: #c3bdbd;
        opacity: 15.9;
    }
</style>
<div class="page-heading text-center">
    <div class="container zoomIn animated">
        <h1 class="page-title">LOGIN<span class="title-under"></span></h1>
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
                $attributes = ['class' => 'contact-form','id'=>'frm_change_password'];
                echo form_open(UPDATE_FORGET_PASSWORD_LINK, $attributes);                
                ?>                                                                           
                <div class="form-group">
                <div class="row">
                    <label class="control-label col-sm-4 col-xs-12" for="rmsa_user_new_password">New Password:</label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="password" class="form-control" name="rmsa_user_new_password" id="rmsa_user_new_password" placeholder="Enter New Password" required="">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="control-label col-sm-4 col-xs-12" for="rmsa_user_confirm_password">Confirm Password: </label>
                    <div class="col-sm-8 col-xs-12">
                        <input type="password" class="form-control" name="rmsa_user_confirm_password" id="rmsa_user_confirm_password" placeholder="Enter Confirm Password" required="">
                    </div>
                </div>
            </div>
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <input type="hidden" name="user_type" value="<?php echo $user_type; ?>">                                                                                   
                <div class="form-group">
                    <div class="row">
                        <script nonce='S51U26wMQz' type="text/javascript" src="https://www.google.com/recaptcha/api.js" async defer></script>
                        <script nonce='S51U26wMQz' type="text/javascript">function enableRegister() {
                                $("#btnRegister").removeClass('btn_disabled');
                                document.getElementById("btnRegister").disabled = false;
                            }</script>
                        <label class="control-label col-sm-4 col-xs-12" for="ptsp"></label>
                        <div class="col-sm-8 col-xs-12">
                            <div class="g-recaptcha" style="" data-sitekey="6LdnvCQUAAAAAGmHBukXVzjs5NupVLlaIHJdpFWo" data-callback="enableRegister"></div>
                        </div>
                    </div>
                </div>                                                              
                <div class="form-group">
                    <div class="m-auto text-center">    
                        <button type="submit" class="btn warning_btn btn_disabled"  disabled="true" id="btnRegister">Submit</button>
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