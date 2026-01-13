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
                        <h2><?= $year; ?> Budget</h2>
                        <a href="<?= base_url(route_to('admin.add_expense')) ?>"><button type="button" data-toggle="tooltip" title="Add New Expense" class="btn btn-info btn-sm" style="float: right"><i class="fa fa-plus">Add New</i></button></a>
                        <div class="form-group" style="float: right">                                   
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <select class="form-select" id="budget_year" name="budget_year" required="">                                              
                                            <option class="" value="" selected="" disabled=""i>Select budget year</option>                                                   
                                            <option value="2019-2020" <?php echo set_selected($year, "2019-2020") ?>>2019-2020</option>
                                            <option value="2020-2021" <?php echo set_selected($year, "2020-2021") ?>>2020-2021</option>
                                            <option value="2021-2022" <?php echo set_selected($year, "2021-2022") ?>>2021-2022</option>
                                            <option value="2022-2023" <?php echo set_selected($year, "2022-2023") ?>>2022-2023</option>
                                            <option value="2023-2024" <?php echo set_selected($year, "2023-2024") ?>>2023-2024</option>
                                            <option value="2024-2025" <?php echo set_selected($year, "2024-2025") ?>>2024-2025</option>
                                            <option value="2025-2026" <?php echo set_selected($year, "2025-2026") ?>>2025-2026</option>
                                            <option value="2026-2027" <?php echo set_selected($year, "2026-2027") ?>>2026-2027</option>
                                            <option value="2027-2028" <?php echo set_selected($year, "2027-2028") ?>>2027-2028</option>
                                            <option value="2028-2029" <?php echo set_selected($year, "2028-2029") ?>>2028-2029</option>
                                            <option value="2029-2030" <?php echo set_selected($year, "2029-2030") ?>>2029-2030</option>                                                                                                                               
                                        </select>
                                    </div>
                            </div> 
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">                    					
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap datatableEx" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Index</th>
                                    <th>SOE</th>
                                    <th>Amount</th>
                                    <th>Year</th>                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Index</th>
                                    <th>SOE</th>
                                    <th>Amount</th>
                                    <th>Year</th>                                   
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>					
                    </div>
                </div>
            </div>
        </div>   
<?= $this->endsection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript" nonce="<?= SCRIPT_NONCE ?>" src="<?= base_url('assets/modules/DataTables/datatables.min.js') ?>"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
            new DataTable("#example", {
            // responsive: true,
            columnDefs: [
                {
                    targets: [0,4],
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
                url: "<?= base_url(route_to('admin.expense', $year)) ?>",
                data: {
                    "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
                },
            },
            columns: [
                {data: "index"},
                {data: "budget_soe"},
                {data: "budget_amount"},
                {data: "budget_year"},
                {data: "action"}
            ],
        });
    })          
    $( "#budget_year" ).change(function() 
    {
        var years=$(this).val();
        var url="<?= ADMIN_EXPENSE_LIST_LINK; ?>"+years;
        window.location = url;
    });
        
</script>
<?= $this->endSection() ?>