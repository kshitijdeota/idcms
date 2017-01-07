<?php
/**
 * Template Name: Member Search
 * @package WordPress
 * @subpackage IDCMS
 */
idcms_auth_admin();
get_header();
get_sidebar( 'left' );

?>
<form action="<?php echo site_url( '/member-edit/', null ); ?>" method="POST" name="member-select-form">
  <div class="row">
    <label for="member-search">Search Email :</label>
    <input type="email" name="member-email" id="member-email">
    <input type="submit" name="member-search" id="memeber-search">
  </div>
</form>

<?php

get_sidebar( 'right' );
get_footer();

?>