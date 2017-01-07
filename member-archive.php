<?php session_start(); ?>
<?php
/**
 * Template Name: Members
 * @package WordPress
 * @subpackage IDCMS
 */
?>
<?php get_header(); ?>
<?php get_sidebar( 'left' ); ?>
<?php


if ( isset( $_POST['filter'] ) ) {
  $filter_option = $_POST['designation-filter-select'];
  $expiration = 60*60*24;
  set_transient( 'member-filter', $filter_option, $expiration );
} else {
  $filter_option = '';
  $filter = $filter_option;
}

$paged       = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$number      = 28;
$offset      = ( $paged - 1 ) * $number;
$filter      = get_transient( 'member-filter' );
$total_paged = count( $paged );
$users       = get_users( array( 'meta_key' => 'designation','meta_value' => $filter, ) );
$total_users = count( $users );
$total_pages = intval( ( $total_users / $number ) + 1 );

$members = get_users( array(
  'exclude'    => array(1),
  'orderby'    => 'meta_value_num user_nicename',
  'meta_key'   => 'designation',
  'meta_value' => $filter,
  'fields'     => 'all',
  'order'      => 'ASC',
  'offset'     => $offset,
  'number'     => $number,
  'paged'      => $paged,
) );


$view = update_switcher();

?>

<div class="row">
  <h2 class="title float-left"><?php the_title(); ?></h2>

  <?php get_template_part( 'template-parts/view-switcher' ); ?>
</div>

<hr>

<?php

get_template_part( 'template-parts/pagination' );

get_template_part( 'template-parts/member-filter' );

if ( $view == 'grid' && $view != 'list' )

get_template_part( 'template-parts/grid', 'view' );

elseif ( ( $view == 'list' && $view != 'grid' ) || $view == NULL )

get_template_part( 'template-parts/list', 'view' );

get_template_part( 'template-parts/pagination' );

?>

<?php get_sidebar('right'); ?>
<?php get_footer(); ?>