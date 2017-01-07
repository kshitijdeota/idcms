<?php
/**
 * @package WordPress
 * @subpackage IDCMS
 */
?>
</div><!-- MAIN CONTENT ENDS -->
<?php
$idcms_date  = '<span class="day">' . date( "l" ) . '</span><br>' . date( "d F Y" );

$users = get_users();
$i     = 0;
foreach ( $users as $user ) {
  $user_id   = $user->ID;
  $birthday  = esc_attr( get_user_meta( $user_id, 'birthday', true ) );
  $birthdate = explode( '-', $birthday );
  $b_month   = $birthdate[1];
  $b_date    = $birthdate[2];
  $match     = $b_date. '-' .$b_month;
  $today     = date( "d-m" );
  $tomorrow  = ( date( "d" ) + 1 ) . "-" . date( "m" );
  if ( $today == $match ) {
    $today_name   = esc_attr( get_user_meta( $user_id, 'name_title', true ) ) . " ";
    $today_name  .= esc_attr( get_user_meta( $user_id, 'first_name', true ) ) . " ";
    $today_name  .= esc_attr( get_user_meta( $user_id, 'last_name', true ) );
    $today_names[$i] = $today_name;
  }

  if ( $tomorrow == $match ) {
    $tomorrow_name       = esc_attr( get_user_meta( $user_id, 'name_title', true ) ) . " ";
    $tomorrow_name      .= esc_attr( get_user_meta( $user_id, 'first_name', true ) ) . " ";
    $tomorrow_name      .= esc_attr( get_user_meta( $user_id, 'last_name', true ) );
    $tomorrow_names[$i]  = $tomorrow_name;
  }
  $i++;
}
?>

<div id="sidebar-right">

  <span class="date"><i class='icon-calendar'></i><?php echo $idcms_date; ?></span>
  <div id="events">
    <a href="<?php echo site_url('/news/'); ?>" class="button button-primary"><i class="icon-newspaper"></i>News</a>
    <a href="<?php echo site_url('/upcoming-events/'); ?>" class="button button-primary"><i class="icon-calendar"></i>Events</a>
  </div>

  <hr>

  <?php if ( is_user_logged_in() ) { ?>
    <?php $user_id = get_current_user_id(); ?>
    <?php $member  = get_member( $user_id ); ?>
    <p class="greeting">
      <?php echo $member['fullname']; ?>
    </p>
    <p>
      <i class='icon-user-tie'></i><?php echo format_designation($member['designation']); ?><br>
      <i class='icon-briefcase'></i><?php echo $member['office']; ?><br>
      <i class='icon-mobile'></i><?php echo $member['mobile']; ?>
    </p>
  <?php } ?>

  <div class="login">

    <?php if ( !is_user_logged_in() ) { ?>
      <a href="<?php echo site_url('/member-login/');?>" title="Login" class="button button-secondary"><i class="icon-enter"></i>Login</a>
    <?php } else { ?>
      <p>
        <a href="<?php echo site_url('/member-profile/');?>" class="button"><i class="icon-user-tie"></i>Profile</a>
        <a href="<?php echo wp_logout_url( home_url() ); ?>" class="button button-secondary"><i class="icon-exit"></i>Logout</a>
      </p>
    <?php } ?>

  </div><!-- .login -->

  <hr>

  <?php if ( isset($today_names) || isset($tomorrow_names) ) { ?>
    <div id="birthdays">
      <h3 class="title"><i class='icon-gift'></i>Birthdays</h3>
      <?php if ( isset($today_names) ) { ?>
        <div><h4>// Today</h4>
          <ul>
            <?php foreach( $today_names as $today_name ) : ?>
              <li><?php echo $today_name; ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php } ?>
      <?php if ( isset($tomorrow_names) ) { ?>
        <div><h4>// Tomorrow</h4>
          <ul>
            <?php foreach( $tomorrow_names as $tomorrow_name ) : ?>
              <li><?php echo $tomorrow_name; ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php } ?>
    </div><!-- #birthdays -->
  <?php } ?>

</div><!-- #right-sidebar -->

