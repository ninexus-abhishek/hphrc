<div class="navbar nav_title">
    <a href="#" class="site_title"><i class="fa fa-paw"></i> <span>HPSHRC</span></a>
</div>
<div class="clearfix"></div>
<div class="profile clearfix">
    <div class="profile_pic mt-4">
        <a href="javascript::void(0)">
             <img src="<?= base_url('assets/images/default.png')?>" height="60px" alt="..." class="rounded-circle profile_img"></a>
    </div>
    <div class="profile_info  mt-1">
        <span>Welcome,</span>
        <a href="javascript::void(0)">
            <h2><?= ($_SESSION['admin']['user_firstname'] ?? '') . ' ' . ($_SESSION['admin']['user_lastname'] ?? ''); ?></h2>
        </a>
    </div>
</div>