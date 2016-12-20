<?php
/**
 * @package WordPress
 * @subpackage IDCMS
 */
?>
</div><!-- MAIN CONTENT ENDS -->
<?php
$get_date   = '<span class="day">' . date( "l" ) . '</span><br>' . date( "d F Y" );
$id         = get_current_user_id();
$name_title = esc_attr( get_user_meta( $id, 'name_title', true ) );
$first_name = esc_attr( get_user_meta( $id, 'first_name', true ) );
$last_name  = esc_attr( get_user_meta( $id, 'last_name', true ) );
$desig      = esc_attr( get_user_meta( $id, 'designation', true ) );
$office     = esc_attr( get_user_meta( $id, 'office', true ) );
$mobile     = esc_attr( get_user_meta( $id, 'mobile', true ) );
$full_name  = $name_title . " " . $first_name . " " . $last_name;
$user       = wp_get_current_user();
$role       = implode(',', $user->roles);
$users      = get_users();
$i          = 0;

foreach ($users as $user) {
  $user_id   = $user->ID;
  $birthday  = esc_attr( get_user_meta( $user_id, 'birthday', true ) );
  $birthdate = explode('-', $birthday);
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
  <span class="date"><?php echo $get_date; ?></span>
  <div id="events">
    <a href="/news" class="button button-primary">News</a>&nbsp;
    <a href="/upcoming-events" class="button button-primary">Events</a>
  </div>
  <hr>
  <?php if ( is_user_logged_in() ) { ?>
    <p class="greeting">
    <?php echo $full_name; ?>
    </p>
    <p>
      <?php echo get_designation($desig); ?><br>
      <?php echo $office; ?><br>
      <?php echo "Phone: " . $mobile; ?>
    </p>
  <?php } ?>
  <div class="login"><?php
  if ( !is_user_logged_in() ) { ?>
    <a href="/member-login/" title="Login" class="button button-secondary">Login</a><?php
  } else { ?>
    <p>
      <a href="./member-profile/" class="button">Profile</a>&nbsp;
      <a href="<?php echo wp_logout_url( home_url() ); ?>" class="button button-secondary">Logout</a>
    </p><?php
    if ( $role == 'administrator' ) { ?>
      <a href="/member-register/" class="button button-primary">Add a Member</a><?php
    }
  } ?>
  </div>
  <hr>
  <?php if ( $today_names || $tomorrow_names ) : ?>
    <div id="birthdays">
      <h3 class="title">Birthdays</h3>
      <?php if ( $today_names ) : ?>
        <div>
          <h4>// Today</h4>
          <ul>
            <?php foreach( $today_names as $today_name ) : ?>
              <li><?php echo $today_name; ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <?php if ( $tomorrow_names ) : ?>
        <div>
          <h4>// Tomorrow</h4>
          <ul>
            <?php foreach( $tomorrow_names as $tomorrow_name ) : ?>
              <li><?php echo $tomorrow_name; ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>
    <?php endif; ?>
    </div><!-- #birthdays -->
</div><!-- #right-sidebar -->

