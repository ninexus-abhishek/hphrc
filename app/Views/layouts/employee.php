<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Softnio">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">

        <link rel="shortcut icon" href="<?= base_url('assets/images/employee/favicon.png') ?>">

        <title><?= $this->renderSection('title') ?></title>

        <link rel="stylesheet" href="<?= base_url('assets/css/employee/dashlite.css') ?>">
        <link id="skin-default" rel="stylesheet" href="<?= base_url('assets/css/employee/theme.css') ?>">
        <link href="<?= base_url('assets/css/employee/toastr.min.css') ?>" rel="stylesheet" type="text/css"/>

        <?= $this->renderSection('styles') ?>
        <style>
            .labelleft {
                float: right !important;
            }
            .assign-title {
                color: #0092db;
            }
        </style>
    </head>
    <body class="nk-body <?= current_url(true)->getPath() !== ltrim(route_to('emp.login'), '/') ? 'bg-lighter npc-default has-sidebar' : 'bg-white npc-general pg-auth'?>">
        <div class="nk-app-root">
            <div class="nk-main">
                <?php if (current_url(true)->getPath() !== ltrim(route_to('emp.login'), '/')): ?>
                    <?= $this->include('partials/employee/sidebar') ?>
                <?php endif; ?>
                <div class="nk-wrap">
                    <?php if (current_url(true)->getPath() !== ltrim(route_to('emp.login'), '/')): ?>
                        <?= $this->include('partials/employee/header') ?>
                    <?php endif; ?>
                    <?= $this->renderSection('content') ?>
                    <?php if (current_url(true)->getPath() !== ltrim(route_to('emp.login'), '/')): ?>
                        <?= $this->include('partials/employee/footer') ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <script src="<?= base_url('assets/js/employee/bundle.js') ?>"></script>
        <script src="<?= base_url('assets/js/employee/scripts.js') ?>"></script>
        <script src="<?= base_url('assets/js/employee/toastr.min.js') ?>" type="text/javascript"></script>

        <script nonce="<?= SCRIPT_NONCE ?>">
            document.addEventListener('DOMContentLoaded', () => {
                toastr.clear();
                toastr.options = { 
                    closeButton: true,
                    hideDuration: "3000",
                    extendedTimeOut : 500000,
                    tapToDismiss : true,
                    debug : false,
                    fadeOut: 10,
                    positionClass : "toast-top-right",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut"
                };

                <?php if (!is_null(session()->getFlashdata('error'))) : ?>
                    toastr.error('<?= session()->getFlashdata('error') ?>');
                <?php endif; ?>

                <?php if (!is_null(session()->getFlashdata('success'))) : ?>
                    toastr.success('<?= session()->getFlashdata('success') ?>');
                <?php endif; ?>
            });
        </script>
        <?= $this->renderSection('scripts') ?>
    </body>
</html>