<?php
/**
 * Template Name: Member Page
 * @package WordPress
 * @subpackage IDCMS
 */
?>
<?php get_header(); ?>
<?php get_sidebar( 'left' ); ?>
<?php $user_id = get_current_member_id(); ?>
<?php $member = get_member($user_id); ?>

<div class="page-header row">
  <h2 class="float-left title"><?php the_title(); ?></h2>
  <a class="float-right button button-primary" href="../member-profile-edit/">+ Edit Profile</a>
</div>
<hr>

<div class="page-profile">
  <div class="row">
    <div class="three columns">
      <p><img class="u-full-width" src="<?php echo $member['image']; ?>" alt="Profile Picture"></p>
    </div>
    <div class="nine columns">
      <h2 class="title"><?php echo $member['fullname']; ?></h2>
      <div>
        <span>Email ID :</span>
        <span><?php echo $member['email']; ?></span>
      </div>
      <div>
        <span>Mobile No. :</span>
        <span><?php echo $member['mobile']; ?></span>
      </div>
      <div>
        <span>Date of Birth :</span>
        <span><?php echo format_date($member['birthday']); ?></span>
      </div>
      <hr>
      <h2 class="title">Office Details :</h2>
      <div>
        <span>MES Number :</span>
        <span><?php echo $member['mesno']; ?></span>
      </div>
      <div>
        <span>Designation :</span>
        <span><?php echo format_designation( $member['designation'] ); ?></span>
      </div>
      <div>
        <span>TOS Date :</span>
        <span><?php echo format_date($member['tos']); ?></span>
      </div>
      <div>
        <span>Office :</span>
        <span><?php echo $member['office']; ?></span>
      </div>
      <div>
        <span>Office Phone:</span>
        <span><?php echo $member['stdcode'] . " - " . $member['phone']; ?></span>
      </div>
      <hr>
      <div>
        <span>Subscription :</span>
        <span><?php echo $member['sub_status'] == true ? 'Paid' : 'Not Paid'; ?></span>
      </div>
    </div>
  </div>
</div><!-- .page-profile -->
<?php get_sidebar('right'); ?>
<?php get_footer(); ?>