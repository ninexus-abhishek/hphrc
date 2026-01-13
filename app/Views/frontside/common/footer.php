<footer class="main-footer">

    <div class="footer-top">

    </div>


    <div class="footer-main">
        <div class="container">

            <div class="row">
                <div class="col-md-4">

                    <div class="footer-col">

                        <h4 class="footer-title">About us <span class="title-under"></span></h4>

                        <div class="footer-content">

                            <p>
                                <strong>HPSHRC</strong> - Himachal Pradesh Human Rights Commission , Minister House No. 3, Grant Lodge, Shimla-171002, HP.
                            </p> 

                            <p>
                                In Accordance with the provisions of The Protection of Human Rights Act,1993
                            </p>

                        </div>

                    </div>

                </div>
<!--
                <div class="col-md-4">

                    <div class="footer-col">

                        <h4 class="footer-title">LAST TWEETS <span class="title-under"></span></h4>

                        <div class="footer-content">
                            <ul class="tweets list-unstyled">
                                <li class="tweet"> 

                                    ------------------------------------

                                </li>

                                <li class="tweet"> 

                                    ------------------------------------

                                </li>

                                <li class="tweet"> 

                                    ------------------------------------

                                </li>

                            </ul>
                        </div>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="footer-col">

                        <h4 class="footer-title">Contact us <span class="title-under"></span></h4>

                        <div class="footer-content">

                            <div class="footer-form">

                                <div class="footer-form" >

                                    <form action="php/mail.php" class="ajax-form form-horizontal contact_form_footer" id="contact_form_footer">

                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                                        </div>

                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                                        </div>

                                        <div class="form-group">
                                            <textarea name="message" class="form-control" placeholder="Message" required></textarea>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-submit pull-right">Send message</button>
                                        </div>

                                    </form>

                                </div>

                            </div>
                        </div>

                    </div>

                </div>
-->
                <div class="clearfix"></div>



            </div>


        </div>


    </div>

    <div class="footer-bottom">

        <div class="container text-right">
            HPSHRC @ copyrights 2020 |  Designed and Maintained by - <a href="https://hpie.in" target="_blank">H.P.I.E</a>
        </div>
    </div>

</footer> <!-- main-footer -->




<!-- Donate Modal -->
<!--
<div class="modal fade" id="donateModal" tabindex="-1" role="dialog" aria-labelledby="donateModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="donateModalLabel">DONATE NOW</h4>
            </div>
            <div class="modal-body">

                <form class="form-donation">

                    <h3 class="title-style-1 text-center">Thank you for your donation <span class="title-under"></span>  </h3>

                    <div class="row">

                        <div class="form-group col-md-12 ">
                            <input type="text" class="form-control" id="amount" placeholder="AMOUNT(€)">
                        </div>

                    </div>


                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="firstName" placeholder="First name*">
                        </div>

                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="lastName" placeholder="Last name*">
                        </div>
                    </div>


                    <div class="row">

                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="email" placeholder="Email*">
                        </div>

                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="phone" placeholder="Phone">
                        </div>

                    </div>

                    <div class="row">

                        <div class="form-group col-md-12">
                            <input type="text" class="form-control" name="address" placeholder="Address">
                        </div>

                    </div>


                    <div class="row">

                        <div class="form-group col-md-12">
                            <textarea cols="30" rows="4" class="form-control" name="note" placeholder="Additional note"></textarea>
                        </div>

                    </div>

                    <div class="row">

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary pull-right" name="donateNow" >DONATE NOW</button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>

</div> --> <!-- /.modal -->

<!--  Scripts
================================================== -->
<input class="ajax_csrfname" type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" /> 
<!-- jQuery -->
<script src="<?php echo CENTRAL_ASSETS_FOLDER; ?>jquery/jquery.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
<script src="<?php echo CENTRAL_ASSETS_FOLDER; ?>bootstrap/bootstrap.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
<script nonce="S51U26wMQz">window.jQuery || document.write('');</script>
<!-- Bootsrap javascript file -->
<!-- Datatables -->
<script nonce='S51U26wMQz' src="<?php echo CENTRAL_ASSETS_FOLDER; ?>datatable/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo CENTRAL_ASSETS_FOLDER; ?>datatable/dataTables.responsive.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
<script nonce='S51U26wMQz' src="<?php echo CENTRAL_ASSETS_FOLDER; ?>bootstrap/bootstrapValidator.min.js" type="text/javascript"></script>

