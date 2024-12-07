<?php include('include/header.php'); ?>

    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <form action="" method="post" enctype="multipart/form-data" id="kt_form_1">
            <!-- begin:: breadcrumb -->
            <div class="kt-subheader kt-grid__item" id="kt_subheader">

                <div class="kt-container  kt-container--fluid ">
                    <div class="kt-subheader__main">
                        <h3 class="kt-subheader__title">New Banner Form</h3>
                        <span class="kt-subheader__separator kt-hidden"></span>
                        <div class="kt-subheader__breadcrumbs">
                            <a href="<?php echo $site_url; ?>" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                            <span class="kt-subheader__breadcrumbs-separator"></span>
                            <a href="#" class="kt-subheader__breadcrumbs-link"> Banner Form </a>
                        </div>
                    </div>

                    <div class="kt-subheader__toolbar">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-md btn-danger btn-sm">
                                <i class="la la-save"></i> Submit Now
                            </button>
                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle dropdown-toggle-split"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-plus"></i> Save & New</a>
                                <a class="dropdown-item" href="#"><i class="la la-undo"></i> Save & Close</a>
                            </div>
                        </div>
                        &nbsp;&nbsp;
                        <a href="<?php echo $site_url; ?>/page_grid.php" class="btn btn-secondary btn-sm"><i class="la la-undo"></i>
                            Back</a>
                    </div>
                </div>
            </div>
            <!-- end:: breadcrumb -->
            <!-- begin:: Content -->
            <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <span class="kt-portlet__head-icon"> <i class="flaticon-file"></i> </span>
                                    <h3 class="kt-portlet__head-title"> Fill Out Below Form </h3>
                                </div>
                                <div class="kt-portlet__head-toolbar">
                                    <div class="kt-portlet__head-group">
                                        <a href="#" data-ktportlet-tool="toggle" class="btn btn-sm btn-icon btn-clean btn-icon-md"><i class="la la-angle-down"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="kt-portlet__body">
                                <div class="mt10"></div>
                                <div class="form-group row">
                                    <label for="title" class="col-1 col-form-label text-right">Title:
                                        <span class="required">*</span></label>
                                    <div class="col-5">
                                        <input name="title" type="text" value="" class="form-control" placeholder="Enter title" id="title">
                                    </div>

                                    <label for="title" class="col-1 col-form-label text-right">Type:
                                        <span class="required">*</span></label>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <select class="custom-select form-control">
                                                <option value="Top"> Top</option>
                                                <option value="Bottom"> Bottom</option>
                                                <option value="Left"> Left</option>
                                                <option value="Right"> Right</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                                <div class="form-group row">
                                    <label for="link" class="col-1 col-form-label text-right">Link:</label>
                                    <div class="col-10">
                                        <input name="link" type="text" value="" class="form-control" placeholder="Enter link" id="link">
                                    </div>
                                </div>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>
                                <div class="form-group row">
                                    <label for="identifier" class="col-1 col-form-label text-right">Description:</label>
                                    <div class="col-10">
                                        <textarea name="address" class="editor-short"></textarea>
                                    </div>
                                </div>
                                <div class="mb30"></div>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-md btn-brand btn-sm"><i class="la la-save"></i>Submit
                                        Now
                                    </button>
                                    <button type="button" class="btn btn-sm btn-brand dropdown-toggle dropdown-toggle-split"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-left">
                                        <a class="dropdown-item" href="#"><i class="la la-plus"></i> Save & New</a>
                                        <a class="dropdown-item" href="#"><i class="la la-undo"></i> Save & Close</a>
                                    </div>
                                </div>
                                &nbsp;&nbsp;
                                <button type="reset" class="btn btn-secondary btn-sm"><i class="la la-undo"></i> Back
                                </button>
                            </div>
                        </div>
                    </div> <!--col-9-->

                    <!--======= begin::right sidebar -->
                    <div class="col-lg-3">
                        <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon"> <i class="flaticon2-protected"></i> </span>
                                        <h3 class="kt-portlet__head-title"> Banner Status </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <div class="kt-portlet__content">
                                    <div class="form-group">
                                        <select class="custom-select form-control">
                                            <option value="Published"> Active</option>
                                            <option value="Unpublished"> Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon"> <i class="flaticon2-image-file"></i> </span>
                                        <h3 class="kt-portlet__head-title"> Image Option</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <div class="form-group topimg">
                                    <img src="<?php echo $site_url; ?>/assets/images/no_image.jpg" class="img-fluid img-thumbnail img_center" alt="img">
                                    <button type="button" class="btn btn-md btn-danger btn-sm img_center mt-3">
                                        <i class="la la-trash"></i> Delete Image
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon"> <i class="flaticon2-dashboard"></i> </span>
                                        <h3 class="kt-portlet__head-title"> Ordering </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <div class="kt-portlet__content">
                                    <input value="" name="ordering" placeholder="odering 1 - 9" type="text" id="kt_touchspin_5" type="text" class="form-control bootstrap-touchspin-vertical-btn">
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--======= end::right sidebar -->
                </div>
            </div>
            <!-- end:: Content -->
        </form>
    </div>
<?php include('include/footer.php'); ?>