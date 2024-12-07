<?php include('include/header.php'); ?>
<?php include('include/breadcrumbs.php'); ?>
   <section class="about__Section section--padding">
      <div class="container">

          <?php
          $cat_url = $categories['rows']->friendly_url;
          $_getCat = end($this->uri->segments);
          $cat = $this->M_categories->getCategories($_getCat);
          echo '<pre>';print_r($cat);echo '</pre>';

          $sub_cats = $this->M_categories->getCategories('', "AND parent_id='{$cat['rows']->id}'");
          //echo '<pre>';print_r($sub_cats);echo '</pre>';

          ?>
         <div class="row align-items-center">

             <?php foreach ($sub_cats['rows'] as $key => $item) { echo '<pre>';print_r($item->title);echo '</pre>'; ?>
                <div class="col-lg-3 col-md-3 col-sm-3">
                   <a href="<?php echo site_url('products/shop/' . $cat_url . '/' . $item->friendly_url); ?>">
                      <img data-src="<?php echo asset_url('images/categories/' . $item->image); ?>"
                           src="<?php echo asset_url('images/pre-loader-1.gif'); ?>" class="lazy img-fluid img-thumbnail"
                           alt="<?php echo $item->image; ?>">
                      <h5><?php echo $item->title; ?></h5>
                   </a>
                </div>
             <?php } ?>

         </div>
      </div>
   </section>
<?php include('include/footer.php'); ?>