<!-- owl carouseljavascript file -->
<script type="text/javascript" nonce='S51U26wMQz' src="<?php echo FRONT_ASSETS_FOLDER; ?>js/owl.carousel.min.js"></script>

<!-- Template main javascript -->
<script type="text/javascript" nonce='S51U26wMQz' src="<?php echo FRONT_ASSETS_FOLDER; ?>js/main.js"></script>
<script type="text/javascript" nonce='S51U26wMQz' src="<?php echo BASE_URL; ?>/assets/front/js/jquery.prettyPhoto.js"></script>

<link type="text/css" href="<?php echo FRONT_ASSETS_FOLDER; ?>css/summernote.min.css" rel="stylesheet">
<script type="text/javascript" nonce='S51U26wMQz' src="<?php echo FRONT_ASSETS_FOLDER; ?>js/summernote.min.js"></script>
<?php include(APPPATH . "Views/frontside/common/notify.php"); ?>
<script>
      $('#summernote').summernote({
         tabsize: 2,
          height: 120,
          toolbar: [['style', ['style']], ['font', ['bold', 'underline', 'strikethrough', 'clear']], ['font', ['superscript', 'subscript']], ['color', ['color']], ['fontsize', ['fontsize', 'height']], ['para', ['ul', 'ol', 'paragraph']], ['view', ['fullscreen']]]
      });
</script>
<script type="text/javascript" nonce='S51U26wMQz'>
   $(document).ready(function () {   
    $(".mobileno").keyup(function (e) {
            var str=$(this).val();
            for (var i = 0; i < str.length; i++) {
                var charCode=str.charAt(i).charCodeAt(0);                  
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                {                                    
                    $(this).val('');
                    return false;
                }                                       
            }               
            return true;
        });
    });
</script>


<?php if ($title == CHANGE_FORGET_PASSWORD_TITLE) {
    ?>
    <script nonce='S51U26wMQz' type="text/javascript">
        $(document).ready(function () {
            $('#frm_change_password').bootstrapValidator({
                // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    rmsa_user_new_password: {
                        validators: {
                            stringLength: {
                                min: 8
                            },
                            identical: {
                                field: 'rmsa_user_confirm_password',
                                message: 'The password and its confirm are not the same'
                            },
                            notEmpty: {
                                message: 'Please supply your new password'
                            }
                        }
                    },
                    rmsa_user_confirm_password: {
                        validators: {
                            stringLength: {
                                min: 8
                            },
                            identical: {
                                field: 'rmsa_user_new_password',
                                message: 'The password and its confirm are not the same'
                            },
                            notEmpty: {
                                message: 'Please supply your confirm password'
                            }
                        }
                    }
                }
            }).on('success.form.bv', function (e) {
                $('#success_message').slideDown({opacity: "show"}, "slow"); // Do something ...
                $('#frm_change_password').data('bootstrapValidator').resetForm();

                // Prevent form submission
                e.preventDefault();

                // Get the form instance
                var $form = $(e.target);

                // Get the BootstrapValidator instance
                var bv = $form.data('bootstrapValidator');

                // Use Ajax to submit form data
                $.post($form.attr('action'), $form.serialize(), function (result) {
                    if (result['success'] === "success") {
                        window.location.href = "<?php echo BASE_URL; ?>";
                    }                   
                }, 'json');
            });
        });
    </script>
<?php } ?>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script nonce="S51U26wMQz">
    (function (b, o, i, l, e, r) {
        b.GoogleAnalyticsObject = l;
        b[l] || (b[l] =
                function () {
                    (b[l].q = b[l].q || []).push(arguments);
                });
        b[l].l = +new Date;
        e = o.createElement(i);
        r = o.getElementsByTagName(i)[0];
        e.src = '//www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e, r);
    }(window, document, 'script', 'ga'));
    ga('create', 'UA-XXXXX-X');
    ga('send', 'pageview');
</script>

