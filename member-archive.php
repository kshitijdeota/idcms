<?php
/**
 * Template Name: Members
 * @package WordPress
 * @subpackage IDCMS
 */
?>
<?php get_header(); ?>
<?php get_sidebar('left'); ?>
<?php

get_users($args);

$total_users = count_users();
$total_users = $total_users['total_users'];
$paged       = get_query_var('paged');
$number      = 36;

$members = get_users( array(
  'orderby' => 'user_nicename',
  'number'  => $number,
  'offset'  => $paged ? ( $paged - 1 ) * $number : 0
) );

if ( is_user_logged_in() ) :

  global $current_user;
  $user_id = $current_user->ID;

  if ( isset($_POST['switcher']) ) :

    $post = $_POST['switcher'];

    if ( 'grid' == $post ) :

      $view = 'grid';
      update_user_meta( $user_id, 'switcher', $view, '' );

    elseif ( 'list' == $post ) :

      $view = 'list';
      update_user_meta( $user_id, 'switcher', $view, '' );

    endif;

  endif;

  $view = get_user_meta( $user_id, 'switcher', true );

  if( isset($view)  ) :

    if ( 'grid' == $view ) $grid = 'active';
    if ( 'list' == $view ) $list = 'active';

  endif;

endif;

?>

<div class="row">

  <h2 class="title float-left">IDCMS Members</h2>

  <?php if ( is_user_logged_in() ) : ?>

  <form method="POST" action="" enctype="multipart/form-data" name="switcher-form">
    <div class="view-controls float-right"> Select View :

      <button type="submit" value="list" id="list-view" name="switcher" class="switcher <?php echo $list; ?>" title="List View"></button>
      <button type="submit" value="grid" id="grid-view" name="switcher" class="switcher <?php echo $grid; ?>" title="Grid View"></button>

    </div>
  </form>

  <?php endif; ?>

</div>

<hr>

<?php

get_template_part( 'template-parts/pagination' );

if ( $view == 'grid' && $view != 'list' ) :
  get_template_part( 'template-parts/grid', 'view' );
elseif ( ( $view == 'list' && $view != 'grid' ) || $view == NULL ) :
  get_template_part( 'template-parts/list', 'view' );
endif;

get_template_part( 'template-parts/pagination' );

?>

<?php get_sidebar('right'); ?>
<?php get_footer(); ?>