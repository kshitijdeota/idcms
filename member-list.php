<?php
/**
 * Template Name: Member List
 * @package WordPress
 * @subpackage IDCMS
 */
?>
<?php get_header(); ?>
<?php get_sidebar('left'); ?>
<h2 class="title"><?php the_title(); ?></h2>
<hr>
<table id="table-members">
    <thead class="sortable">
      <tr>
        <th>Name</th>
        <th>Designation</th>
        <th>Office</th>
        <th>Mes No.</th>
        <th>TOS Date</th>
        <th>Mobile No.</th>
      </tr>
    </thead>
    <tbody>
<?php

get_users($args);

$total_users = count_users();
$total_users = $total_users['total_users'];
$paged       = get_query_var('paged');
$number      = 50;

$members = get_users( array(
    'orderby' => 'user_nicename',
    'number'  => $number,
    'offset'  => $paged ? ($paged - 1) * $number : 0
  ) );

if( $total_users > $number ) :
  $pl_args = array(
     'base'     => add_query_arg('paged','%#%'),
     'format'   => '',
     'total'    => ceil($total_users / $number),
     'current'  => max(1, $paged),
  );

  if( $GLOBALS['wp_rewrite']->using_permalinks() )
    $pl_args['base']     = user_trailingslashit(trailingslashit(get_pagenum_link(1)).'page/%#%/', 'paged');
    $pl_args['show_all'] = true;

  echo '<div class="pagination">' . "Page : " . paginate_links($pl_args) . '</div>';
endif;

foreach ( $members as $member ) :
  $m_name = esc_html( sprintf( '%s %s %s', $member->name_title, $member->first_name, $member->last_name ) );
  // TOS
  $set_date = $member->tos;
  $tosd     = date_create( $set_date );
  $tosd_f   = date_format( $tosd, 'd M Y' );

  $table_row  = "\n<tr>";
  $table_row .= "\n\t<td>" . $m_name . "</td>";
  $table_row .= "\n\t<td>" . get_designation( $member->designation ) . "</td>";
  $table_row .= "\n\t<td>" . $member->office . "</td>";
  $table_row .= "\n\t<td>" . $member->mesno . "</td>";
  $table_row .= "\n\t<td>" . $tosd_f . "</td>";
  $table_row .= "\n\t<td>" . $member->mobile . "</td>";
  $table_row .= "\n</tr>";
  echo $table_row;
endforeach; ?>

  </tbody>
  <tfoot>
    <td>Name</td>
    <td>Designation</td>
    <td>Office</td>
    <td>Mes No.</td>
    <td>TOS Date</td>
    <td>Mobile No.</td>
  </tfoot>
</table>

<?php
if( $total_users > $number ) :
  $pl_args = array(
     'base'     => add_query_arg('paged','%#%'),
     'format'   => '',
     'total'    => ceil($total_users / $number),
     'current'  => max(1, $paged),
  );

  if( $GLOBALS['wp_rewrite']->using_permalinks() )
    $pl_args['base']     = user_trailingslashit(trailingslashit(get_pagenum_link(1)).'page/%#%/', 'paged');
    $pl_args['show_all'] = true;

  echo '<div class="pagination">' . "Page : " . paginate_links($pl_args) . '</div>';
endif;
?>

<?php get_sidebar('right'); ?>
<?php get_footer(); ?>