<?php include(APPPATH . "Views/adminside/common/notify.php"); ?>   
<script nonce='S51U26wMQz' type="text/javascript">
    $(document).ready(function () {
        $('.contact_form_footer').bootstrapValidator({
            // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                name: {
                    validators: {
                        stringLength: {
                            max: 50
                        },
                        notEmpty: {
                            message: 'Please Enter Title'
                        },
                        regexp: {
                            regexp: /^[^~!#%^_,.*|\":<>[\]{}`\\()';@&/$]+$/,
                            message: 'Special character not allowed'
                        }
                    }
                },
                email: {
                    validators: {
                        emailAddress: {
                            message: 'The value is not a valid email address'
                        }
                    }
                },
                message: {
                        validators: {
                            stringLength: {
                                max: 500
                            },
                            notEmpty: {
                                message: 'Please Enter Descriptipn'
                            },
                            regexp: {
                                regexp: /^[^~#%^_*|\<>[\]{}`\\();/$]+$/,
                                message: 'Special character not allowed'
                            }                            
                        }
                    }
            }
        });
    });
</script>

<?php if ($title == FRONT_BUDGET_TITLE) {
    ?> 
    <script nonce='S51U26wMQz' type="text/javascript">
        $(document).ready(function () {          
            $( "#budget_year" ).change(function() {              
                var years=$(this).val();
                var url="<?php echo FRONT_BUDGET_LINK; ?>"+years;
//                alert(url);
                window.location = url;
            });
        });
        </script>
<?php } ?>

        
<?php if ($title == FRONT_UPDATE_PROFILE_TITLE) {
    ?>
    <script nonce='S51U26wMQz' type="text/javascript">
        $(document).ready(function () {
            
            $.fn.bootstrapValidator.validators.securePassword = {
        validate: function(validator, $field, options) {
            var value = $field.val();
            if (value === '') {
                return true;
            }

            // Check the password strength
            if (value.length < 8) {
                return {
                    valid: false,
                    message: 'The password must be more than 8 characters long'
                };
            }
            
            if (value.length > 20) {
                return {
                    valid: false,
                    message: 'The password must be less than 20 characters'
                };
            }

            // The password doesn't contain any uppercase character
            if (value === value.toLowerCase()) {
                return {
                    valid: false,
                    message: 'The password must contain at least one upper case character'
                };
            }

            // The password doesn't contain any uppercase character
            if (value === value.toUpperCase()) {
                return {
                    valid: false,
                    message: 'The password must contain at least one lower case character'
                };
            }

            // The password doesn't contain any digit
            if (value.search(/[0-9]/) < 0) {
                return {
                    valid: false,
                    message: 'The password must contain at least one digit'
                };
            }

            return true;
        }
    };                        
            $('#frm_change_password').bootstrapValidator({
                // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    user_new_password: {
                        validators: {                           
                            identical: {
                                field: 'user_confirm_password',
                                message: 'The password and its confirm are not the same'
                            },
                            securePassword: {
                                message: 'The password is not valid'
                            },
                            notEmpty: {
                                message: 'Please supply your new password'
                            }
                        }
                    },
                    user_confirm_password: {
                        validators: {                            
                            identical: {
                                field: 'user_new_password',
                                message: 'The password and its confirm are not the same'
                            },
                            securePassword: {
                                message: 'The password is not valid'
                            },
                            notEmpty: {
                                message: 'Please supply your confirm password'
                            }
                        }
                    }
                }
            }).on('success.form.bv', function (e) {
                $('#success_message').slideDown({opacity: "show"}, "slow"); // Do something ...
                $('#frm_change_password').data('bootstrapValidator').resetForm();

                // Prevent form submission
                e.preventDefault();

                // Get the form instance
                var $form = $(e.target);

                // Get the BootstrapValidator instance
                var bv = $form.data('bootstrapValidator');

                // Use Ajax to submit form data
                $.post($form.attr('action'), $form.serialize(), function (result) {
                    if (result['success'] == "success") {
                        location.href = "<?php echo FRONT_UPDATE_PROFILE_LINK; ?>";
                    }
                    if (result['success'] == "fail") {
                        PNotify.error({
                            title: 'Error!',
                            text: 'Old password not match'
                        });
                    }
//                    $('.txt_csrfname').val(result['token']);
                }, 'json');
            });
        });
    </script>
<?php } ?>        
        
