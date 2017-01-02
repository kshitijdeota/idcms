<?php
/**
 * Template Name: Member Profile Edit
 * @package WordPress
 * @subpackage IDCMS
 */
?>
<?php check_login(); ?>
<?php get_header(); ?>
<?php get_sidebar( 'left' ); ?>
<?php

$user_id = get_current_member_id();

// PROCESS PROFILE
if ( isset( $_POST['submit'] ) ) {
  update_member($user_id);
}

// PROCESS PICTURE
if ( isset($_POST['dataUpload'] ) ) {
  update_member_picture($user_id);
}

$member = get_member($user_id);

$bday = $member['birthday'];
$bday = explode( '-', $bday, 3 );
$tosd = $member['tos'];
$tosd = explode( '-', $tosd, 3 );

if ( $member['sub_status'] == 1 ) {
  $paid = 'checked';
} else {
  $notpaid = 'checked';
}
?>
<h2 class="title"><?php the_title(); ?></h2>
<hr>

<!-- PICTURE FORM BEGINS -->
<div class="page-profile-edit">
  <div class="row">
    <div class="three columns">
      <?php get_template_part( 'template-parts/member-picture', 'form' ); ?>
    </div>
    <div class="nine columns">
      <?php get_template_part( 'template-parts/member-profile', 'form' ); ?>
    </div>
  </div>
</div>
<?php get_sidebar('right'); ?>
<?php get_footer(); ?>