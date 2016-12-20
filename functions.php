<?php
/**
 * @package WordPress
 * @subpackage YOUR_THEME
 */
function idcms_scripts() {

  wp_deregister_script( 'wp-embed' );
  // wp_enqueue_style( 'fonts', '//fonts.googleapis.com/css?family=Raleway:400,300,600', false );
  wp_enqueue_style( 'skeleton', get_template_directory_uri() . '/css/skeleton.css', array(), '1.0.0', false );
  wp_enqueue_style( 'default', get_template_directory_uri() . '/style.css', array('skeleton'), '1.0.0', false );
  // Move jQuery to the footer
  wp_scripts()->add_data( 'jquery', 'group', 1 );
  wp_scripts()->add_data( 'jquery-core', 'group', 1 );
  wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );
  wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'idcms_scripts' );

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// REGISTER ADMIN STYLESHEETS
function custom_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/login/login-styles.css' );
}
add_action( 'login_enqueue_scripts', 'custom_login_stylesheet' );

// NAVIGATION
register_nav_menus( array(
    'primary_menu' => 'Primary Menu',
    'secondary_menu' => 'Secondary Menu'
  ));

// REMOVE ROLES
function remove_built_in_roles() {
    global $wp_roles;
    $roles_to_remove = array('subscriber', 'contributor', 'author', 'editor');
    foreach ($roles_to_remove as $role) {
        if (isset($wp_roles->roles[$role])) {
            $wp_roles->remove_role($role);
        }
    }
}
add_action('admin_menu', 'remove_built_in_roles');

add_filter('pre_option_default_role', function( $default_role ) {
    return 'Member'; // This is changed
    return $default_role; // This allows default
} );

function role_exists( $role ) {
  // Set default role
  if( ! empty( $role ) ) {
    return $GLOBALS['wp_roles']->is_role( $role );
  }
  return false;
}

// Add custom user roles
$roles = array('President', 'Vice President', 'Secretary', 'Jt. Secretary', 'Treasurer', 'Council Member', 'Member' );
$args  = array( 'read' => true, 'level_0' => true );
foreach ( $roles as $role ) {
  if ( !role_exists( $role ) ) {
    add_role( $role, $role, $args );
  }
}

//remove wordpress authentication
remove_filter('authenticate', 'wp_authenticate_username_password', 20);

add_filter('authenticate', function($user, $email, $password){
  //Check for empty fields
  if(empty($email) || empty ($password)){
      //create new error object and add errors to it.
      $error = new WP_Error();
      if(empty($email)){ //No email
          $error->add('empty_username', __('<strong>ERROR</strong>: Email field is empty.'));
      }
      else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ //Invalid Email
          $error->add('invalid_username', __('<strong>ERROR</strong>: Email is invalid.'));
      }
      if(empty($password)){ //No password
          $error->add('empty_password', __('<strong>ERROR</strong>: Password field is empty.'));
      }
      return $error;
  }
  //Check if user exists in WordPress database
  $user = get_user_by('email', $email);
  //bad email
  if(!$user){
      $error = new WP_Error();
      $error->add('invalid', __('<strong>ERROR</strong>: Either the email or password you entered is invalid.'));
      return $error;
  }
  else{ //check password
      if(!wp_check_password($password, $user->user_pass, $user->ID)){ //bad password
          $error = new WP_Error();
          $error->add('invalid', __('<strong>ERROR</strong>: Either the email or password you entered is invalid.'));
          return $error;
      }else{
          return $user; //passed
      }
  }
}, 20, 3);

//CHECK LOGIN
function check_login() {
  if ( !is_user_logged_in()) {
      wp_redirect( './member-login/' );
      exit;
  }
}

//CHECK ADMIN LOGIN
function check_admin_login($member_role) {
  if ( !is_user_logged_in() && $member_role != 'administrator' ) {
    wp_redirect( './member-login/' );
    exit;
  }
}

// FORM FUNCTIONS
function get_date_options($dob) {
  for ( $date = 1; $date < 32; $date += 1 ) {
    $output  = '<option value="' . $date . '"';
    if ( $dob == $date ) { $output .= "selected"; }
    $output .= '>' . $date . '</option>';
    echo $output;
  }
}

function get_month_options($mob) {
  $months = array( 'Jan' => '1', 'Feb' => '2', 'Mar' => '3', 'Apr' => '4', 'May' => '5', 'Jun' => '6', 'Jul' => '7', 'Aug' => '8', 'Sep' => '9', 'Oct' => '10', 'Nov' => '11', 'Dec' => '12' );
  foreach ( $months as $month => $value ) {
    $output  = '<option value="' . $value . '"';
    if ( $mob == $value ) { $output .= "selected"; }
    $output .= '>' . $month . '</option>';
    echo $output;
  }
}

function get_year_options($yot) {
  foreach ( range( date('Y'), ( date('Y')-6 ) ) as $year ) {
    $output  = '<option value="' . $year . '"';
    if ( $yot == $year ) { $output .= "selected"; }
    $output .= '>' . $year . '</option>';
    echo $output;
  }
}

function get_birth_year_options($yob) {
  foreach (range(date('Y')-20, (date('Y')-65)) as $year) {
    $output  = '<option value="' . $year . '"';
    if ( $yob == $year ) { $output .= "selected"; }
    $output .= '>' . $year . '</option>';
    echo $output;
  }
}

function get_designation_options($set_desig) {
  $desigs = array(
    'AD' => 'ADG (QS&C)',
    'CE' => 'CE (QS&C)',
    'SE' => 'SE (QS&C)',
    'EE' => 'EE (QS&C)',
    'AE' => 'AEE (QS&C)'
  );
  foreach ( $desigs as $desig => $value ) {
    $output = '<option value="'. $desig .'"';
    if( $desig == $set_desig ) {
      $output .= "selected";
    }
    $output .= '>'. $value . '</option>';
    echo $output;
  }
}

