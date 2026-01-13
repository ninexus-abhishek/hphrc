<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <!--<meta http-equiv="Content-Security-Policy" content="script-src 'strict-dynamic' 'nonce-S51U26wMQz' 'unsafe-inline' http: https: https://www.gstatic.com https://csp.withgoogle.com https://www.google.com; object-src 'none'; base-uri 'none';">-->

    <title><?= $this->renderSection('title') ?></title>
 
    <link href="<?= base_url('assets/modules/bootstrap/css/bootstrap.min.css?v=5.2.3') ?>" rel="stylesheet" type="text/css" />
    
    <link href="<?= base_url('assets/modules/font-awesome/css/font-awesome.min.css?v=4.7.0') ?>" rel="stylesheet" type="text/css">
    <link href="<?= ('assets/admin/icheck/green.css') ?>" rel="stylesheet" type="text/css">

    <!-- PNotify -->
    <script nonce="<?= SCRIPT_NONCE ?>" src="<?= base_url('assets/modules/pnotify/js/PNotify.js') ?>" type="text/javascript"></script>
    <script nonce="<?= SCRIPT_NONCE ?>" src="<?= base_url('assets/modules/pnotify/js/PNotifyStyleMaterial.js') ?>" type="text/javascript"></script>
    <script nonce="<?= SCRIPT_NONCE ?>" src="<?= base_url('assets/modules/pnotify/js/PNotifyButtons.js') ?>" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/modules/pnotify/css/PNotifyBrightTheme.css') ?>" />
    <script nonce="<?= SCRIPT_NONCE ?>" src="<?= base_url('assets/modules/pnotify/js/PNotifyConfirm.js') ?>" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/modules/pnotify/css/animate.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/modules/pnotify/css/icon.css') ?>" />
    <link href="<?= base_url('assets/css/custom.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/modules/datatable/jquery.dataTables.min.css')?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/modules/DataTables/datatables.min.css') ?>" />
    
    <style>
        .navbar nav_title {
            border: 0 !important;
        }

        .modal-footer {
            border-top: 1px solid #0c97fe !important;
        }

        #modelboxstatus {
            color: #0c97fe !important;
        }
        label.form-label {
            color: #73879c;
            font-weight:700;
        }
    </style>
    <style>
        .download {
            color: blue !important;
        }
        .nav-sm .left_col{
            width: 70px;
            transition: width .5s,  transform 2s;

        }
        .nav-sm .right_col{
            width: calc(100% - 70px);
            transition: width .5s,  transform 2s;
        }
        .nav-md .left_col, .nav-md .right_col {
            transition: width .5s,  transform 2s;
            -webkit-transition:width .5s,  transform 2s;
        }
        .nav-sm footer{
            margin-left:72px !important;
        }
        .btn-xs{
            padding: 1px 5px;
            font-size: 12px;
            line-height: 1.5;
        }
        .table>thead{
            color: #37879c !important;
        }
        .table>tfoot{
            color:#37879c !important;
        }
        input#dt-search-0{
            border: 3px solid #000000;
        }
        select#dt-length-0 {
            border:3px solid #000000;
        }
        .dt-search{
            color:#000000 !important;
        }
        .dt-length{
            color : #000000 !important;
        }
        /* ul.pagination{
            margin-left:30% !important;
        } */
        @media only screen and (max-width: 600px) {
            .profile.clearfix{
                display:none;
            }
            .nav-md .col-2.left_col {
                display: none !important;
            }
            .nav-md div#right_col {
                width:100%;
            } 
            footer{
                margin-left:auto !important;
            }
            ul.pagination{
                margin-left:auto !important;
            }
        }
    </style>
</head>

