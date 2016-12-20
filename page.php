<?php
/**
 * @package WordPress
 * @subpackage IDCMS
 */
?>
<?php get_header(); ?>
<?php get_sidebar('left'); ?>
<?php if (have_posts()) : ?>

  <?php while (have_posts()) : the_post(); ?>
    <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
      <h2 class="title"><?php the_title(); ?></h2>
      <hr>
      <?php the_content('Read the rest of this entry &raquo;'); ?>
    </div>
  <?php endwhile; ?>

<?php else : ?>

  <h2 class="center">Not Found</h2>
  <p class="center">Sorry, but you are looking for something that isn't here.</p>
  <?php get_search_form(); ?>

<?php endif; ?>
<?php get_sidebar('right'); ?>
<?php get_footer(); ?>