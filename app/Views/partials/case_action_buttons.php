<?php
$isactive = 1;
$table_update_field = 'is_block_user';
?>

<div class="btn-group" role="group">
    <a href="<?= base_url(route_to('emp.case.edit', $row->cases_id)) ?>" target="_blank" class="btn btn-xs btn-warning">
        Edit &nbsp; <i class="icon ni ni-edit-fill"></i>
    </a>
    <a href="<?= base_url(route_to('emp.case.view', $row->cases_id)) ?>" target="_blank" class="btn btn-xs btn-primary">
        View &nbsp; <i class="icon ni ni-eye-fill"></i>
    </a>
    <button type="button"
        data-id="<?= $row->cases_id ?>"
        data-status="<?= $isactive ?>"
        class="btn_lock_unlock_customer btn btn-xs btn-success"
        data-table="cases"
        data-updatefield="<?= $table_update_field ?>"
        data-wherefield="cases_id"
        title="Click to lock customer">
        Customer Unlocked &nbsp; <i class="icon ni ni-unlock-fill"></i>
    </button>
</div>
