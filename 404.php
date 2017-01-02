<?php
/**
 * Template Name: 404
 * @package WordPress
 * @subpackage IDCMS
 */
?>
<?php get_header(); ?>
<?php get_sidebar('left'); ?>
<h2 class="title">404 : Page Not Found</h2>
<hr>

<p>The page you are looking for</p>
<p>DOES NOT EXIST / MAY NOT EXIST / WILL NOT EXIST</p>
<p>But we highly appreacite your visit and hope you like the <a href="<?php echo site_url(); ?>">website</a><br />
If you are an IDCMSOA member and don't have a website login account, please <a href="<?php echo site_url('/contact-us/'); ?>">write to us.</a><br />
If you are an IDCMSOA member and haven't updated your <a href="<?php echo site_url('/member-profile/'); ?>">profile</a> yet,<br />
now would a great time to do so.</p>
<p><a class="button button-primary" href="<?php echo site_url('/member-profile-edit/', ''); ?>">Update Your Profile</a></p>
  If you are not an IDCMSOA member...<br />.
</p>

<?php get_sidebar('right'); ?>
<?php get_footer(); ?>