<?php
/**
 * Template Name: Member Register Page
 * @package WordPress
 * @subpackage IDCMS
 */
?>
<?php idcms_auth_admin(); ?>
<?php get_header(); ?>
<?php get_sidebar('left'); ?>
<h2 class="title"><?php the_title(); ?></h2>
<hr>
<?php

// REGISTER A NEW MEMBER
if ( isset($_POST['add-member']) )

  create_member();

get_template_part( 'template-parts/member-create', 'form' ); ?>

<?php get_sidebar('right'); ?>
<?php get_footer(); ?>