<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
  <div class="col-md-12">
    <div class="card sameheight-item items" data-exclude="xs,sm,lg">
      <div class="card-header bordered">
        <div class="header-block">
          <h3 class="title"><?php echo lang('admin template email'); ?></h3>
        </div>
     </div>
     <section class="example">
      <div class="table-responsive">
         <table class="table table-striped table-bordered table-hover">
           <thead>
              <tr>
                <th>
                 <?php echo lang('admin tickets title'); ?>  
                </th>
                <th>
                  <div class="text-center">
                     <?php echo lang('admin col actions'); ?>  
                  </div>
                </th>
              </tr>
            </thead>
            <tbody>
            <?php if ($total) : ?>
            <?php foreach ($email_templates as $view) : ?>
            
            <tr>
              
              <td>
                 <?php echo $view['title']; ?>
              </td>
              
              <td>
                <div class="text-center">
                  <a href="<?php echo $this_url; ?>/edit/<?php echo $view['id']; ?>" class="btn btn-down btn-primary"><i class="icon-eye icons"></i></a>
                </div>
              </td>
            
            </tr>
            
            <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="2">
                        <?php echo lang('core error no_results'); ?>
                    </td>
                </tr>
            <?php endif; ?>
          </tbody>
         </table>
      </div>
    </section>
      <div class="card-footer">
          <div class="row">
                <div class="col-md-4 text-left">
                    
                </div>
                <div class="col-md-8">
                  <div class="pull-right">
                    <?php echo $pagination; ?>
                  </div>
                </div>
            </div>

        </div>
   </div>
 </div>
</div>
