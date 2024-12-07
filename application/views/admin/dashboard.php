<?php include(__DIR__ . '/include/header.php'); ?>

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
   <!-- begin:: breadcrumb -->
   <div class="kt-subheader kt-grid__item" id="kt_subheader">
      <div class="kt-container  kt-container--fluid ">
         <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Dashboard</h3>
         </div>
      </div>
   </div>
   <!-- end:: breadcrumb -->

   <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
      <div class="row">
         <div class="col-lg-12">
             <?php include(__DIR__ . '/include/teaser.php'); ?>
         </div>
      </div>
   </div>
   <form action="" method="post">
      <!-- begin:: Content -->
      <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
         <div class="row">
            <div class="col-lg-12">
               <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                  <div class="kt-portlet__head">
                     <div class="kt-portlet__head-label">
                        <div class="kt-portlet__head-label">
                              <span class="kt-portlet__head-icon">
                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                      width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                     <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                         <rect x="0" y="0" width="24" height="24"/>
                                         <path d="M5.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L5.5,11 C4.67157288,11 4,10.3284271 4,9.5 L4,5.5 C4,4.67157288 4.67157288,4 5.5,4 Z M11,6 C10.4477153,6 10,6.44771525 10,7 C10,7.55228475 10.4477153,8 11,8 L13,8 C13.5522847,8 14,7.55228475 14,7 C14,6.44771525 13.5522847,6 13,6 L11,6 Z"
                                               fill="#000000" opacity="0.3"/>
                                         <path d="M5.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M11,15 C10.4477153,15 10,15.4477153 10,16 C10,16.5522847 10.4477153,17 11,17 L13,17 C13.5522847,17 14,16.5522847 14,16 C14,15.4477153 13.5522847,15 13,15 L11,15 Z"
                                               fill="#000000"/>
                                     </g>
                                 </svg>
                              </span>
                           <h3 class="kt-portlet__head-title"> Choose Module </h3>
                        </div>
                     </div>
                      <?php echo collapse_tool(); ?>
                  </div>

                  <div class="kt-portlet__body">
                     <div class="kt-inbox__search dsrchbtn mb10 mt10">

                        <div class="input-group">
                           <input type="text" class="form-control search-input" placeholder="Search module..." find-block=".dashboard-components" find-in="[class*=module_li]" autocomplete="off">
                           <div class="input-group-append">
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                    <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"></path>
                                 </g>
                              </svg>
                           </div>
                        </div>

                     </div>

                     <ul class="dashboard_module dashboard_icon dashboard-components">
                         <?php
                         foreach ($modules as $module) {
                             if ($module->module == '#') {
                                 continue;
                             }
                             ?>
                            <a href="<?php echo base_url('admin/' . $module->module); ?>">
                               <li class="module_li">
                                   <?php echo $module->icon; ?>
                                  <div class="module_title"><?php echo $module->module_title; ?></div>
                               </li>
                            </a>
                         <?php } ?>
                     </ul>
                     <div class="mb-2"></div>
                  </div>
               </div>
               <div class="mb-5"></div>
            </div>
         </div>
      </div>
      <!-- end:: Content -->
   </form>
</div>

<?php include(__DIR__ . '/include/footer.php'); ?>
