<?php
/**
 * Template Name: Council Members
 * @package WordPress
 * @subpackage IDCMS
 */
?>
<?php get_header(); ?>
<?php get_sidebar('left'); ?>

<h2 class="title">Office Bearers</h2>

<hr />

<?php

$roles = array( 'Vice President', 'Treasurer', 'Secretary', 'Jt. Secretary' );

$members = get_users( array( 'role__in' => $roles ) );

foreach ( $members as $member ) :

  $role          = $member->roles[0];
  $member_name   = esc_html( sprintf( '%s %s %s', $member->name_title, $member->first_name, $member->last_name ) );

  $each_member[] = array(
    'role'   => $role,
    'image'  => $member->image_url,
    'name'   => $member_name,
    'desig'  => format_designation( $member->designation ),
    'office' => $member->office,
    'mobile' => $member->mobile
  );

endforeach;

usort($each_member, function ($a, $b) use ($roles) {
    $pos_a = array_search($a['role'], $roles);
    $pos_b = array_search($b['role'], $roles);
    return $pos_a - $pos_b;
});

$sorted_members = $each_member;

$count = 1;

foreach ( $sorted_members as $sorted_member ) :

  if ( $count % 2 == 1 )
    echo '<div class="row">'; ?>
    <div class="six columns vcard">
      <div class="four columns">
        <img src="<?php echo $sorted_member[ 'image' ]; ?>" alt="profile picture" class="u-full-width">
      </div>
      <div class="eight columns">
        <span class="title"><?php  echo $sorted_member[ 'role' ]; ?></span>
        <span class="name"><?php   echo $sorted_member[ 'name' ]; ?></span>
        <span class="desig"><i class='icon-user-tie'></i><?php  echo $sorted_member[ 'desig' ]; ?></span>
        <span class="office"><i class='icon-briefcase'></i><?php echo $sorted_member[ 'office' ]; ?></span>
        <span class="mobile"><i class='icon-mobile'></i><?php echo $sorted_member[ 'mobile' ]; ?></span>
      </div>
    </div>
  <?php

  if ( $count % 2 == 0 )
    echo "</div><!-- .row -->";

  $count++;

endforeach;
?>

<!-- COUNCIL MEMBERS  -->

<h2 class="title">Council Members</h2>
<hr />
<?php

$members = NULL;
$count   = 1;

$members = get_users( array(
  'role__in' => 'Council Member',
  'meta_key' => 'designation',
  'orderby'  => 'meta_value_num user_nicename',
  'fields'   => 'all',
  'order'    => 'ASC',
));

foreach ( $members as $member ) :

  $name = esc_html( sprintf( '%s %s %s', $member->name_title, $member->first_name, $member->last_name ) );
  $designation = format_designation( $member->designation );
  $office = $member->office;
  $mobile = $member->mobile;

  if ( $count % 2 == 1 )

    echo "\n<div class='row'>";

  echo "\n<div class='six columns vcard'>";
  echo "\n\t<div class='four columns'>";
  echo "\n\t\t<img src=" . $member->image_url . " alt='profile picture' class='u-full-width'>";
  echo "\n\t</div>";
  echo "\n\t<div class='eight columns'>";
  echo "\n\t\t<span class='name'>" . $name  . "</span>";
  echo "\n\t\t<span class='desig'><i class='icon-user-tie'></i>" . $designation . "</span>";
  echo "\n\t\t<span class='office'><i class='icon-briefcase'></i>" . $member->office . "</span>";
  echo "\n\t\t<span class='mobile'><i class='icon-mobile'></i>" . $member->mobile . "</span>";
  echo "\n\t</div>";
  echo "\n</div>";

  if ( $count % 2 == 0 )

    echo "\n</div><!-- .row -->";

  $count++;

endforeach;
?>
<?php get_sidebar('right'); ?>
<?php get_footer(); ?>