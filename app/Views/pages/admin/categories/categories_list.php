<!-- page content -->
<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
    <?= $title ?>
<?= $this->endSection() ?>


<?= $this->section('styles') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/modules/DataTables/datatables.min.css') ?>" />

<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="">       
        <div class="clearfix"></div>
        <div class="row">            
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Main Category List</h2>
                        <a href="<?= base_url(route_to('admin.add_category')) ?>"><button type="button" data-toggle="tooltip" title="Add New Category" class="btn btn-info btn-sm" style="float: right"><i class="fa fa-plus">Add New</i></button></a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">                    					
                        <table id="example1" class="table table-striped table-bordered dt-responsive nowrap datatableEx" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Index</th>
                                    <th>Category Code</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <!--<th>Ref Category Code</th>-->
                                    <th>Status</th>                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Index</th>
                                    <th>Category Code</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <!--<th>Ref Category Code</th>-->
                                    <th>Status</th>                                    
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>					
                    </div>
                </div>
            </div>
        </div> 
         <div class="row">            
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Sub Category List</h2>
                        <a href="<?= base_url(route_to('admin.sub_category')) ?>"><button type="button" data-toggle="tooltip" title="Add New Sub Category" class="btn btn-info btn-sm" style="float: right"><i class="fa fa-plus">Add New</i></button></a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">                    					
                        <table id="example2" class="table table-striped table-bordered dt-responsive nowrap datatableEx order-column datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Index</th>
                                    <th>Category Code</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Ref Category Code</th>
                                    <th>Status</th>                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Index</th>
                                    <th>Category Code</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Ref Category Code</th>
                                    <th>Status</th>                                    
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>					
                    </div>
                </div>
            </div>
        </div> 
    </div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script type="text/javascript" nonce="<?= SCRIPT_NONCE ?>" src="<?= base_url('assets/modules/DataTables/datatables.min.js') ?>"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        new DataTable("#example1", {
            // responsive: true,
            columnDefs: [
                {
                    targets: [0],
                    orderable: false,
                    searchable: true,
                }
            ],
            order: [],
            rowGroup: false,
            processing: true,
            serverSide: false,
            pageLength: 10,
            paginationType: "full_numbers",
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            ajax: {
                type: "POST",
                url: "<?= base_url(route_to('admin.categories_list.param', "main")) ?>",
                data: {
                    "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
                },
            },
            columns: [
                {data: "index"},
                {data: "category_code"},
                {data: "category_title"},
                {data: "category_description"},
                {data: "category_status"},
                {data: "action"}
            ],
        });

        new DataTable("#example2", {
            // responsive: true,
            columnDefs: [
                {
                    targets: [0, 6],
                    orderable: false,
                    searchable: false,
                }
            ],
            order: [],
            rowGroup: false,
            processing: true,
            serverSide: false,
            pageLength: 10,
            paginationType: "full_numbers",
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            ajax: {
                type: "POST",
                url: "<?= base_url(route_to('admin.categories_list.param', "sub")) ?>",
                data: {
                    "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
                },
            },
            columns: [
                {data: "index"},
                {data: "category_code"},
                {data: "category_title"},
                {data: "category_description"},
                {data: "ref_category_code"},
                {data: "category_status"},
                {data: "action"}
            ],
        });
    })
    $(document).on('click', '.btn_approve_reject', function () {                    
        var self = $(this);
        var status = self.attr('data-status');
        var category_status = 'ACTIVE';

        if (status == 1) {
            category_status = 'REMOVED';
        }

        if (!confirm('Are you sure want to ' + category_status.toLocaleLowerCase() + ' category?'))
            return;

            self.attr('disabled', 'disabled');

        var data = {
            'category_code': self.data('id'),
            'category_status': category_status
        };

        $.ajax({
            type: "POST",
            url: "<?php echo ADMIN_CATEGORIES_ACTIVE_LINK ?>",
            data: data,
            success: function (res) {
                var data = res;
                $('.ajax_csrfname').val(data.token);
                if (data.suceess) {
                    var title = 'Click to deactivate category';
                    var class_ = 'btn_approve_reject btn btn-success btn-xs';
                    var text = 'Active';
                    var isactive = 1;

                    if (status == 1) {
                        title = 'Click to active category';
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