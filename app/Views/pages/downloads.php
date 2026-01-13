<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>
    <?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/modules/DataTables/datatables.min.css') ?>" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
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
        <div class="row">
            <div class="col-md-12 fadeIn animated">
                <p>
                    Documents avaliable for public download.
                </p>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-12 fadeIn">
                <h2 class="title-style-2"> View / Download <span class="title-under"></span></h2>
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs custom-tabs" id="status-tabs" role="tablist">
                        <?php if (!empty($file_type)): ?>
                            <?php foreach ($file_type as $key => $ftrow): ?>
                                <li role="presentation" class="nav-item">
                                    <button class="nav-link <?= $key === 0 ? 'active': '' ?>" id="<?= $ftrow['category_code'] ?>-tab" data-bs-toggle="tab" data-bs-target="#<?= $ftrow['category_code'] ?>-panel" type="button" role="tab" aria-controls="<?= $ftrow['category_code'] ?>-panel" aria-selected="true">
                                        <?= $key === 0 ? "-" : $ftrow['category_title'] ?>
                                    </button>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content" id="status-tab-content">
                        <?php if (!empty($file_type)): ?>
                            <?php foreach ($file_type as $key => $ftrow): ?>
                                <div class="tab-pane fade <?= $key === 0 ? 'show active': '' ?>" id="<?= $ftrow['category_code'] ?>-panel" role="tabpanel"  aria-labelledby="<?= $ftrow['category_code'] ?>-tab" tabindex="0">
                                    <div class="table-responsive">
                                        <table id="example<?= $key; ?>" class="table table-striped table-bordered" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th data-priority="1">Index</th>
                                                    <th data-priority="1">Ref No</th>
                                                    <th data-priority="1">Title</th>
                                                    <th data-priority="1">Category</th>
                                                    <th data-priority="2">Description</th>                                    
                                                    <th data-priority="2">Download</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Index</th>
                                                    <th>Ref No</th>
                                                    <th>Title</th> 
                                                    <th>Category</th>
                                                    <th>Description</th>                                    
                                                    <th>Download</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>  
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript" nonce="<?= SCRIPT_NONCE ?>" src="<?= base_url('assets/modules/DataTables/datatables.min.js') ?>"></script>

<script nonce="<?= SCRIPT_NONCE ?>" type="text/javascript">
    DataTable.defaults.responsive = true;
    const setTableData = (id, category_code) => {
        new DataTable(`#${id}`, {
            responsive: true,
            columnDefs: [{
                targets: [0, 4, 5],
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
                type: 'GET',
                url: "<?= base_url(route_to('downloads.list')) ?>",
                data: { category_code },
            },
            columns: [
                { data: "index" },
                { data: "upload_file_ref_no" },
                { data: "upload_file_title" },
                { data: "category_title_sub" },
                { data: "upload_file_desc" },
                { data: "download" },
            ],
        });
    };
    <?php if (!empty($file_type)): ?>
        <?php foreach ($file_type as $key => $ftrow): ?>
            setTableData("example<?= $key ?>", "<?= $ftrow['category_code'] ?>");
        <?php endforeach; ?>
    <?php endif; ?>

</script>
<?= $this->endSection() ?>
