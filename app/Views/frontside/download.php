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
                    <ul class="nav nav-tabs" role="tablist">
                        <?php
                        if (!empty($file_type)) {
                            $i = 0;
                            foreach ($file_type as $ftrow) {
                                $str = '';
                                if ($i == 0) {
                                    $str = 'active';
                                }
                                ?>
                                <li role="presentation" class="<?php echo $str; ?>"><a href="#<?php echo $ftrow['category_title']; ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo $ftrow['category_title']; ?></a></li>                        
                                <?php
                                $i = $i + 1;
                            }
                        }
                        ?>

                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <?php
                        if (!empty($file_type)) {
                            $i = 0;
                            foreach ($file_type as $ftrow) {
                                $str = '';
                                if ($i == 0) {
                                    $str = 'active';
                                }
                                ?>
                                <div role="tabpanel" class="tab-pane <?php echo $str; ?>" id="<?php echo $ftrow['category_title']; ?>">
                                    <table id="example<?php echo $i; ?>" class="table table-striped table-bordered dt-responsive nowrap datatableEx" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Index</th>
                                                <th>Ref No</th>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Description</th>                                    
                                                <th>Download</th>
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
                                <?php
                                $i = $i + 1;
                            }
                        }
                        ?>
                    </div>
                </div>
                <p></p>
            </div>
        </div>
    </div> 
</div><!-- /.main-container  -->
