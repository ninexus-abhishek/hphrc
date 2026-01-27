<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>
    <?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<style>
    
</style>
<div class="page-heading text-center">
    <div class="container zoomIn animated">
        <h1 class="page-title">Downloads and Other Information <span class="title-under"></span></h1>
        <p class="page-description">
            Himachal Pradesh Human Rights Commission , Minister House No. 3, Grant Lodge, Shimla-171002, HP.
        </p>
    </div>
</div>

<div class="main-container">
    <div class="container">
        <!-- <div class="row">
            <div class="col-md-12 fadeIn animated">
                <p>
                    Documents avaliable for public download.
                </p>
            </div>
        </div> -->
        <div class="row ">
            <div class="col-md-12 fadeIn">
                <h2 class="title-style-2"> Cases List <span class="title-under"></span></h2>
                 <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Case No</th>
                            <th>Title</th>
                            <th>Priority</th>
                            <th>Assign to</th>                                            
                            <th>Status</th> 
                            <th>Hearing Date</th>
                            <th>Created Date</th> 
                            <th>Action</th>  
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th>Index</th>
                        <th>Case No</th>
                        <th>Title</th>
                        <th>Priority</th>
                        <th>Assign to</th>                                            
                        <th>Status</th> 
                        <th>Hearing Date</th>
                        <th>Created Date</th> 
                        <th>Action</th>  
                        </tr>
                    </tfoot>
                </table>
                <p></p>
            </div>
        </div>
    </div> 
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?php $currentCustomer = session('customer'); ?>
<script type="text/javascript" nonce="<?= SCRIPT_NONCE ?>" src="<?= base_url('assets/modules/DataTables/datatables.min.js') ?>"></script>
<script nonce="<?= SCRIPT_NONCE ?>" type="text/javascript">
    $('#example').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?= route_to('case.list') ?>",
            type: "POST",
            data: {
                "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
                customer_id: <?=  $currentCustomer['customer_id'] ?? 0 ?>
            }
        },
        columns: [
            { data: 'cases_id' },
            { data: 'cases_priority' },
            { data: 'case_no' },
            { data: 'cases_title' },
            { data: 'cases_assign_to' },
            { data: 'cases_status' },
            { data: 'cases_dt_created' },
            { data: 'employee_name' },
            { data: 'hearing_date' },
            { data: 'action', orderable: false, searchable: false }
        ]
    });
</script>
<?= $this->endSection() ?>