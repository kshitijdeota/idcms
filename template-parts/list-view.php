<?php
/**
 * Template Name: Members List View
 * @package WordPress
 * @subpackage IDCMS
 */
?>
<?php

global $members;

echo "\n<ul class='member-list u-cf'>";

$counter = 1;

foreach ( $members as $member ) :

  $m_name = esc_html( sprintf( '%s %s %s', $member->name_title, $member->first_name, $member->last_name ) );
  // TOS
  $set_date = $member->tos;
  $tosd     = date_create( $set_date );
  $tosd_f   = date_format( $tosd, 'd M Y' );

  if ( $counter % 2 === 0 ) :
  echo "\n\t<li class='member alt u-cf'>";
  else :
  echo "\n\t<li class='member u-cf'>";
  endif;
  echo "\n\t\t<section class='info'>";
  echo "\n\t\t\t<img class='image' src='" . $member->image_url . "' alt='Profile Picture'>";
  echo "\n\t\t\t<span class='name'>" . $m_name . "</span>";
  echo "\n\t\t\t<span class='desig'><i class='icon-user-tie'></i>" . format_designation( $member->designation ) . "</span>";
  echo "\n\t\t</section>";
  echo "\n\t\t<section class='meta'>";
  echo "\n\t\t\t<span><i class='icon-briefcase'></i>" . $member->office . "</span>";
  echo "\n\t\t\t<span><i class='icon-shield'></i>MES No. " . $member->mesno . "</span>";
  echo "\n\t\t\t<span><i class='icon-calendar'></i>TOS : " . $tosd_f . "</span>";
  echo "\n\t\t</section>";
  echo "\n\t\t<section class='meta'>";
  if ( is_user_logged_in() ) :
  echo "\n\t\t\t<span class='dob'><i class='icon-gift'></i>" . format_date($member->birthday) . "</span>";
  echo "\n\t\t\t<span><i class='icon-envelop'></i>" . $member->user_email . "</span>";
  echo "\n\t\t\t<span><i class='icon-mobile'></i>" . $member->mobile . "</span>";
  endif;
  echo "\n\t\t\t<span><i class='icon-phone'></i>" . $member->stdcode . " - " . $member->phone . "</span>";
  echo "\n\t\t</section>";

  echo "\n\t</li>";

  $counter++;
endforeach;
echo "\n</ul>";