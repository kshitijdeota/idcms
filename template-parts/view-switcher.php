<?php global $view; ?>



<form method="POST" action="" enctype="multipart/form-data" name="switcher-form">
  <div class="view-controls float-right">
  <?php if ( current_user_can( 'administrator' ) ) { ?>
    <a href="<?php echo site_url('/member-register/');?>" class="button button-primary">+ Add User<i class="icon-user-tie"></i></a>
    <a href="<?php echo site_url('/member-search/');?>" class="button button-primary">+ Edit User<i class="icon-user-tie"></i></a>
  <?php } ?>

  <?php if( isset($view) && ( 'grid' == $view ) ) { ?>
    <button type="submit" value="list" id="list-view" name="switcher" class="switcher" title="List View"></button>
    <button type="submit" value="grid" id="grid-view" name="switcher" class="switcher active" title="Grid View" disabled="disabled"></button>
  <?php } else { ?>
    <button type="submit" value="list" id="list-view" name="switcher" class="switcher active" title="List View" disabled="disabled"></button>
    <button type="submit" value="grid" id="grid-view" name="switcher" class="switcher" title="Grid View"></button>
  <?php } ?>
  </div>
</form>