<?php if ($title == FRONT_VIEW_CASES_TITLE) {
    ?> 
    <script nonce='S51U26wMQz' type="text/javascript">
        $(document).ready(function () {  
          
        $("#add_comment").on('submit', function(e){                                    
        var fileUpload = document.getElementById('case_files_file');
        if (parseInt(fileUpload.files.length)>3){            
            PNotify.error({
                title: 'Failed!',
                text: 'You can only upload a maximum of 3 files.'
            });
            return false;
        }        
        var comment = $("#summernote").val();
        if (comment===''){ 
            PNotify.error({
                title: 'Failed!',
                text: 'Plz add description in comment'
            });           
            return false;
        }
        
        for (var i = 0; i <= fileUpload.files.length - 1; i++) {
            if (fileUpload.files.item(i).size > 2097152) {
                PNotify.error({
                title: 'Failed!',
                text: 'Try to upload all files less than 2MB!'
            });                                        
                return false;
            }
        }                               
        if(confirm("Confirm before submit")) {    
            e.preventDefault();
            var last_comment_id=$( ".lastcomment" ).first().data("value");
            var form_data = new FormData(this);
            form_data.append('last_comment_id', last_comment_id);
            $.ajax({
                type: 'POST',
                url: '<?= route_to("front.add.comment") ?>',
                data: form_data,
                contentType: false,
                cache: false,
                processData:false,           
                success: function(res){
                    var res = $.parseJSON(res);
    //                $('.ajax_csrfname').val(res.token);
                    if(res.message==="success"){                         
                        $( ".lastcomment" ).first().before( res.comments );                                                
                        $('#summernote').summernote("code",'');
                        $('#comments').scrollTop(0);
                        
                        PNotify.success({
                            title: 'Success!',
                            text: 'Comment sent successfully'
                        }); 
                        
                    }
                }        
            });
        }
        else{
            return false;
        }
    });                      
        $('#example').DataTable({
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            searching: false,
            paging: false,
            bInfo: false                                                     
        });
           
    });
    </script>
<?php } ?>
<?php if ($title == REQUEST_CASES_TITLE) {
    ?>
    <script nonce='S51U26wMQz' type="text/javascript">
        const handleHowToContact = () => {
            const inputField = document.getElementById('howtocontact');
            const howtocontact = inputField.value;
            if (howtocontact=='Email') {
                $(".howtocontact_email").removeClass("howtocontact");
                $("#customer_email").val("");
                $("#customer_contact").val("");
                $(".howtocontact_mobile").addClass("howtocontact");
            } else if(howtocontact=='Mobile') {
                $(".howtocontact_mobile").removeClass("howtocontact");
                $("#customer_contact").val("");
                $("#customer_email").val("");
                $(".howtocontact_email").addClass("howtocontact");
            } else if(howtocontact=='Both') {
                $(".howtocontact_email").removeClass("howtocontact");
                $(".howtocontact_mobile").removeClass("howtocontact");
                $("#customer_email").val("");
                $("#customer_contact").val("");
            } else {
                $("#customer_email").val("");
                $("#customer_contact").val("");
                $(".howtocontact_email").addClass("howtocontact");
                $(".howtocontact_mobile").addClass("howtocontact");
            }
        };

        $(document).ready(function () {    
            handleHowToContact();
       
            $("#case_files_file").on("change", function(){
                $('.case_files_file_title_desc').remove();                  
                var numFiles = $(this)[0].files.length;
                var i;
                var text='';
                for (i = 1; i <= numFiles; i++) {                   
                  text +="<div class='form-group case_files_file_title_desc'><div class='row'><label class='control-label col-sm-4 col-xs-12' for='title_file'>Title: ["+$(this)[0].files.item(i-1).name.substr(0,30)+" ] </label><div class='col-sm-8 col-xs-12'><input type='text' class='form-control' name='title_file[]' placeholder='Enter "+$(this)[0].files.item(i-1).name.substr(0,30)+" title' autocomplete='off' required></div></div></div>";
                  text +="<div class='form-group case_files_file_title_desc'><div class='row'><label class='control-label col-sm-4 col-xs-12' for='desc_file'>Description: ["+$(this)[0].files.item(i-1).name.substr(0,30)+" ] </label><div class='col-sm-8 col-xs-12'><textarea class='form-control' name='desc_file[]' placeholder='Enter "+$(this)[0].files.item(i-1).name.substr(0,30)+" description'></textarea></div></div></div>"
                }
                $( ".case_files_file_div" ).after(text);
            });

            $('#howtocontact').on('change', function () {
                handleHowToContact();
            });
            $('#add_cases').bootstrapValidator({
                // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    case_files_file: {
                        validators: {
                            file: {
                                extension: 'jpeg,png,jpg,pdf',
                                type: 'image/jpeg,image/png,image/jpg,application/pdf',                                
                                message: 'The selected file is not valid'
                            },
                            notEmpty: {
                                message: 'Please select profile image'
                            }
                        }
                    },
                    customer_email: {
                        validators: {                            
                            emailAddress: {
                                message: 'Please supply a valid email address'
                            },
                            notEmpty: {
                                message: 'Please enter valid email address'
                            }
                        }
                    },
                    customer_contact: {
                        validators: {
                            stringLength: {
                                min: 10,
                                max: 10
                            },
                            notEmpty: {
                                message: 'Please enter valid mobile number'
                            }
                        }
                    },
                    cases_title: {
                        validators: {
                            stringLength: {
                                min: 2
                            },
                            notEmpty: {
                                message: 'Please Enter Title'
                            }
                        }
                    },
                    cases_party_name: {
                        validators: {
                            stringLength: {
                                min: 2
                            },
                            notEmpty: {
                                message: 'Please Enter Party Name'
                            }
                        }
                    },
                     howtocontact: {
                        validators: {                           
                            notEmpty: {
                                message: 'Please Enter Title'
                            }
                        }
                    }
                }
            });
        });
    </script>
