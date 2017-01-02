<?php
/**
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
    'desig'  => get_designation( $member->designation ),
    'office' => $member->office,
    'mobile' => $member->mobile
  );
endforeach;

// SORT BY ROLES
usort($each_member, function ($a, $b) use ($roles) {
    $pos_a = array_search($a['role'], $roles);
    $pos_b = array_search($b['role'], $roles);
    return $pos_a - $pos_b;
});
$sorted_members = $each_member;

// OUTPUT
$count = 1;
foreach ( $sorted_members as $sorted_member ) :
  if ( $count % 2 == 1 ) : echo '<div class="row">'; endif; ?>
        <div class="six columns vcard">
          <div class="four columns">
            <img src="<?php echo $sorted_member[ 'image' ]; ?>" alt="profile picture" class="u-full-width">
          </div>
          <div class="eight columns">
            <span class="title"><?php  echo $sorted_member[ 'role' ]; ?></span>
            <span class="name"><?php   echo $sorted_member[ 'name' ]; ?></span>
            <span class="desig"><?php  echo $sorted_member[ 'desig' ]; ?></span>
            <span class="office"><?php echo $sorted_member[ 'office' ]; ?></span>
            <span class="mobile"><?php echo $sorted_member[ 'mobile' ]; ?></span>
          </div>
        </div>
  <?php
  if ( $count % 2 == 0 ) : echo "</div><!-- .row -->"; endif;
  $count++;
endforeach;
?>

<!-- COUNCIL MEMBERS  -->

<h2 class="title">Council Members</h2>
<hr />
<?php
$members        = NULL;
$each_member    = NULL;
$sorted_members = NULL;
$desigs         = array( 'ADG', 'CE', 'SE', 'EE', 'AEE' );
$members        = get_users( array( 'role__in' => 'Council Member' ) );
$count          = 1;
foreach ( $members as $member ) :
  $member_name = esc_html( sprintf( '%s %s %s', $member->name_title, $member->first_name, $member->last_name ) );
  $each_member[] = array(
    'image'  => $member->image_url,
    'name'   => $member_name,
    'desig'  => $member->designation,
    'office' => $member->office,
    'mobile' => $member->mobile
  );
endforeach;

// SORT BY DESIGNATION
usort($each_member, function ($a, $b) use ($desigs) {
    $pos_a = array_search($a['desig'], $desigs);
    $pos_b = array_search($b['desig'], $desigs);
    return $pos_a - $pos_b;
});
$sorted_members = $each_member;

// OUTPUT
$count = 1;
foreach ( $sorted_members as $sorted_member ) :
  $sorted_member[ 'desig' ] = get_designation( $sorted_member[ 'desig' ] );
  if ( $count % 2 == 1 ) : echo '<div class="row">'; endif; ?>
        <div class="six columns vcard">
          <div class="four columns">
            <img src="<?php echo $sorted_member[ 'image' ]; ?>" alt="profile picture" class="u-full-width">
          </div>
          <div class="eight columns">
            <span class="name"><?php echo $sorted_member[ 'name' ]; ?></span>
            <span class="desig"><?php echo $sorted_member[ 'desig' ]; ?></span>
            <span class="office"><?php echo $sorted_member[ 'office' ]; ?></span>
            <span class="mobile"><?php echo $sorted_member[ 'mobile' ]; ?></span>
          </div>
        </div>
  <?php
  if ( $count % 2 == 0 ) : echo "</div><!-- .row -->"; endif;
  $count++;
endforeach;
?>
<?php get_sidebar('right'); ?>
<?php get_footer(); ?>