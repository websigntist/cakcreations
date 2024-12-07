<?php include(__DIR__ . '/include/header.php'); ?>
   <div class="breadcrumb__section breadcrumb__bg">
      <div class="container">
         <div class="row row-cols-1">
            <div class="col">
               <div class="breadcrumb__content text-center">
                  <h1 class="breadcrumb__content--title"><?php echo $page->title; ?></h1>
                  <ul class="breadcrumb__content--menu d-flex justify-content-center">
                     <li class="breadcrumb__content--menu__items"><a href="<?php echo site_url(); ?>">Home</a></li>
                     <li class="breadcrumb__content--menu__items"><span><?php echo $page->title; ?></span></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
<?php
if ($page->thumbnail == '') {
    $title_image = asset_url(NO_PAGE_IMAGE);
} else {
    $title_image = asset_url('images/pages/' . $page->thumbnail);
}
?>
<?php if ($page->maintenance_status != 'active') { ?>
   <div class="<?php echo($page->template == 'Full Width' ? 'container-fluid nopadding pgstyl' : 'container pgstyl') ?> innerpg">
       <?php //echo do_shortcode(str_replace(['../../../assets', '../../assets'], site_url('assets'), $page->content)); ?>
       <?php echo do_shortcode(replaceImgTag($page->content)); ?>
   </div>
<?php } else { ?>
   <div class="container mt-50 mb-60">
      <div class="row">
         <div class="col-12">
            <div class="coming">
                <?php
                if ($page->maintenance_image) { ?>
                   <img src="<?php echo asset_url('images/pages/' . $page->maintenance_image); ?>" class="img-fluid" alt="img">
                   <h1 class="coming_title"><?php echo $page->maintenance_title; ?></h1>
                <?php } else { ?>
                   <img src="<?php echo asset_url('images/giphy.gif', true); ?>" class="img-fluid" alt="img">
                   <h1 class="coming_title">PAGE UNDER MAINTENANCE</h1>
                <?php } ?>
            </div>
         </div>
      </div>
   </div>
<?php }
include(__DIR__ . '/include/footer.php');
?>