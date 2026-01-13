<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Human Right Commission Shimla Himachal Pradesh">
    <meta name="keywords" content="hphrc,human right,human right commission,human right commission shimla,human right himachal,human right commission himachal,humanright,humanrightcommission,humanrightcommissionshimla,humanrights,humanrightscommissionshimla,state human rights commission, himachal pradesh human rights commission, himachal pradesh human rights commission shimla, human rights commission, himachal pradesh state human rights commission shimla, hphrc shimla, hphrc himachal pradesh, human rights shimla, human rights himachal pradesh">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <title><?= $this->renderSection('title') ?></title>

    <link rel='icon' href="<?= base_url('assets/images/favico/favicon.ico') ?>" type="image/x-icon">
    <script src=<?= env('sso.hp.iframe') ?> defer></script>


    <?php // Bootsrap v5.2.3
    ?>
    <link href="<?= base_url('assets/modules/bootstrap/css/bootstrap.min.css?v=5.2.3') ?>" rel="stylesheet" type="text/css" />
    <?php // Font awesome 
    ?>
    <link href="<?= base_url('assets/modules/font-awesome/css/font-awesome.min.css?v=4.7.0') ?>" rel="stylesheet" type="text/css">

    <?php // Owl carousel 
    ?>
    <link rel="stylesheet" href="<?= base_url('assets/modules/owl-carousel/css/owl.carousel.css') ?>" type="text/css">
    <link href="<?= base_url('assets/modules/prettyPhoto/css/prettyPhoto.css') ?>" rel="stylesheet" type="text/css" />
    <?php // Template main Css 
    ?>
    <!-- <link rel="stylesheet" href="<?= base_url('assets/css/style.legacy.css') ?>" type="text/css"> -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css') ?>">

    <?php // Modernizr 
    ?>
    <script nonce="<?= SCRIPT_NONCE ?>" src="<?= base_url('assets/modules/modernizr/modernizr-2.6.2.min.js') ?>" type="text/javascript"></script>

    <script nonce="<?= SCRIPT_NONCE ?>" src="<?= base_url('assets/modules/pnotify/js/PNotify.js') ?>" type="text/javascript"></script>
    <script nonce="<?= SCRIPT_NONCE ?>" src="<?= base_url('assets/modules/pnotify/js/PNotifyStyleMaterial.js') ?>" type="text/javascript"></script>
    <script nonce="<?= SCRIPT_NONCE ?>" src="<?= base_url('assets/modules/pnotify/js/PNotifyButtons.js') ?>" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/modules/pnotify/css/PNotifyBrightTheme.css') ?>" />
    <script nonce="<?= SCRIPT_NONCE ?>" src="<?= base_url('assets/modules/pnotify/js/PNotifyConfirm.js') ?>" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/modules/pnotify/css/animate.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/modules/pnotify/css/icon.css') ?>" />

    <?= $this->renderSection('styles') ?>
    <style>
        .download {
            color: blue !important;
        }
    </style>
</head>

<body>
    <?= $this->include('partials/front/header') ?>
    <?= $this->renderSection('content') ?>
    <?= $this->include('partials/front/footer') ?>

    <script src="<?= base_url('assets/modules/jquery/jquery.min.js?v=3.7.1') ?>" type="text/javascript" nonce="<?= SCRIPT_NONCE ?>"></script>
    <script src="<?= base_url('assets/modules/bootstrap/js/bootstrap.bundle.min.js') ?>" type="text/javascript" nonce="<?= SCRIPT_NONCE ?>"></script>

    <?php // owl carouseljavascript file 
    ?>
    <script type="text/javascript" nonce="<?= SCRIPT_NONCE ?>" src="<?= base_url('assets/modules/owl-carousel/js/owl.carousel.min.js') ?>"></script>

    <!-- Template main javascript -->
    <script type="text/javascript" nonce="<?= SCRIPT_NONCE ?>" src="<?= base_url('assets/js/main.js') ?>"></script>
    <script type="text/javascript" nonce="<?= SCRIPT_NONCE ?>" src="<?= base_url('assets/modules/prettyPhoto/js/jquery.prettyPhoto.js') ?>"></script>

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

    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script nonce="<?= SCRIPT_NONCE ?>">
        (function(b, o, i, l, e, r) {
            b.GoogleAnalyticsObject = l;
            b[l] || (b[l] =
                function() {
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

    <?= $this->renderSection('scripts') ?>
</body>

</html>