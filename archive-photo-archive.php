<?php
/**
 * @package WordPress
 * @subpackage IDCMS
 */
?>
<?php get_header(); ?>
<?php get_sidebar( 'left' ); ?>
<?php
$args = array( 'post_type' => 'photo-archive', 'posts_per_page' => 10 );
$loop = new WP_Query( $args );
?>

<h2 class="title"><?php post_type_archive_title(); ?></h2>
<hr>
<div id="photo-archive">

<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

  <div class="album">
    <a class='cover' href="<?php the_permalink(); ?>" title="Click to view album">
      <?php echo get_the_post_thumbnail( null, 'full', '' ); ?>
    </a>
    <div class='intro'>
      <a href="<?php the_permalink(); ?>">
        <h3 class='title'><?php the_title(); ?></h3>
      </a>

      <?php echo "<p class='photo-count'>" . get_gallery_photo_count() . " Photos</p>"; ?>
    </div>
  </div>

<?php endwhile; ?>

</div>
<?php get_sidebar( 'right' ); ?>
<?php get_footer(); ?>