<?php
/**
 * @package WordPress
 * @subpackage IDCMS
 */
?>
<?php
get_header();
get_sidebar( 'left' );
if (have_posts()) :
   while (have_posts()) :
      the_post();
         the_content();
   endwhile;
endif;
get_sidebar( 'right' );
get_footer();
?>