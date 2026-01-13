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
                <?php if(! is_null(session()->getFlashdata('error'))): ?>
                    <div class="alert alert-danger alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?= esc(session()->getFlashdata("error")) ?>
                    </div>
                <?php endif; ?>
                <?php
                $attributes = ['class' => 'contact-form', 'id' => 'userlogin', 'name' => 'loginuser'];
                echo form_open(FRONT_LOGIN_LINK, $attributes);                
                ?>                                                                           
                <div class="form-group">
                    <div class="row"> 
                        <label class="control-label col-sm-4 col-xs-12" for="customer_email_password">Email/Username:</label>
                         <div class="col-sm-8 col-xs-12">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter your email address or username" autocomplete="off" value="<?= old('username') ?>">
                            <span class="text-danger"><?= esc($validation->getError('username')) ?></span>
                        </div>
                    </div>
                </div>          
                <div class="form-group">
                    <div class="row">
                        <label class="control-label col-sm-4 col-xs-12" for="password">Password:</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" autocomplete="off">
                            <span class="text-danger"><?= esc($validation->getError('password')) ?></span>
                        </div>
                    </div>
                </div>                                                
                <div class="form-group">                    
                    <div class="row">                        
                        <script nonce='S51U26wMQz' type="text/javascript" src="https://www.google.com/recaptcha/api.js" async defer></script>
                        <script nonce='S51U26wMQz' type="text/javascript">function enableRegister() {
                                $("#btnRegister").removeClass('btn_disabled');
                                document.getElementById("btnRegister").disabled = false;
                            }</script>
                        <label class="control-label col-sm-4 col-xs-12" for="ptsp"></label>
                        <div class="col-sm-8 col-xs-12">
                            <div class="g-recaptcha" data-sitekey="6LdnvCQUAAAAAGmHBukXVzjs5NupVLlaIHJdpFWo" data-callback="enableRegister"></div>
                        </div>
                    </div>
                </div>                                                              
                <div class="form-group">
                    <div class="m-auto text-center">    
                        <button type="submit" class="btn warning_btn btn_disabled"  disabled="true" id="btnRegister">Login</button>
                        <a href="<?php echo FORGET_PASSWORD_LINK.'customer'; ?>" class="btn btn-default">Foreget Password</a>
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