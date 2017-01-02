<?php

global $paged;
global $number;
global $total_users;

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