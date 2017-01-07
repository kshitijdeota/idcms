<?php
/**
 * @package WordPress
 * @subpackage IDCMS
 */
function idcms_setup() {
  load_theme_textdomain( 'idcms' );
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'title-tag' );
  add_theme_support( 'post-thumbnails' );
  add_image_size( 'idcms-featured-image', 400, 400, true );
  add_image_size( 'idcms-thumbnail-avatar', 200, 200, true );

  // This theme uses wp_nav_menu() in two locations.
  register_nav_menus( array(
    'primary_menu' => __( 'Primary Menu' ),
    'secondary_menu' => __( 'Secondary Menu' ),
  ) );

  add_theme_support( 'html5', array(
    'gallery',
    'caption',
  ) );
  // add_theme_support( 'post-formats', array(
  //   'gallery',
  // ) );
  add_theme_support( 'custom-logo', array(
    'width'       => 200,
    'height'      => 200,
    'flex-width'  => true,
  ) );
  add_theme_support( 'customize-selective-refresh-widgets' );

  remove_filter( 'the_content', 'wpautop' );
  remove_filter( 'the_excerpt', 'wpautop' );
}
add_action( 'after_setup_theme', 'idcms_setup' );


function idcms_scripts() {
  wp_deregister_script( 'wp-embed' );
  wp_deregister_script( 'cropper' );
  wp_deregister_script( 'imagesloaded' );

  wp_deregister_style( 'cropper' );

  wp_enqueue_style( 'skeleton', get_template_directory_uri() . '/css/skeleton.css', array(), '1.0.0', false );
  wp_enqueue_style( 'cropper', get_template_directory_uri() . '/css/cropper.min.css', array('skeleton'), '1.0.0', false );
  wp_enqueue_style( 'default', get_template_directory_uri() . '/style.css', array('skeleton'), '1.0.0', false );
  if ( is_singular( 'photo-archive' ) ) {
    wp_enqueue_style( 'lightgallery',
      get_template_directory_uri() . '/css/lightgallery.min.css', array('default'), '1.0.0', false );
  }
  wp_scripts()->add_data( 'jquery', 'group', 1 );
  wp_scripts()->add_data( 'jquery-core', 'group', 1 );
  wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );

  if ( is_page( 'member-edit' ) ) {
    wp_enqueue_script( 'cropper', get_template_directory_uri() . '/js/cropper.min.js', array('jquery'), '1.0.0', true );
  }

  if ( is_singular( 'photo-archive' ) ) {
    wp_enqueue_script( 'imagesloaded',
      get_template_directory_uri() . '/js/imagesloaded.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'lightgallery',
      get_template_directory_uri() . '/js/lightgallery.min.js', array( 'imagesloaded' ), '1.0.0', true );
  }
  wp_enqueue_script( 'prefix', get_template_directory_uri() . '/js/prefixfree.min.js', array('jquery'), '1.0.0', true );
  wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'idcms_scripts' );


// DISABLE AUTO EMBEDS
remove_filter( 'the_content', array( $GLOBALS['wp_embed'], 'autoembed' ), 8 );

// GALLERY POST TYPE
add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'photo-archive',
    array(
      'labels' => array(
                    'name' => __( 'Photo Archive' ),
                    'singular_name' => __( 'Photo Album' )
                  ),
      'public' => true,
      'has_archive' => true,
      'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
      'Add New' => 'Add New Album',
      'show_in_admin_bar' => true,
    )
  );
}




// REMOVE COMMENT SECTIONS FROM ADMIN
function idcms_remove_admin_menus() {
  remove_menu_page( 'edit-comments.php' );
} // Removes from admin menu
add_action( 'admin_menu', 'idcms_remove_admin_menus' );

function remove_comment_support() {
  remove_post_type_support( 'post', 'comments' );
  remove_post_type_support( 'page', 'comments' );
} // Removes from post and pages
add_action('init', 'remove_comment_support', 100);

function mytheme_admin_bar_render() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu( 'comments' );
} // Removes from admin bar
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );

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
require_once( get_template_directory() . '/inc/theme-functions.php' );
require_once( get_template_directory() . '/inc/theme-widgets.php' );
require_once( get_template_directory() . '/inc/theme-options.php' );

// REMOVE ROLES
function remove_built_in_roles() {
  global $wp_roles;
  $roles_to_remove = array('subscriber', 'contributor', 'author', 'editor');
  foreach ( $roles_to_remove as $role ) {
    if ( isset( $wp_roles->roles[$role] ) )
        $wp_roles->remove_role($role);
  }
}
add_action( 'admin_menu', 'remove_built_in_roles' );

add_filter( 'pre_option_default_role', function( $default_role ) {
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
$roles = array( 'President', 'Vice President', 'Secretary', 'Jt. Secretary', 'Treasurer', 'Council Member', 'Member' );
$args  = array( 'read' => true, 'level_0' => true );
foreach ( $roles as $role ) {
  if ( !role_exists( $role ) )
    add_role( $role, $role, $args );
}

//REPLACE DEFAULT AUTHENTICATION
remove_filter('authenticate', 'wp_authenticate_username_password', 20);
add_filter('authenticate', function($user, $email, $password) {
  if ( empty( $email ) || empty ( $password ) ) {
    $error = new WP_Error();
    if ( empty( $email ) )
      $error->add('empty_username', __('<strong>ERROR</strong>: Email field is empty.'));
    elseif ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) )
      $error->add('invalid_username', __('<strong>ERROR</strong>: Email is invalid.'));
    if( empty( $password ) )
      $error->add('empty_password', __('<strong>ERROR</strong>: Password field is empty.'));
    return $error;
  }

  $user = get_user_by('email', $email);

  if( ! $user ) {
    $error = new WP_Error();
    $error->add( 'invalid', __( '<strong>ERROR</strong>: Either the email or password you entered is invalid.' ) );
    return $error;
  } else {
    if( ! wp_check_password( $password, $user->user_pass, $user->ID ) ) { //bad password
      $error = new WP_Error();
      $error->add( 'invalid', __( '<strong>ERROR</strong>: Either the email or password you entered is invalid.' ) );
      return $error;
    } else {
      return $user;
    }
  }
}, 20, 3);

function upload_rename_filter( $file ){
  $temp = explode( '.', $file['name'] );
  $file['name'] = round( microtime( true ) ). '.' . end( $temp );
  return $file;
}
add_filter( 'wp_handle_upload_prefilter', 'upload_rename_filter' );

// REDIRECT AFTER LOGIN
function admin_default_page() {
  return '../';
}
add_filter( 'login_redirect', 'admin_default_page' );

// DISABLE DASHBORD FOR ALL
function disable_dashboard() {
  if ( ! is_user_logged_in() )
    return null;
  if ( ! current_user_can( 'administrator' ) && is_admin() ) {
    wp_redirect( home_url() );
    exit;
  }
}
add_action('admin_init', 'disable_dashboard');

// REMOVE ADMIN-BAR FOR ALL
function remove_admin_bar() {
  if ( ! current_user_can('administrator') && ! is_admin() )
    show_admin_bar( false );
}
add_action('after_setup_theme', 'remove_admin_bar');

// $users = get_users();
// if (!empty($users)) {
// foreach ($users as $user) {
//     $designation = $user->designation;
//     if( 'AE' == $designation )
//       update_user_meta( $user->ID, 'designation', '4', false );
//   }
// }