<?php } ?>  

<?php if ($title == FRONT_LIST_CASES_TITLE) {
    ?> 
    <script nonce='S51U26wMQz' type="text/javascript">
        $(document).ready(function () {           
            fill_datatable1();
            function fill_datatable1()
            {
                $('#example').DataTable({
                    responsive: {
                        details: {
                            type: 'column',
                            target: 'tr'
                        }
                    },

                    columnDefs: [{
                            className: 'control',
                            orderable: false,
                            targets: 0
                        }],
                    "processing": true,
                    "serverSide": true,
                    "pageLength": 10,
                    "paginationType": "full_numbers",
                    "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
                    "ajax": {
                        'type': 'POST',
                        'url': "<?php echo BASE_URL . '/DataTablesSrc-master/front_cases_list.php' ?>",
                        'data': {
                            customer_id: <?php
    if (isset($_SESSION['customer']['customer_id'])) {
        echo $_SESSION['customer']['customer_id'];
    }else{echo 0;}
    ?>
                        }
                    },
                    "columns": [
                        {"data": "index"},
                        {"data": "case_no"},
                        {"data": "cases_title"},
                        {"data": "cases_priority"},
                        {"data": "employee_name"},
                        {"data": "cases_status"},
                        {"data": "hearing_date"},
                        {"data": "cases_dt_created"},
                        {"data": "action"}
                    ]
                });
            }
        });
    </script>
<?php } ?>     
    
