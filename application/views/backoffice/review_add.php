<?php
$this->load->view(ADMIN_URL . '/header'); ?>
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/data-tables/DT_bootstrap.css" />
<!-- END PAGE LEVEL STYLES -->
<div class="page-container">
    <!-- BEGIN sidebar -->
    <?php $this->load->view(ADMIN_URL . '/sidebar');

    if ($this->input->post()) {
        foreach ($this->input->post() as $key => $value) {
            $$key = @htmlspecialchars($this->input->post($key));
        }
    } else {
        $FieldsArray = array('entity_id', 'restaurant_id', 'review', 'rating');
        foreach ($FieldsArray as $key) {
            $$key = @htmlspecialchars($edit_records->$key);
        }
    }
    if (isset($edit_records) && $edit_records != "") {
        $addUserLabel    = "Edit Review";
        $userFormAction      = base_url() . ADMIN_URL . "/review/edit/" . str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encryption->encrypt($entity_id));
    } else {
        $addUserLabel    = "Add Review";
        $userFormAction      = base_url() . ADMIN_URL . "/review/add";
    }
    $usertypes = getUserTypeList('en');
    ?>

    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                    <h3 class="page-title"><?php echo $this->lang->line("branch_pages"); ?></h3>
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="<?php echo base_url() . ADMIN_URL; ?>/dashboard">
                                Home </a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="<?php echo base_url() . ADMIN_URL ?>/review/view">Review</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <?php echo $addUserLabel; ?>
                        </li>
                    </ul>
                    <!-- END PAGE TITLE & BREADCRUMB-->
                </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN VALIDATION STATES-->
                    <div class="portlet box red">
                        <div class="portlet-title">
                            <div class="caption"><?php echo $addUserLabel; ?></div>
                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <form action="<?php echo $userFormAction; ?>" id="form_add_user" name="form_add_user" method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div id="iframeloading" class="frame-load display-no" style="display: none;">
                                    <img src="<?php echo base_url(); ?>assets/admin/img/loading-spinner-grey.gif" alt="loading" />
                                </div>
                                <div class="form-body">
                                    <?php if (!empty($Error)) { ?>
                                        <div class="alert alert-danger"><?php echo $Error; ?></div>
                                    <?php } ?>
                                    <?php if (validation_errors()) { ?>
                                        <div class="alert alert-danger">
                                            <?php echo validation_errors(); ?>
                                        </div>
                                    <?php } ?>
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php echo $this->lang->line("res_name"); ?><span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <select name="RestaurantID" id="RestaurantID" class="form-control" disabled>
                                                <option value="0" selected><?= $res_name ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php echo $this->lang->line("review"); ?><span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="Review" id="Review" class="form-control" value="<?php echo $review ?  $review : '' ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php echo $this->lang->line("rating"); ?><span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <input type="radio" name="rating[]" id="rating1" value="1" <?= $rating && $rating == 1 ? 'checked' : '' ?>>1 Star
                                            <input type="radio" name="rating[]" id="rating2" value="2" <?= $rating && $rating == 2 ? 'checked' : '' ?>>2 Star
                                            <input type="radio" name="rating[]" id="rating3" value="3" <?= $rating && $rating == 3 ? 'checked' : '' ?>>3 Star
                                            <input type="radio" name="rating[]" id="rating4" value="4" <?= $rating && $rating == 4 ? 'checked' : '' ?>>4 Star
                                            <input type="radio" name="rating[]" id="rating5" value="5" <?= $rating && $rating == 5 ? 'checked' : '' ?>>5 Star
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label class="control-label col-md-3"><?php echo $this->lang->line("review_desc"); ?><span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <textarea name="ReviewDescription" id="ReviewDescription" class="form-control ckeditor"></textarea>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="form-actions fluid">
                                    <div class="col-md-offset-3 col-md-9">
                                        <input type="submit" name="submit_page" id="submit_page" value="Submit" class="btn btn-success danger-btn">
                                        <a class="btn btn-danger danger-btn" href="<?php echo base_url() . ADMIN_URL; ?>/review/view"><?php echo $this->lang->line("cancel"); ?></a>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                    <!-- END VALIDATION STATES-->
                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
    </div>
    <!-- END CONTENT -->
</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/plugins/jquery-validation/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/plugins/jquery-validation/js/additional-methods.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/plugins/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/pages/scripts/admin-management.js"></script>
<script>
    jQuery(document).ready(function() {
        Layout.init(); // init current layout
    });
</script>
<?php $this->load->view(ADMIN_URL . '/footer'); ?>