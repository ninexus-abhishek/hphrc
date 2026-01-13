<div class="main_menu_side mt-3 hidden-print main_menu">        
    <ul class="nav d-block  side-menu menu_section">        
        <li class="<?= current_url(true)->getPath() === route_to('admin.dashboard') ? 'active' : '' ?>">
            <a href="<?= base_url(route_to('admin.dashboard')) ?>"><i class="fa fa-dashboard"></i> Dashboard <span class="fa fa-chevron-right"></span></a>                    
        </li>
        <li class="<?= current_url(true)->getPath() === route_to('admin.file_list') ? 'active' : '' ?>">
            <a href="<?= base_url(route_to('admin.file_list')) ?>"><i class="fa fa-files-o"></i> Files <span class="fa fa-chevron-right"></span></a>                    
        </li>
        <li class="<?= current_url(true)->getPath() === route_to('admin.categories_list') ? 'active' : '' ?>">
            <a href="<?= base_url(route_to('admin.categories_list')) ?>"><i class="fa fa-list-alt"></i> Categories <span class="fa fa-chevron-right"></span></a>                    
        </li>
        <li class="<?= current_url(true)->getPath() === route_to('admin.customer_list') ? 'active' : '' ?>">
            <a href="<?= base_url(route_to('admin.customer_list')) ?>"><i class="fa fa-users"></i> Complainant <span class="fa fa-chevron-right"></span></a>                    
        </li>
        <li class="<?= current_url(true)->getPath() === route_to('admin.employee_list') ? 'active' : '' ?>">
            <a href="<?= base_url(route_to('admin.employee_list')) ?>"><i class="fa fa-users"></i> Employees <span class="fa fa-chevron-right"></span></a>                    
        </li>
        <li class="<?= current_url(true)->getPath() === ADMIN_EXPENSE_LIST_LINK.((date("Y"))-1).'-'.(date("Y"))? 'active' : '' ?>">
            <a href="<?php echo ADMIN_EXPENSE_LIST_LINK.((date("Y"))-1).'-'.(date("Y")); ?>"><i class="fa fa-money"></i> Budget <span class="fa fa-chevron-right"></span></a>                     
        </li>
    </ul>
</div> 