<?php if ($title == FRONT_DOWNLOAD_TITLE) {
    ?> 
    <script nonce='S51U26wMQz' type="text/javascript">
        $(document).ready(function () {
    <?php
    if (isset($file_type)) {
        if (!empty($file_type)) {
            $i = 0;
            foreach ($file_type as $ftrow) {
                ?>
                        fill_datatable1("example<?php echo $i; ?>", "<?php echo $ftrow['category_code']; ?>");
                <?php
                $i = $i + 1;
            }
        }
    }
    ?>

            function fill_datatable1(str, category_code)
            {
                $('#' + str).DataTable({
                    responsive: {
                        details: {
                            type: 'column',
                            target: 'tr'
                        }
                    },
                    columnDefs: [{
                            className: 'control',
                            orderable: false,
                            targets: 0
                        }],
                    "processing": true,
                    "serverSide": true,
                    "pageLength": 10,
                    "paginationType": "full_numbers",
                    "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
                    "ajax": {
                        'type': 'POST',
                        'url': "<?php echo BASE_URL . '/DataTablesSrc-master/file_list_download.php' ?>",
                        'data': {
                            category_code: category_code
                        }
                    },
                    "columns": [
                        {"data": "index"},
                        {"data": "upload_file_ref_no"},
                        {"data": "upload_file_title"},
                        {"data": "category_title_sub"},
                        {"data": "upload_file_desc"},
                        {"data": "download"}
                    ]
                });
            }

            $(document).on('click', '.btn_approve_reject', function () {
                var self = $(this);

                var status = self.attr('data-status');

                var upload_file_status = 'ACTIVE';

                if (status == 1) {
                    upload_file_status = 'REMOVED';
                }

                if (!confirm('Are you sure want to ' + upload_file_status.toLocaleLowerCase() + ' causes?'))
                    return;

                self.attr('disabled', 'disabled');

                var data = {
                    'upload_file_id': self.data('id'),
                    'upload_file_status': upload_file_status
                };

                $.ajax({
                    type: "POST",
                    url: "<?php echo ADMIN_FILES_ACTIVE_LINK ?>",
                    data: data,
                    success: function (res) {

                        var res = $.parseJSON(res);
                        if (res.suceess) {

                            var title = 'Click to deactivate causes';
                            var class_ = 'btn_approve_reject btn btn-success btn-xs';
                            var text = 'Active';
                            var isactive = 1;

                            if (status == 1) {
                                title = 'Click to active causes';
                                class_ = 'btn_approve_reject btn btn-danger btn-xs';
                                text = 'Inactive';
                                isactive = 0;
                            }

                            self.removeClass().addClass(class_);
                            self.attr({
                                'data-status': isactive,
                                'title': title
                            });

                            self.removeAttr('disabled');
                            self.html(text);
                        }
                    }
                });
            });

        });

    </script>
<?php } ?>  
    
    
    <?php if ($title == CUSTOMER_REGISTRATION_TITLE) {
    ?>
    <script nonce='S51U26wMQz' type="text/javascript">

        $(document).ready(function () {            
            
        $.fn.bootstrapValidator.validators.securePassword = {
        validate: function(validator, $field, options) {
            var value = $field.val();
            if (value === '') {
                return true;
            }

            // Check the password strength
            if (value.length < 8) {
                return {
                    valid: false,
                    message: 'The password must be more than 8 characters long'
                };
            }
            
            if (value.length > 20) {
                return {
                    valid: false,
                    message: 'The password must be less than 20 characters'
                };
            }

            // The password doesn't contain any uppercase character
            if (value === value.toLowerCase()) {
                return {
                    valid: false,
                    message: 'The password must contain at least one upper case character'
                };
            }

            // The password doesn't contain any uppercase character
            if (value === value.toUpperCase()) {
                return {
                    valid: false,
                    message: 'The password must contain at least one lower case character'
                };
            }

            // The password doesn't contain any digit
            if (value.search(/[0-9]/) < 0) {
                return {
                    valid: false,
                    message: 'The password must contain at least one digit'
                };
            }

            return true;
        }
    };
    
            $('#student_register').bootstrapValidator({
                // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {                                                           
                    customer_first_name: {
                        validators: {
                            stringLength: {
                                min: 2
                            },
                            notEmpty: {
                                message: 'Please supply your first name'
                            },
                            regexp: {
                                regexp: /^[^*|\":<>[\]{}`\\()';@&/$]+$/,
                                message: 'Special character not allowed'
                            }
                        }
                    },                    
//                    customer_middle_name: {
//                        validators: {
//                            regexp: {
//                                regexp: /^[^*|\":<>[\]{}`\\()';@&/$]+$/,
//                                message: 'Special character not allowed'
//                            }
//                            
//                        }
//                    },                    
                    customer_last_name: {
                        validators: {
                             stringLength: {
                                min: 2
                            },
                            notEmpty: {
                                message: 'Please supply your last name'
                            },
                            regexp: {
                                regexp: /^[^*|\":<>[\]{}`\\()';@&/$]+$/,
                                message: 'Special character not allowed'
                            }
                        }
                    },
                    customer_father_name: {
                        validators: {
                            regexp: {
                                regexp: /^[^*|\":<>[\]{}`\\()';@&/$]+$/,
                                message: 'Special character not allowed'
                            }
                            
                        }
                    },
                    customer_mobile_no: {
                        validators: {
                            stringLength: {
                                min: 10,
                                max:10
                            }
                        }
                    },  
                    customer_email_id: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply your email address'
                            },
                            emailAddress: {
                                message: 'Please supply a valid email address'
                            }
                        }
                    },
                    customer_email_password: {
                        validators: {                           
                            identical: {
                                field: 'user_confirm_password',
                                message: 'The password and its confirm are not the same'
                            },
                            securePassword: {
                                message: 'The password is not valid'
                            },
                            notEmpty: {
                                message: 'Please supply your new password'
                            }
                        }
                    },
                    user_confirm_password: {
                        validators: {
                            stringLength: {
                                min: 8
                            },
                            identical: {
                                field: 'customer_email_password',
                                message: 'The password and its confirm are not the same'
                            },
                            securePassword: {
                                message: 'The password is not valid'
                            },
                            notEmpty: {
                                message: 'Please supply your confirm password'
                            }
                        }
                    },
                    customer_dob: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply your date of birth'
                            }
                        }
                    }
                }
            }); 
        });
    </script>
<?php }
?>
</body>
</html>
