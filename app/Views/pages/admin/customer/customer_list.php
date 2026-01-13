<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
    <?= $title ?>
<?= $this->endSection() ?>


<?= $this->section('styles') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/modules/DataTables/datatables.min.css') ?>" />
<style>
.custom-column-class{
    white-space: normal;
    display: flex;
}
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">            
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Complainant List</h2>
                        <!-- <a href="<//?php echo ADMIN_CUSTOMER_REGISTER_LINK; ?>"><button type="button" data-toggle="tooltip" title="Add New Complainant" class="btn btn-info btn-sm" style="float: right"><i class="fa fa-plus">Add New</i></button></a> -->
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">                    					
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap datatableEx" style="width:100%">
                            <thead>
                                <tr>                                            
                                    <th>Index</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>                                            
                                    <th>Father Name</th>                                            
                                    <th>Gender</th>
                                    <th>DOB</th>
                                    <th>Mobile</th>
                                    <th>Email</th>                                                                                        
                                    <th>Action</th>                                          
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Index</th>                                           
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>                                            
                                    <th>Father Name</th>
                                    <th>Gender</th>
                                    <th>DOB</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Action</th> 
                                </tr>
                            </tfoot>
                        </table>					
                    </div>
                </div>
            </div>
        </div> 
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script type="text/javascript" nonce="<?= SCRIPT_NONCE ?>" src="<?= base_url('assets/modules/DataTables/datatables.min.js') ?>"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        console.log('hello');
        new DataTable("#example", {
        columnDefs: [
            {
                targets: [0, 9],
                orderable: false,
                searchable: false,
            },
            {
                targets: 9,
                className : 'custom-column-class'
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
            url: "<?= base_url(route_to('admin.customer_list')) ?>",
            data: {
                "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
            },
        },
        columns: [
            {data: "index"},
            {data: "customer_first_name"},
            {data: "customer_middle_name"},
            {data: "customer_last_name"},
            {data: "customer_father_name"},
            {data: "customer_gender"},
            {data: "customer_dob"},
            {data: "customer_mobile_no"},
            {data: "customer_email_id"},
            {data: "action"}
        ],
    });
    })
    $(document).on('click', '.btn_approve_reject_email', function () 
    {
        var self = $(this);

        var table = self.attr('data-table');
        var updatefield = self.attr('data-updatefield');
        var wherefield = self.attr('data-wherefield');
                
        var status = self.attr('data-status');
        var user_status = 1;
        if (status == 1)
            user_status = 0;

        if (!confirm('Are you sure want to update?'))
            return;
        self.attr('disabled', 'disabled');

        var data = {
            'table_id': self.data('id'),
            'user_status': user_status,
            'table':table,
            'updatefield':updatefield,
            'wherefield':wherefield
        };

        $.ajax
        ({
            type: "POST",
            url: "<?php echo ADMIN_APPROVE_STATUS ?>",
            data: data,
            success: function (res) 
            {                                                
                if (res.suceess) 
                {

                        var title = 'Click to unverify email';
                        var class_ = 'btn_approve_reject_email btn btn-xs btn-success';
                        var text = "Email Verified <i class='fa fa-check'></i>";
                        var isactive = 1;

                        if (status == 1) {
                            title = 'Click to verify email';
                            class_ = 'btn_approve_reject_email btn btn-xs btn-danger';
                            text = "Verify Email <i class='fa fa-close'></i>";
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
    $(document).on('click', '.btn_lock_unlock_customer', function ()
    {
        var self = $(this);
        var table = self.attr('data-table');
        var updatefield = self.attr('data-updatefield');
        var wherefield = self.attr('data-wherefield');
        
        var status = self.attr('data-status');
        var user_status = status;               

        if (!confirm('Are you sure want to update?'))
            return;
        self.attr('disabled', 'disabled');

        var data = {
            'table_id': self.data('id'),
            'user_status': user_status,
            'table':table,
            'updatefield':updatefield,
            'wherefield':wherefield
        };

        $.ajax({
            type: "POST",
            url: "<?php echo ADMIN_APPROVE_STATUS ?>",
            data: data,
            success: function (res) {                                                                     
                if (res.suceess) 
                {
                    var title = 'Click to locke Complainant';
                    var class_ = 'btn_lock_unlock_customer btn btn-xs btn-success';
                    var text = "Complainant Unlocked <i class='fa fa-unlock'></i></em>";
                    var isactive = 1;

                    if (status == 1) {
                        title = 'Click to unlocke Complainant';
                        class_ = 'btn_lock_unlock_customer btn btn-xs btn-danger';
                        text = "Complainant Locked <i class='fa fa-lock'></i></em>";
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
    $(document).on('click', '.btn_active_inactive_customer', function () 
    {
        var self = $(this);

        var table = self.attr('data-table');
        var updatefield = self.attr('data-updatefield');
        var wherefield = self.attr('data-wherefield');
                
        var status = self.attr('data-status');
        var user_status = "ACTIVE";
        if (status == "REMOVED")
            user_status = "REMOVED";

        if (!confirm('Are you sure want to update?'))
            return;
        self.attr('disabled', 'disabled');

        var data = {
            'table_id': self.data('id'),
            'user_status': user_status,
            'table':table,
            'updatefield':updatefield,
            'wherefield':wherefield
        };

        $.ajax({
            type: "POST",
            url: "<?php echo ADMIN_APPROVE_STATUS ?>",
            data: data,
            success: function (res) {                                                                    
                if (res.suceess) {

                    var title = 'Click to inactive Complainant';
                    var class_ = 'btn_active_inactive_customer btn btn-xs btn-success';
                    var text = "Complainant Activated <i class='fa fa-check'></i>";
                    var isactive = "REMOVED";

                    if (status == "REMOVED") {
                        title = 'Click to active Complainant';
                        class_ = 'btn_active_inactive_customer btn btn-xs btn-danger';
                        text = "Complainant Inactivated <i class='fa fa-close'></i>";
                        isactive = "ACTIVE";
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