<?= $this->extend('layouts/employee') ?>

<?= $this->section('title') ?>
    <?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/modules/DataTables/datatables.min.css') ?>" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview mx-auto">   
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title">Cases List</h4>
                                <div class="nk-block-des">                                   
                                </div>
                            </div>
                        </div>
                        <div class="card card-preview">
                            <div class="card-inner">
                                <div class="table-responsive">
                                    <table id="caseList" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>                                            
                                                <th>Index</th>
                                                <th>Case No</th>
                                                <th>Complainant Name</th>
                                                <th>Party Name</th>
                                                <th>Title</th>
                                                <th>Priority</th>
                                                <th>Assignee</th>                                            
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
                                                <th>Complainant Name</th>
                                                <th>Party Name</th>
                                                <th>Title</th>
                                                <th>Priority</th>
                                                <th>Assignee</th>
                                                <th>Status</th> 
                                                <th>Hearing Date</th>
                                                <th>Created Date</th> 
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript" nonce="<?= SCRIPT_NONCE ?>" src="<?= base_url('assets/modules/DataTables/datatables.min.js') ?>"></script>

<script>
    DataTable.defaults.responsive = true;
    
    document.addEventListener('DOMContentLoaded', () => {
        new DataTable("#caseList", {
        // responsive: true,
        columnDefs: [
            {
                targets: [0,10],
                orderable: false,
                searchable: false,
            }
        ],
        order: [],
        rowGroup: false,
        processing: true,
        serverSide: true,
        pageLength: 10,
        paginationType: "full_numbers",
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        ajax: {
            type: "POST",
            url: "<?= base_url(route_to('emp.case.list')) ?>",
            data: {
                "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
            },
        },
        columns: [
            { data: 'index' },
            { data: 'case_no' },
            { data: 'complainant_name' },
            { data: 'cases_party_name' },
            { data: 'cases_title' },
            { data: 'cases_priority' },
            { data: 'assignee' },
            { data: 'cases_status' },
            { data: 'hearing_date' },
            { data: 'cases_dt_created' },
            { data: 'action' },
        ],
    });
    })
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
            'table': table,
            'updatefield': updatefield,
            'wherefield': wherefield

        };
        $.ajax({
            type: "POST",
            url: "<?= base_url(route_to('approve-status')) ?>",
            data: data,
            success: function (res) {
                if (res.suceess) {
                    var title = 'Click to locke Complainant';
                    var class_ = 'btn_lock_unlock_customer btn btn-xs btn-success';
                    var text = "Complainant Unlocked <em class='icon ni ni-unlock-fill'></em>";
                    var isactive = 1;

                    if (status == 1) {
                        title = 'Click to unlocke Complainant';
                        class_ = 'btn_lock_unlock_customer btn btn-xs btn-danger';
                        text = "Complainant Locked <em class='icon ni ni-lock-fill'></em>";
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
