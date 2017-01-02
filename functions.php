<?php
/**
 * @package WordPress
 * @subpackage YOUR_THEME
 */
function idcms_scripts() {

  wp_deregister_script( 'wp-embed' );
  wp_deregister_script( 'cropper' );
  wp_deregister_style( 'cropper' );
  // wp_enqueue_style( 'fonts', '//fonts.googleapis.com/css?family=Raleway:400,300,600', false );
  wp_enqueue_style( 'skeleton', get_template_directory_uri() . '/css/skeleton.css', array(), '1.0.0', false );
  wp_enqueue_style( 'cropper', get_template_directory_uri() . '/css/cropper.min.css', array('skeleton'), '1.0.0', false );
  wp_enqueue_style( 'default', get_template_directory_uri() . '/style.css', array('skeleton'), '1.0.0', false );
  // Move jQuery to the footer
  wp_scripts()->add_data( 'jquery', 'group', 1 );
  wp_scripts()->add_data( 'jquery-core', 'group', 1 );
  wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );
  wp_enqueue_script( 'cropper', get_template_directory_uri() . '/js/cropper.min.js', array('jquery'), '1.0.0', true );
  wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'idcms_scripts' );

// DISABLE AUTO EMBEDS
remove_filter( 'the_content', array( $GLOBALS['wp_embed'], 'autoembed' ), 8 );

// GALLERY POST TYPE
add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'photo-gallery',
    array(
      'labels' => array(
                    'name' => __( 'Photo Galleries' ),
                    'singular_name' => __( 'Photo Gallery' )
                  ),
      'public' => true,
      'has_archive' => true,
    )
  );
}

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// REMOVE DEFAULT GALLERY STYLES
add_filter( 'use_default_gallery_style', '__return_false' );

// REGISTER ADMIN STYLESHEETS
function custom_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/login/login-styles.css' );
}
add_action( 'login_enqueue_scripts', 'custom_login_stylesheet' );

// INCLUDE THEME SPECIFIC FILES
require_once(get_template_directory() . '/inc/theme-functions.php');
require_once(get_template_directory() . '/inc/theme-widgets.php');
require_once(get_template_directory() . '/inc/theme-options.php');

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

// ADD MEMBER ROLES
$roles = array(
  'President', 'Vice President', 'Secretary', 'Jt. Secretary', 'Treasurer', 'Council Member', 'Member' );
$args  = array(
  'read' => true, 'level_0' => true );

foreach ( $roles as $role ) {
  if ( !role_exists( $role ) ) {
    add_role( $role, $role, $args );
  }
}

//REPLACE DEFAULT AUTHENTICATION
remove_filter('authenticate', 'wp_authenticate_username_password', 20);
add_filter('authenticate', function($user, $email, $password) {

  if(empty($email) || empty ($password)){
    $error = new WP_Error();

    if(empty($email))
      $error->add('empty_username', __('<strong>ERROR</strong>: Email field is empty.'));

    else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
      $error->add('invalid_username', __('<strong>ERROR</strong>: Email is invalid.'));

    if(empty($password))
      $error->add('empty_password', __('<strong>ERROR</strong>: Password field is empty.'));

    return $error;
  }

  $user = get_user_by('email', $email);

  if(!$user) {

    $error = new WP_Error();
    $error->add('invalid', __('<strong>ERROR</strong>: Either the email or password you entered is invalid.'));
    return $error;

  } else {

    if(!wp_check_password($password, $user->user_pass, $user->ID)){ //bad password

      $error = new WP_Error();
      $error->add('invalid', __('<strong>ERROR</strong>: Either the email or password you entered is invalid.'));
      return $error;

    } else {

      return $user;
    }
  }
}, 20, 3);

function upload_rename_filter( $file ){

  $temp = explode('.', $file['name']);
  $file['name'] = round(microtime(true)). '.' . end($temp);
  return $file;
}
add_filter('wp_handle_upload_prefilter', 'upload_rename_filter' );

// REDIRECT AFTER LOGIN
function admin_default_page() {

  return '../';
}
add_filter('login_redirect', 'admin_default_page');

// DISABLE DASHBORD FOR ALL
// function disable_dashboard() {

//   if ( !is_user_logged_in() )
//     return null;

//   if ( !current_user_can('administrator') && is_admin() ) {
//       wp_redirect( home_url() );
//     exit;
//   }
// }
// add_action('admin_init', 'disable_dashboard');

// REMOVE ADMIN-BAR FOR ALL
function remove_admin_bar() {

  if ( !current_user_can('administrator') && !is_admin() )
    show_admin_bar( false );
}
add_action('after_setup_theme', 'remove_admin_bar');



// $users = get_users();
// if (!empty($users)) {
//   foreach ($users as $user) {
//       add_user_meta( $user->id, 'stdcode', '0000', true );
//   }
// }