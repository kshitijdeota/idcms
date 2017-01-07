<?php

global $total_users;
global $total_paged;
global $total_pages;

if ($total_users > $total_paged) {

    $current_page = max(1, get_query_var('paged'));

    $query_args = array(
      'base'      => get_pagenum_link(1) . '%_%',
      'format'    => 'page/%#%/',
      'current'   => $current_page,
      'total'     => $total_pages,
      'show_all'  => true,
      'prev_next' => true,
      'prev_text' => __('« Previous'),
      'next_text' => __('Next »'),
    );

    echo '<div class="pagination">' . paginate_links($query_args) . '</div>';
}

