<?php

function create_member() {

  $input = $_POST;
  $date = date("Y-m-d");
  $pass = wp_generate_password( 12, false );
  $email = $input['email'];

  if( !email_exists( $email ) ) {

    $user_id = wp_insert_user( array(
      'display_name'  => $input['firstname'] . ' ' . $input['lastname'],
      'nickname'      => $input['firstname'] . ' ' . $input['lastname'],
      'user_nicename' =>  $input['firstname'],
      'first_name'    => $input['firstname'],
      'last_name'     =>  $input['lastname'],
      'user_email'    => $input['email'],
      'user_login'    => $input['email'],
      'user_pass'     => $pass ) );

    $values = array(
      'name_title' => $input['nametitle'],
      'mesno' => $input['mesno'],
      'mobile' => '0000000000',
      'designation' => $input['designation'],
      'office' => 'N.A.',
      'tos' => '2001-01-01',
      'stdcode' => '0000',
      'phone' => '0000000',
      'birthday' => '1995-01-01',
      'sub_status' => '0',
      'image_url' => '/wp-content/themes/idcms/images/placeholder.png' );

    foreach( $values as $value => $key ) {
      esc_attr( update_user_meta( $user_id, $value, $key, '' ) );
    }

    // Fix unknown bug that won't insert 'role' at wp_insert_user()
    wp_update_user( array ( 'ID' => $user_id, 'role' => 'Member' ) ) ;

    if ( !is_wp_error( $user_id ) )
      echo '<div class="message success">New Member Added!</div>';
    else
      echo get_error_messages();

  } else {

    echo '<div class="message error">User with that Email already exists</div>';

  }

}

function get_current_member_id() {

  global $current_user, $user_id;
  if ( is_user_logged_in() ) :
    $current_user = wp_get_current_user();
    $user_id = $current_user->ID;
    return $user_id;
  endif;
}

function get_member($user_id) {

  $data = get_userdata($user_id);
  $member_keys = array( 'image_url', 'name_title', 'first_name', 'last_name', 'designation', 'sub_status',
                 'office', 'mobile', 'mesno', 'tos', 'birthday', 'phone', 'stdcode' );

  foreach( $member_keys as $key )
    $member[$key] = esc_attr( get_user_meta($user_id, $key, true) );

  $member['member_id'] = $user_id;
  $member['email'] = esc_attr( $data->user_email );
  $member['image'] = $member['image_url'];
  $member['status'] = $member['sub_status'];
  $member['fullname'] = $member['name_title'] . " " . $member['first_name'] . " " . $member['last_name'];
  return $member;
}

function update_member($user_id) {

  $input = $_POST;
  $user_id = $input['member_id'];
  $input['birthday'] = $input['byear']. '-' .$input['bmonth']. '-' .$input['bdate'];
  $input['tos'] = $input['tosyear']. '-' .$input['tosmonth']. '-' .$input['tosdate'];

  $values = array( 'name_title', 'first_name', 'last_name', 'mesno', 'mobile',
    'designation', 'office', 'tos', 'stdcode', 'phone', 'birthday', 'sub_status' );

  foreach( $values as $value )
    esc_attr( update_user_meta( $user_id, $value, $input[$value], '' ) );

  echo '<div class="message success">Profile Updated!</div>';
}

