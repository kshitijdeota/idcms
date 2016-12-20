<?php
/**
 * Template Name: Member Login
 * @package WordPress
 * @subpackage IDCMS
 */
?>
<?php if ( is_user_logged_in() ) {
        wp_redirect( home_url() );
        exit;
      } ?>
<?php get_header(); ?>
<?php get_sidebar('left'); ?>
<h2 class="title"><?php the_title(); ?></h2>
<hr>
<?php
$referer = '/member-profile/';
// Display WordPress login form:
$args = array(
  'redirect' => $referer,
  'form_id' => 'form-member-login',
  'label_username' => __( 'Email' ),
  'label_password' => __( 'Password' ),
  'label_remember' => __( 'Remember me on this computer' ),
  'label_log_in' => __( 'Log In' ),
  'remember' => true
);
echo "<p>" . wp_login_form( $args ) . "</p>";
?>
<p><a class="button" href="../wp-login.php?action=lostpassword">Forgot your Password?</a></p>
<?php get_sidebar('right'); ?>
<?php get_footer(); ?>