<?php
/**
 * @package WordPress
 * @subpackage IDCMS
 */
?>
<?php get_header(); ?>
<?php get_sidebar( 'left' ); ?>

<h2 class="title"><?php the_title(); ?></h2>
<p class='sub-text'><?php echo get_gallery_photo_count(); ?> Photos</p>

<hr>

<div class="grid">
<?php
  $gallery = get_post_gallery($post->ID, false);
  $images = explode ( ',' , $gallery['ids'] );
  foreach ($images as $id) {
    $thumb = wp_get_attachment_image_src($id, 'thumbnail', false);
    $link = wp_get_attachment_image_src($id, 'large', false);
    printf( "\n\t<div class='grid-item' data-src='%s'>", $link[0] );
    printf( "\n\t\t\t<img src='%s' width='%spx' height='%spx' class='hide'>", $thumb[0], $thumb[1], $thumb[2] );
    printf( "\n\t</div>" );
  }
?>
</div>

<?php get_sidebar( 'right' ); ?>
<?php get_footer(); ?>