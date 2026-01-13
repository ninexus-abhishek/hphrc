<?php if (!isset($_SESSION['message'])) {
    $_SESSION['message'] = '';
} ?>
<script type="text/javascript" nonce='S51U26wMQz'>
    $(document).ready(function () {
        PNotify.defaults.styling = 'bootstrap4';
        PNotify.defaults.icons = 'fontawesome4';
        
        if (<?php if (isset($_SESSION['error'])) {echo $_SESSION['error'];} else {echo 0;} ?> === 1) {
            PNotify.error({
                title: 'Error!',
                text: '<?php echo $_SESSION['message']; ?>'
            });
            <?php $_SESSION['error'] = 0; ?>
        }
        
        if (<?php if (isset($_SESSION['success'])) {echo $_SESSION['success'];} else {echo 0;} ?> === 1) {
            PNotify.success({
                title: 'Success!',
                text: '<?php echo $_SESSION['message']; ?>'
            });
            <?php $_SESSION['success'] = 0; ?>
        }

        if (<?php if (isset($_SESSION['registration'])) {echo $_SESSION['registration'];} else {echo 0;}?> == 1) {
            PNotify.success({
                title: 'Success!',
                text: 'Registration success.'
            });
            PNotify.error({
                title: 'Failed!',
                text: 'Failed to deliver email. Please contact admin and share your email id.'
            });
        }
        if (<?php
        if (isset($_SESSION['registration'])) {echo $_SESSION['registration'];} else {echo 0;}?> == 2) {
            PNotify.success({
                title: 'Success!',
                text: 'Registration success. A verification email and login details have been sent. Check your email'
            });            
        }        
        if (<?php
        if (isset($_SESSION['registration'])) {echo $_SESSION['registration'];} else {echo 0;}?> == 3) {
            PNotify.error({
                title: 'Error!',
                text: 'Email allready exist'
            });
            <?php $_SESSION['registration'] = 0; ?>
        }        
        if (<?php if (isset($_SESSION['csrfInvalidToken'])) {echo $_SESSION['csrfInvalidToken'];} else {echo 0;}?> == 1) {            
            PNotify.error({
                title: 'Failed!',
                text: 'Invalid Token.'
            });
            <?php $_SESSION['csrfInvalidToken'] = 0; ?>
        }
        
        
        
        
         if (<?php
if (isset($_SESSION['forget_mail_sent'])) {
    echo $_SESSION['forget_mail_sent'];
}else{echo 0;}
?> == 1) {
 
                PNotify.success({
                    title: 'Success!',
                    text: 'Password reset Link sent on your email.'
                });
                
                <?php $_SESSION['forget_mail_sent'] = 0; ?>
            }        
        
                        if (<?php
if (isset($_SESSION['update_forget_password'])) {
    echo $_SESSION['update_forget_password'];
}else{echo 0;}
?> == 1) {                               
                PNotify.success({
                    title: 'Success!',
                    text: 'Password set successfully'
                });
                
                <?php $_SESSION['update_forget_password'] = 0; ?>
            } 
        
                             if (<?php
if (isset($_SESSION['forget_validity'])) {
    echo $_SESSION['forget_validity'];
}else{echo 0;}
?> == 1) {               
                PNotify.error({
                    title: 'Error!',
                    text: 'HPSHRC allowed per day only one request for forget password.'
                });                                
                <?php $_SESSION['forget_validity'] = 0; ?>
            } 
        
    });
</script>