function update_member_picture() {

  if ( ! function_exists( 'wp_handle_upload' ) )
    require_once( ABSPATH . 'wp-admin/includes/file.php' );

  $user_id = $_POST['member_id'];
  $uploadedfile = $_FILES['picture-input'];
  $upload_overrides = array( 'test_form' => false );
  $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

  if ($movefile && !isset($movefile['error'])) {

    $movefile = parse_url($movefile['url']);
    $movefile = $movefile['path'];
    $path = wp_normalize_path(ABSPATH . $movefile);

    $dataX           = $_POST['dataX'];
    $dataY           = $_POST['dataY'];
    $dataWidth       = $_POST['dataWidth'];
    $dataHeight      = $_POST['dataHeight'];
    $dataAngle       = $_POST['dataAngle'];
    $dataScaleX      = $_POST['dataScaleX'];
    $dataScaleY      = $_POST['dataScaleY'];

    $image_editor = wp_get_image_editor($path);
    $image_editor->set_quality( 80 );
    $image_editor->rotate($dataAngle);
    $image_editor->crop( $dataX, $dataY, $dataWidth, $dataHeight, false );
    $image_editor->resize( 200, 200, false );
    $saved = $image_editor->save($path);
    $profile_image = esc_attr( get_user_meta( $user_id, 'image_url', true ) );

    if ( $profile_image !== '/wp-content/themes/idcms/images/placeholder.png' ) {
      $oldfile = ABSPATH . $profile_image;

      if ( file_exists($oldfile) )
        unlink ( $oldfile );
    }

    $updated_image = update_user_meta($user_id, 'image_url', $movefile);
    echo '<div class="message success">Profile picture updated.</div>';

  } else {

    echo '<div class="message error">' . $saved['error'] . '</div>';
    echo '<div class="message error">' . $movefile['error'] . '</div>';

  }

}

function check_login() {

  if ( !is_user_logged_in()) :
      wp_redirect( './member-login/' );
      exit;
  endif;
}

function date_options($option, $default) {

  if ( $option === 'dates' ) :
    for ( $date = 1; $date < 32; $date += 1 ) {
      $output_dates  = '<option value="' . $date . '"';
      if ( $default == $date ) { $output_dates .= "selected"; }
      $output_dates .= '>' . $date . '</option>';
      echo $output_dates;
    }
  endif;

  if ( $option === 'months' ) :
    $months = array( 'Jan' => '1', 'Feb' => '2', 'Mar' => '3', 'Apr' => '4', 'May' => '5',
              'Jun' => '6', 'Jul' => '7', 'Aug' => '8', 'Sep' => '9', 'Oct' => '10',
              'Nov' => '11', 'Dec' => '12' );
    foreach ( $months as $month => $value ) {
      $output_months  = '<option value="' . $value . '"';
      if ( $default == $value ) { $output_months .= "selected"; }
      $output_months .= '>' . $month . '</option>';
      echo $output_months;
    }
  endif;

  if ( $option === 'years' ) :
    foreach (range(date('Y'), (date('Y')-15)) as $year) {
      $output_years  = '<option value="' . $year . '"';
      if ( $default == $year ) { $output_years .= "selected"; }
      $output_years .= '>' . $year . '</option>';
      echo $output_years;
    }
  endif;

  if ( $option === 'birthyears' ) :
    foreach (range(date('Y')-20, (date('Y')-65)) as $year) {
      $output_birthyears  = '<option value="' . $year . '"';
      if ( $default == $year ) { $output_birthyears .= "selected"; }
      $output_birthyears .= '>' . $year . '</option>';
      echo $output_birthyears;
    }
  endif;
}

function designation_options($set_desig) {

  $desigs = array(
    'AD' => 'ADG (QS&C)',
    'CE' => 'CE (QS&C)',
    'SE' => 'SE (QS&C)',
    'EE' => 'EE (QS&C)',
    'AE' => 'AEE (QS&C)' );

  foreach ( $desigs as $desig => $value ) {
    $output = '<option value="'. $desig .'"';
    if( $desig == $set_desig )
      $output .= "selected";

    $output .= '>'. $value . '</option>';
    echo $output;
  }
}

function office_options($set_office) {

  $offices = file(get_template_directory_uri().'/office-list.txt');
  $output = '';
  foreach ( $offices as $office ) {
    $output .= '<option value="' . $office . '"';
    if( $office == $set_office )
      $output .= "selected";

    $output .= '>' . $office . '</option>';
  }
  echo $output;
}

function format_designation( $get_desig ) {

  $desigs = array(
    'AD' => 'ADG (QS&C)',
    'CE' => 'CE (QS&C)',
    'SE' => 'SE (QS&C)',
    'EE' => 'EE (QS&C)',
    'AE' => 'AEE (QS&C)' );

  foreach ( $desigs as $desig => $value ) {
    if ( $get_desig == $desig )
      return $value;

  }
}

function format_date($default) {

  $date = date_create($default);
  return date_format($date,"d M Y");
}
