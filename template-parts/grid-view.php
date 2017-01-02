<?php
/**
 * Template Name: Members Grid View
 * @package WordPress
 * @subpackage IDCMS
 */
?>
<?php

global $members;

echo "\n<div class='member-grid u-cf'>";

$counter = 1;

foreach ( $members as $member ) :

  $m_name = esc_html( sprintf( '%s %s %s', $member->name_title, $member->first_name, $member->last_name ) );
  // TOS
  $set_date = $member->tos;
  $tosd     = date_create( $set_date );
  $tosd_f   = date_format( $tosd, 'd M Y' );

  if ( $counter % 4 == 1 ) :
  echo "\n\t<div class='row row__closed'>";
  endif;
  echo "\n\t\t<div class='member hide'>";
  echo "\n\t\t\t<div class='info'>";
  echo "\n\t\t\t\t<img src='" . "$member->image_url" . "' alt='Profile Picture' class='thumb' />";
  echo "\n\t\t\t\t<span class='name'>" . $m_name . "</span>";
  echo "\n\t\t\t\t<span class='desig'><i class='icon-user-tie'></i>" . format_designation( $member->designation ) . "</span>";
  echo "\n\t\t\t\t<div class='arrow'></div>";
  echo "\n\t\t\t</div>";
  echo "\n\t\t\t<div class='meta u-cf'>";
  echo "\n\t\t\t\t<img src='" . "$member->image_url" . "' alt='Profile Picture' class='image' />";
  echo "\n\t\t\t\t<div class='meta-content'>";
  echo "\n\t\t\t\t<span class='name'>" . $m_name . "</span>";
  echo "\n\t\t\t\t<span><i class='icon-user-tie'></i>" . format_designation( $member->designation ) . "</span>";
  echo "\n\t\t\t\t<span><i class='icon-briefcase'></i>" . $member->office . "</span>";
  echo "\n\t\t\t\t<div class='u-cf'>";
  echo "\n\t\t\t\t\t<div class='meta-grid'>";
  echo "\n\t\t\t\t\t\t<span><i class='icon-shield'></i>MES No. " . $member->mesno . "</span>";
  echo "\n\t\t\t\t\t\t<span><i class='icon-calendar'></i>TOS : " . $tosd_f . "</span>";
  echo "\n\t\t\t\t\t</div>";
  echo "\n\t\t\t\t\t<div class='meta-grid'>";
  echo "\n\t\t\t\t\t\t<span><i class='icon-mobile'></i>" . $member->mobile . "</span>";
  echo "\n\t\t\t\t\t\t<span><i class='icon-phone'></i>" . $member->stdcode . " - " . $member->phone . "</span>";
  echo "\n\t\t\t\t\t</div>";
  echo "\n\t\t\t\t</div>";
  echo "\n\t\t\t\t<div>";
  echo "\n\t\t\t\t\t<span><i class='icon-gift'></i>" . format_date($member->birthday) . "</span>";
  echo "\n\t\t\t\t\t<span><i class='icon-envelop'></i>" . $member->user_email . "</span>";
  echo "\n\t\t\t\t</div>";
  echo "\n\t\t\t</div>";
  echo "\n\t\t\t</div>";
  echo "\n\t\t</div>";

  if ( $counter % 4 == 0 ) :
  echo "\n\t\t</div>";
  endif;

  $counter++;
endforeach;

if ( $counter % 4 != 1 ) :
echo "\n\t</div>";
endif;
echo "\n</div>";
