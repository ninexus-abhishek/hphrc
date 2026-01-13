<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
    <?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/modules/DataTables/datatables.min.css') ?>" />
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">            
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>File List</h2>
                        <a href="<?= base_url(route_to('admin.file_add')) ?>"><button type="button" data-toggle="tooltip" title="Add New Cause" class="btn btn-info btn-sm" style="float: right"><i class="fa fa-plus">Add New</i></button></a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">                    					
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap datatableEx" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Index</th>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>File Name</th>
                                    <th>Description</th>
                                    <th>Ref No</th>
                                    <th>Type</th>
                                    <th>Sub Type</th>                                    
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Index</th>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>File Name</th>
                                     <th>Description</th>
                                    <th>Ref No</th>
                                    <th>Type</th>
                                    <th>Sub Type</th>                                    
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>					
                    </div>
                </div>
            </div>
        </div> 
        <?= $this->endSection() ?>
<!-- /page content -->
<?= $this->section('scripts') ?>
<script type="text/javascript" nonce="<?= SCRIPT_NONCE ?>" src="<?= base_url('assets/modules/DataTables/datatables.min.js') ?>"></script>
<script>
    DataTable.defaults.responsive = true;
    document.addEventListener('DOMContentLoaded', () => {
        new DataTable("#example", {
            // responsive: true,
            columnDefs: [{
                targets: [0, 4, 9],
                orderable: false,
                searchable: false,
            }],
            order: [],
            rowGroup: false,
            processing: true,
            serverSide: true,
            pageLength: 10,
            paginationType: "full_numbers",
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            ajax: {
                type: "POST",
                url: "<?= base_url(route_to('admin.file_list')) ?>",
                data: {
                    "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
                },
            },
            columns: [
                {data: "index"},
                {data: "upload_file_id"},
                {data: "upload_file_title"},
                {data: "upload_file_original_name"},
                {data: "upload_file_desc"},
                {data: "upload_file_ref_no"},
                {data: "upload_file_type"},
                {data: "upload_file_sub_type"},
                {data: "upload_file_status"},
                {data: "action"}
            ],  
        });
    });
    $(document).on('click', '.btn_approve_reject', function () 
    {                  
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
              
        $.ajax
        ({
            type: "POST",
            url: "<?php echo ADMIN_FILES_ACTIVE_LINK ?>",
            data: data,
            success: function (res) 
            {
                var data = res;
                if (data.suceess) 
                {
                    var title = 'Click to deactivate causes';
                    var class_ = 'btn_approve_reject btn btn-success btn-xs';
                    var text = 'Active';
                    var isactive = 1;

                    if (status == 1) {
                        title = 'Click to active causes';
                        class_ = 'btn_approve_reject btn btn-danger btn-xs';
                        text = 'Removed';
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
</script>
<?= $this->endSection() ?>