<body class="<?= current_url(true)->getPath() === ltrim(route_to('admin.login'), '/') ? 'login' : 'nav-md' ?>">
    <?php if (current_url(true)->getPath() === ltrim(route_to('admin.login'), '/')): ?>
        <?= $this->renderSection('content') ?>
    <?php else: ?>
            <div class="container-fluid body">
                <div class="row">
                    <div class="col-2 left_col">
                        <div class="row">
                            <?= $this->include('partials/admin/navigation') ?>
                            <?= $this->include('partials/admin/sidebar') ?>
                        </div>
                    </div>
                        <div class="col-10 right_col" id="right_col" style="background-color:#f7f7f7; min-height:944px">
                            <div class="row g-0">
                            <?= $this->include('partials/admin/header') ?>
                            </div>  
                                <?= $this->renderSection('content') ?>  
                        </div>         
                </div>  
                   
                    <div id="ApprovedstatusModal" class="modal main_popup fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close press_no" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmation!</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to <strong id="modelboxstatus">Approved?</strong></p>
                                </div>
                                <div class="modal-footer"> <button type="button" class="btn btn-default press_no" data-dismiss="modal">No</button> <button type="button" class="btn btn-primary press_yes" data-id="0" data-value="none">Yes</button> </div>
                            </div>
                        </div>
                    </div>
            </div>
            <input class="ajax_csrfname" type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <?= $this->include('partials/admin/footer') ?>
    <?php endif; ?>
    

    <script src="<?= base_url('assets/modules/jquery/jquery.min.js?v=3.7.1') ?>" type="text/javascript" nonce="<?= SCRIPT_NONCE ?>"></script>
    <script src="<?= base_url('assets/modules/bootstrap/js/bootstrap.bundle.min.js') ?>" type="text/javascript" nonce="<?= SCRIPT_NONCE ?>"></script>

    <script nonce="<?= SCRIPT_NONCE ?>" src="<?= base_url('assets/js/admin/icheck/icheck.min.js') ?>" type="text/css"></script>
    <script type="text/javascript" nonce="<?= SCRIPT_NONCE ?>" src="<?= base_url('assets/modules/DataTables/datatables.min.js') ?>"></script>
     <script nonce="<?= SCRIPT_NONCE ?>" src="<?= base_url('assets/js/admin/customjs/custom.js') ?>" type="text/css"></script>
    <script nonce="<?= SCRIPT_NONCE ?>" type="text/javascript" src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript" nonce='S51U26wMQz'>
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
        var CURRENT_URL = window.location.href.split("#")[0].split("?")[0],
            $BODY = $("body"),
            $SIDEBAR_MENU = $("#sidebar-menu"),
            $SIDEBAR_FOOTER = $(".sidebar-footer"),
            $LEFT_COL = $(".left_col"),
            $RIGHT_COL = $(".right_col"),
            $NAV_MENU = $(".nav_menu"),
            $FOOTER = $("footer"),
            randNum = function() {
                return Math.floor(21 * Math.random()) + 20
            };
        const $MENU_TOGGLE = document.getElementById('menu_toggle');
            $MENU_TOGGLE.addEventListener('click', function() {
            console.log('clicked - menu toggle');
    

		if ($BODY.hasClass('nav-md')) {
			$SIDEBAR_MENU.find('li.active ul').hide();
			$SIDEBAR_MENU.find('li.active').addClass('active-sm').removeClass('active');
         
		} else {
			$SIDEBAR_MENU.find('li.active-sm ul').show();
			$SIDEBAR_MENU.find('li.active-sm').addClass('active').removeClass('active-sm');
          
		}

	$BODY.toggleClass('nav-md nav-sm');
});
    </script>
    
    <script nonce="<?= SCRIPT_NONCE ?>">
        document.addEventListener('DOMContentLoaded', () => {
            PNotify.defaults.styling = 'bootstrap4';
            PNotify.defaults.icons = 'fontawesome4';

            <?php if (!is_null(session()->getFlashdata('error'))) : ?>
                PNotify.error({
                    title: 'Error!',
                    text: '<?= session()->getFlashdata('error') ?>',
                });
            <?php endif; ?>

            <?php if (!is_null(session()->getFlashdata('success'))) : ?>
                PNotify.success({
                    title: 'Success!',
                    text: '<?= session()->getFlashdata('success') ?>',
                });
            <?php endif; ?>
        });
    </script>
    <script type="text/javascript" nonce="<?= SCRIPT_NONCE ?>">
        $(document).ready(function() {
            $(".mobileno").keyup(function(e) {
                var str = $(this).val();
                for (var i = 0; i < str.length; i++) {
                    var charCode = str.charAt(i).charCodeAt(0);
                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                        $(this).val('');
                        return false;
                    }
                }
                return true;
            });
        });
    </script>
    <?php if ($title == ADMIN_ADD_CAUSES_TITLE || $title == ADMIN_EDIT_CAUSES_TITLE) {
        ?>
        <script nonce='S51U26wMQz' type="text/javascript">
            $(document).ready(function () {
                $('#upload_file_type').on('change', function () {
                    
                    var category_code = $(this).val();
                
                    $.ajax({
                        type: "POST",
                        url: "<?php echo ADMIN_LOAD_SUB_CATEGORIES_LINK ?>",
                        data: {'category_code': category_code},
                        
                        success: function (data) {
                            console.log(data);
                            $("#upload_file_sub_type").empty();
                            $("#upload_file_sub_type").append(new Option('---Select---', ''));
                            $.each(data.sub_type, function (index, value) {
                                $("#upload_file_sub_type").append(new Option(value.category_title, value.category_code));
                            });                        
                        }
                    });
                });
            });
        </script>
    <?php } ?>
<?= $this->renderSection('scripts') ?>
</body>
</html>