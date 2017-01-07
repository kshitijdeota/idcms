<?php
/**
 * Template Name: Member Edit
 * @package WordPress
 * @subpackage IDCMS
 * USED TO EDIT THE USER PROFILE BY EMAIL
 */

idcms_auth();
is_admin();
get_header();
get_sidebar( 'left' );

// IF SEARCHING MEMBER TO EDIT else SHOW CURRENT MEMBER
if ( isset( $_POST['member-email'] ) ) {

  $member_email = $_POST['member-email'];
  $user_id = get_member_by_email( $member_email );

} else {

  $user_id = get_current_member_id();

}

// PROCESS MEMBER PROFILE
if ( isset( $_POST['profile-submit'] ) ) {

  $data = $_POST;
  $errors = validate_profile( $data );

  if ( empty( $errors ) ) {

    if ( current_user_can( 'administrator' ) ) {

      $user_id = $_POST['member-id'];
      update_member($user_id);

    } else {

      $user_id = get_current_member_id();
      update_member($user_id);

    }

  } else {

    foreach($errors as $error)

      echo $error;

  }

}

// PROCESS MEMBER PICTURE
if ( isset($_POST['dataUpload'] ) ) {

  $user_id = $_POST['member-id'];
  update_member_picture($user_id);

}

if( isset($user_id) ) {

  $member = get_member($user_id);

  $bday = $member['birthday'];
  $bday = explode( '-', $bday, 3 );

  $tosd = $member['tos'];
  $tosd = explode( '-', $tosd, 3 );

}

?>

<h2 class="title"><?php the_title(); ?></h2>

<hr>

<?php if( isset($user_id) ) { ?>

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

