<?php
/**
 * Template Name: Member Profile Edit Page
 * @package WordPress
 * @subpackage IDCMS
 */
?>
<?php check_login(); ?>
<?php get_header(); ?>
<?php get_sidebar( 'left' ); ?>
<?php
//GET MEMBER ID BEFORE ANYTHING ELSE
$id    = get_current_user_id();
$user  = get_userdata( $id );
$email = $user->user_email;
// PROCESS PROFILE
if ( isset( $_POST['submit'] ) ) {
  update_profile_data($id);
}

// PROCESS PICTURE
if ( isset($_POST['upload'] ) ) {
  update_profile_picture($id);
}

$image_url  = esc_attr( get_user_meta( $id, 'image_url', true ) );
$first_name = esc_attr( get_user_meta( $id, 'first_name', true ) );
$last_name  = esc_attr( get_user_meta( $id, 'last_name', true ) );
$mobile_no  = esc_attr( get_user_meta( $id, 'mobile', true ) );
$mes_no     = esc_attr( get_user_meta( $id, 'mesno', true ) );
$set_desig  = esc_attr( get_user_meta( $id, 'designation', true ) );
$set_office = esc_attr( get_user_meta( $id, 'office', true ) );

// BIRTHDAY
$bday  = esc_attr( get_user_meta( $id, 'birthday', true ) );
$bdate = explode( '-', $bday, 3 );
$dob   = $bdate[2];
$mob   = $bdate[1];
$yob   = $bdate[0];

// TOS
$tosd  = esc_attr( get_user_meta( $id, 'tos', true ) );
$tdate = explode( '-', $tosd, 3 );
$dot   = $tdate[2];
$mot   = $tdate[1];
$yot   = $tdate[0];

// SUBSCRIPTION
$sub_status = esc_attr( get_user_meta( $id, 'sub_status', true ) );

?>
<h2 class="title"><?php the_title(); ?></h2>
<hr>
<!-- PICTURE FORM BEGINS -->
<div class="row form__upper-half">
  <div class="three columns">
    <p><img class="u-full-width" src="<?php echo $image_url; ?>" alt="Profile Picture"></p>
    <form id="picture-form" method="POST" action="" enctype="multipart/form-data">
      <input type="file" name="profile-picture" id="profile-picture" class="input-file u-full-width">
      <label class="button" for="profile-picture" title="Choose a picture and press the upload button below">
        <span>Choose Picture</span>
      </label>
      <input type="submit" name="upload" value="Upload" class="button-primary">
    </form>
  </div>
  <!-- PICTURE FORM ENDS -->

  <!-- PROFILE FORM BEGINS -->
  <div class="nine columns">
    <form method="POST" action="" enctype="multipart/form-data">
    <div class="row">
      <div class="form-inline">
        <label for="email">Email ID</label>
        <div class="form-email"><?php echo $email; ?></div>
      </div>
    </div>

    <div class="row">
      <div class="six columns">
        <div class="form-inline">
          <label for="nametitle">Title</label>
          <select name="nametitle" id="nametitle">
            <option value="Shri" <?php if( $selected == "Shri" ) echo "selected"; ?>>Shri</option>
            <option value="Smt" <?php if( $selected == "Smt" ) echo "selected"; ?>>Smt</option>
            <option value="Mr" <?php if( $selected == "Mr" ) echo "selected"; ?>>Mr</option>
            <option value="Mrs" <?php if( $selected == "Mrs" ) echo "selected"; ?>>Mrs</option>
            <option value="Miss" <?php if( $selected == "Miss" ) echo "selected"; ?>>Miss</option>
          </select>
        </div>
        <div class="form-inline">
          <label for="firstname">Firstname</label>
          <input class="u-full-width" type="text" name="firstname" id="firstname" value="<?php echo $first_name; ?>">
        </div>
      </div>
      <div class="six columns">
        <label for="lastname">Lastname</label>
        <input type="text" name="lastname" id="lastname" value="<?php echo $last_name; ?>">
      </div>
    </div>
    <div class="row">
      <div class="six columns">
        <label for="mobile">Mobile Phone</label>
        <input type="number" name="mobile" id="mobile" size="8" value="<?php echo $mobile_no; ?>">
      </div>
      <div class="six columns">
        <label>Date of Birth</label>
        <div class="form-inline">
          <select title="Select a date" name="bdate" id="bdate">
            <?php get_date_options( $dob ); ?>
          </select>
        </div>
        <div class="form-inline">
          <select title="Select a date" name="bmonth" id="bmonth">
            <?php get_month_options( $mob ); ?>
          </select>
        </div>
        <div class="form-inline">
          <select title="Select a year" name="byear" id="byear">
            <?php get_birth_year_options( $yob ); ?>
          </select>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="six columns">
        <p>OFFICE DETAILS</p>
      </div>
    </div>
    <div class="row">
      <div class="six columns">
        <div class="row">

        </div>
        <div class="row">
          <div class="form-inline">
            <label for="mesno">MES Number:</label>
            <input type="number" name="mesno" id="mesno" value="<?php echo $mes_no; ?>">
          </div>
        </div>
        <div class="row">
          <div class="form-inline">
            <label for="designation">Designation</label>
            <select name="designation" id="designation">
              <?php get_designation_options( $set_desig ); ?>
            </select>
          </div>
        </div>
      </div>
      <div class="six columns">
        <label>TOS Date</label>
        <div class="form-inline">
          <select title="Select a date" name="tosdate" id="tos-date">
            <?php get_date_options( $dot ); ?>
          </select>
        </div>
        <div class="form-inline">
          <select title="Select a month" name="tosmonth" id="tos-month">
            <?php get_month_options( $mot ); ?>
          </select>
        </div>
        <div class="form-inline">
          <select title="Select a year" name="tosyear" id="tos-year">
            <?php get_year_options( $yot ); ?>
          </select>
        </div>
        <div class="form-inline">
          <label for="office">Office</label>
          <select name="office" id="office">
            <?php get_office_options( $set_office ); ?>
          </select>
        </div>
      </div>
    </div>
  </div>
</div><!-- .form__upper-half -->

<div class="row form__lower-half">
  <div class="three columns">
    &nbsp;
  </div>
  <div class="nine columns">
    <hr>
    <div class="row">
      <div class="two columns">
        <label>Subscription:</label>
        <label for="sub-status">
          <input type="radio" name="sub-status" value="1" <?php if ( $sub_status == 1 ) echo 'checked'; ?>>
          <span class="label-body">Paid</span>
        </label>
      </div>
      <div class="four columns">
        <label>&nbsp;</label>
        <label class="sub-status">
          <input type="radio" name="sub-status" value="0" <?php if ( $sub_status == 0 ) echo 'checked'; ?>>
          <span class="label-body">Not Paid</span>
        </label>
      </div>
    </div>
    <hr>
  </div>
</div><!-- .form__lower-half -->

<div class="row">
  <p class="save-profile">
    <a class="button" href="../member-profile">Cancel</a>
    <input class="button-primary" type="submit" name="submit" value="Save Profile">
  </p>
  </form>
</div>

<?php get_sidebar('right'); ?>
<?php get_footer(); ?>