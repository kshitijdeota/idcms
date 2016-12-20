<?php
/**
 * Template Name: Member Profile Page
 * @package WordPress
 * @subpackage IDCMS
 */
?>
<?php check_login(); ?>
<?php get_header(); ?>
<?php get_sidebar( 'left' ); ?>
<?php

//GET MEMBER ID BEFORE ANYTHING ELSE
$id    = get_current_user_id();
$user  = get_userdata( $id );
$email = $user->user_email;

$set_office = esc_attr( get_user_meta( $id, 'office', true ) );
$sub_status = esc_attr( get_user_meta( $id, 'sub_status', true ) );
$name_title = esc_attr( get_user_meta( $id, 'name_title', true ) );
$first_name = esc_attr( get_user_meta( $id, 'first_name', true ) );
$last_name  = esc_attr( get_user_meta( $id, 'last_name', true ) );
$set_desig  = esc_attr( get_user_meta( $id, 'designation', true ) );
$image_url  = esc_attr( get_user_meta( $id, 'image_url', true ) );
$mobile_no  = esc_attr( get_user_meta( $id, 'mobile', true ) );
$fullname   = esc_attr( sprintf( '%s %s %s', $name_title, $first_name, $last_name ) );
$mes_no     = esc_attr( get_user_meta( $id, 'mesno', true ) );
$bdate      = esc_attr( get_user_meta( $id, 'birthday', true ) );
$tdate      = esc_attr( get_user_meta( $id, 'tos', true ) );

?>
<div class="page-header row">
  <h2 class="float-left title"><?php the_title(); ?></h2>
  <a class="float-right button button-primary" href="../member-profile-edit/">Edit Profile</a>
</div>

<hr>

<div class="page-profile">
  <div class="row">
    <div class="three columns">
      <p><img class="u-full-width" src="<?php echo $image_url; ?>" alt="Profile Picture"></p>
    </div>
    <div class="nine columns">
      <h2 class="title"><?php echo $fullname; ?></h2>
      <div><span>Email ID :</span><span><?php echo $email; ?></span></div>
      <div><span>Mobile No. :</span><span><?php echo $mobile_no; ?></span></div>
      <div><span>Date of Birth :</span><span><?php echo $bdate; ?></span></div>
      <hr>
      <h2 class="title">Office Details :</h2>
      <div><span>MES Number :</span><span><?php echo $mes_no; ?></span></div>
      <div><span>Designation :</span><span><?php echo get_designation( $set_desig ); ?></span></div>
      <div><span>TOS Date :</span><span><?php echo $tdate; ?></span></div>
      <div><span>Office :</span><span><?php echo $set_office; ?></span></div>
      <hr>
      <div><span>Subscription :</span><span><?php echo ( $sub_status == false ? 'Not Paid' : 'Paid' ); ?></span></div>
    </div>
  </div>
</div>
<?php get_sidebar('right'); ?>
<?php get_footer(); ?>