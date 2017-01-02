<?php
/**
 * Template Name: Member Edit
 *
 * @package WordPress
 * @subpackage IDCMS
 */
?>
<?php get_header(); ?>
<?php get_sidebar( 'left' ); ?>
<?php

// PROCESS MEMBER SELECT
if ( isset( $_POST['member-select'] ) ) :

  $member_email = $_POST['member-email'];
  $member_email = sanitize_email( $member_email );
  $member       = get_user_by( 'email', $member_email );
  $user_id      = $member->ID;

endif;

// PROCESS MEMBER PROFILE
if ( isset( $_POST['submit'] ) ) {

  $user_id = $_POST['member_id'];
  update_member($user_id);

}

// PROCESS MEMBER PICTURE
if ( isset($_POST['dataUpload'] ) ) {

  $user_id = $_POST['member_id'];
  update_member_picture($user_id);

}

if( isset($user_id) ) {

  $member = get_member( $user_id );

  $bday = $member['birthday'];
  $bday = explode( '-', $bday, 3 );

  $tosd = $member['tos'];
  $tosd = explode( '-', $tosd, 3 );

}

?>
<h2 class="title"><?php the_title(); ?></h2>
<hr>
<?php

if( !isset($user_id) )

  get_template_part( 'template-parts/member-select', 'form' );

if( isset($user_id) ) { ?>
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
<?php } ?>
<?php get_sidebar('right'); ?>
<?php get_footer(); ?>

