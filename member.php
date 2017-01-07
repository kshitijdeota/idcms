<?php
/**
 * Template Name: Member Page
 * @package WordPress
 * @subpackage IDCMS
 */
?>
<?php idcms_auth(); ?>
<?php get_header(); ?>
<?php get_sidebar( 'left' ); ?>
<?php $user_id = get_current_member_id(); ?>
<?php $member = get_member($user_id); ?>

<div class="page-header row">
  <h2 class="float-left title"><?php the_title(); ?></h2>
  <form action="<?php echo site_url('/member-edit/', NULL); ?>" method="post">
    <button class="float-right button button-primary" type="submit" name="current-member-edit">+ Edit</button>
  </form>
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
        <span><i class='icon-envelop'></i>Email ID :</span>
        <span><?php echo $member['email']; ?></span>
      </div>
      <div>
        <span><i class='icon-mobile'></i>Mobile No. :</span>
        <span><?php echo $member['mobile']; ?></span>
      </div>
      <div>
        <span><i class='icon-gift'></i>Date of Birth :</span>
        <span><?php echo format_date($member['birthday']); ?></span>
      </div>
      <hr>
      <h2 class="title">Office Details :</h2>
      <div>
        <span><i class='icon-shield'></i>MES Number :</span>
        <span><?php echo $member['mesno']; ?></span>
      </div>
      <div>
        <span><i class='icon-user-tie'></i>Designation :</span>
        <span><?php echo format_designation( $member['designation'] ); ?></span>
      </div>
      <div>
        <span><i class='icon-calendar'></i>TOS Date :</span>
        <span><?php echo format_date($member['tos']); ?></span>
      </div>
      <div>
        <span><i class='icon-briefcase'></i>Office :</span>
        <span><?php echo $member['office']; ?></span>
      </div>
      <div>
        <span><i class='icon-phone'></i>Office Phone:</span>
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