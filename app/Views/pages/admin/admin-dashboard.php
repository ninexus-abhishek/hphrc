<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
    <?= $title ?>
<?= $this->endSection() ?>


<?= $this->section('styles') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/modules/DataTables/datatables.min.css') ?>" />
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="row">
        <div class="col-md-4">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-users" style="font-size: 30px;"></i></div>
                        <a class="count" href="#"><?php echo $totaluser['cnt']; ?></a>
                        <h3>Total Complainant's</h3>
                        <a href="#">Total active/inactive Complainant's</a>
                    </div>
        </div>
        <div class="col-md-4">
            <div class="tile-stats">
                        <div class="icon"><i class="fa fa-check-square" style="font-size: 30px;"></i></div>
                        <a class="count" href="#"><?php echo $totalactiveuser['cnt']; ?></a>
                        <h3>Active Complainant's</h3>
                        <a href="#">Total active Complainant's</a>
                    </div></div>
        <div class="col-md-4">
        <div class="tile-stats">
                        <div class="icon"><i class="fa fa-ban" style="font-size: 30px;"></i></div>
                        <a class="count" href="#"><?php echo $totalinactiveuser['cnt']; ?></a>
                        <h3>InActive Complainant's</h3>
                        <a href="#">Total inactive Complainant's</a>
                    </div>
        </div>
</div>
<div class="row">
   
        <div class="col-md-4"> 
            <div class="tile-stats">
                        <div class="icon"><i class="fa fa-file-text" style="font-size: 30px;"></i></div>
                        <a class="count" href="#"><?php echo $totalcases['cnt']; ?></a>
                        <h3>Total Cases</h3>
                        <a href="#">Total Cases</a>
                    </div>
        </div>
      
        <div class="col-md-4">
            <div class="tile-stats">
            <div class="icon">
                <i class="fa fa-file-text" style="font-size: 30px;"></i></div>
                <a class="count" href="#"><?php echo $totalopencases['cnt']; ?></a>
                    <h3>Total Open Cases</h3>
                    <p>&nbsp;</p>
            </div>
        </div>
        <div class="col-md-4">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-file-text" style="font-size: 30px;"></i></div>
                    <a class="count" href="#"><?php echo $totalclosedcases['cnt']; ?></a>
                    <h3>Total Closed Cases</h3> 
                    <p>&nbsp;</p>   
                </div>
        </div>
    
</div>  
</div>
       
                
   
    <!-- <div class="">
        <div class="row top_tiles">                              
            <a href="#"><div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                   
                </div>
            </a> 
            <a href="#"><div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    
                </div>
            </a>
            <a href="#"><div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                   
                </div>
            <a href="#"><div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    
                </div>
            </a>
            <a href="#"><div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                                               
                    </div>
                </div>
            </a>
            <a href="#"><div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    
                </div>
            </a>
   
    </div> -->

<?= $this->endSection() ?>