function get_office_options($set_office) {
  $offices = file(get_template_directory_uri().'/office-list.txt');
  $output = '';
  foreach ( $offices as $office ) {
    $output .= '<option value="' . $office . '"';
    if( $office == $set_office ) {
      $output .= "selected";
    }
    $output .= '>' . $office . '</option>';
  }
  echo $output;
}

function get_designation( $get_desig ) {
  $desigs = array(
    'AD' => 'ADG (QS&C)',
    'CE' => 'CE (QS&C)',
    'SE' => 'SE (QS&C)',
    'EE' => 'EE (QS&C)',
    'AE' => 'AEE (QS&C)'
  );
  foreach ( $desigs as $desig => $value ) {
    if ( $get_desig == $desig ) {
      return $value;
    }
  }
}

function add_member() {
  $input   = $_POST;
  $date    = date("Y-m-d");
  $pass    = wp_generate_password( 12, false );
  $user_id = wp_insert_user(
    array(
      'display_name'  =>  $input['firstname'] . ' ' . $input['lastname'],
      'nickname'      =>  $input['firstname'] . ' ' . $input['lastname'],
      'user_nicename' =>  $input['firstname'],
      'first_name'    =>  $input['firstname'],
      'last_name'     =>  $input['lastname'],
      'user_email'    =>  $input['email'],
      'user_login'    =>  $input['email'],
      'user_pass'     =>  $pass
    )
  );
  update_user_meta( $user_id, 'image_url', '/wp-content/themes/idcms/images/placeholder.png' );
  update_user_meta( $user_id, 'office', 'HQ 136 WORKS ENGINEER' );
  update_user_meta( $user_id, 'designation', $input['office'] );
  update_user_meta( $user_id, 'name_title', $input['nametitle'] );
  update_user_meta( $user_id, 'mesno', $input['mesno'] );
  update_user_meta( $user_id, 'birthday', '1990-12-31' );
  update_user_meta( $user_id, 'mobile', '1234567890' );
  update_user_meta( $user_id, 'sub_status', '0' );
  update_user_meta( $user_id, 'tos', $date );
  wp_update_user( array ('ID' => $user_id, 'role' => 'Member') ) ;
  if ( !is_wp_error( $user_id ) ) {
    echo '<div class="message success">New Member Added!</div>';
  }
}

function update_profile_picture($id) {
  if ( ! function_exists( 'wp_handle_upload' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
  }
  $uploadedfile = $_FILES['profile-picture'];
  $upload_overrides = array( 'test_form' => false );
  $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
  if ( $movefile && !isset( $movefile['error'] ) ) {
    $movefile = parse_url($movefile['url']);
    $movefile = $movefile['path'];

    $profile_image = esc_attr( get_user_meta( $id, 'image_url', true ) );
    $path = ABSPATH . esc_attr( $movefile );
    $image_editor = wp_get_image_editor($path);
    $image_editor->resize(200, 200);
    $saved = $image_editor->save($path);
    if ( $profile_image != '/wp-content/themes/idcms/images/placeholder.png' ) {
      $oldfile = ABSPATH . $profile_image;
      if ( file_exists($oldfile) ) {
        unlink ( $oldfile );
      }
    }
    $updated_image = update_usermeta( $id, 'image_url', $movefile );
    echo '<div class="message success">Profile picture updated.</div>';
  } else {
    echo '<div class="message error">' . $movefile['error'] . '</div>';
  }
}

function update_profile_data($id) {
  $birthday            = $_POST['byear']. '-' .$_POST['bmonth']. '-' .$_POST['bdate'];
  $tos                 = $_POST['tosyear']. '-' .$_POST['tosmonth']. '-' .$_POST['tosdate'];
  $updated_firstname   = update_usermeta( $id, 'name_title', $_POST['nametitle'] );
  $updated_firstname   = update_usermeta( $id, 'first_name', $_POST['firstname'] );
  $updated_lastname    = update_usermeta( $id, 'last_name', $_POST['lastname'] );
  $updated_mesno       = update_usermeta( $id, 'mesno', $_POST['mesno'] );
  $updated_mobile      = update_usermeta( $id, 'mobile', $_POST['mobile'] );
  $updated_designation = update_usermeta( $id, 'designation', $_POST['designation'] );
  $updated_office      = update_usermeta( $id, 'office', $_POST['office'] );
  $updated_tos         = update_usermeta( $id, 'tos', $tos );
  $updated_stdcode     = update_usermeta( $id, 'stdcode', $_POST['stdcode'] );
  $updated_phone       = update_usermeta( $id, 'phone', $_POST['phone'] );
  $updated_bdate       = update_usermeta( $id, 'birthday', $birthday );
  $updated_substatus   = update_usermeta( $id, 'sub_status', $_POST['sub-status'] );
  echo '<div class="message success">Profile Updated!</div>';
}

// REDIRECT AFTER LOGIN
function admin_default_page() {
  return '../';
}
add_filter('login_redirect', 'admin_default_page');

// DISABLE DASHBORD FOR ALL
function disable_dashboard() {
    if ( !is_user_logged_in() ) {
        return null;
    }
    if ( !current_user_can('administrator') && is_admin() ) {
        wp_redirect( home_url() );
        exit;
    }
}
add_action('admin_init', 'disable_dashboard');

// REMOVE ADMIN-BAR FOR ALL
function remove_admin_bar() {
  if ( !current_user_can('administrator') && !is_admin() ) {
    show_admin_bar( false );
  }
}
add_action('after_setup_theme', 'remove_admin_bar');