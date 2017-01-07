<?php

global $user_id;
global $member;
global $tosd;
global $bday;

?>

<form method="POST" action="" name="profile-form" enctype="multipart/form-data">

  <h2 class="title">Personal Details</h2>

  <div class="row">
    <span><i class='icon-envelop'></i>Email ID :</span><span><?php echo $member['email']; ?></span>
    <input type="hidden" name="member-id" id="member-id" value="<?php echo $member['ID']; ?>">
  </div>

  <div class="row">
    <span>
      <label for="nametitle">Title</label>
      <select name="name_title" id="nametitle">
        <option value="Shri" <?php if( $member['name_title'] == "Shri" ) echo "selected"; ?>>Shri</option>
        <option value="Smt" <?php if( $member['name_title'] == "Smt" ) echo "selected"; ?>>Smt</option>
        <option value="Mr" <?php if( $member['name_title'] == "Mr" ) echo "selected"; ?>>Mr</option>
        <option value="Mrs" <?php if( $member['name_title'] == "Mrs" ) echo "selected"; ?>>Mrs</option>
        <option value="Miss" <?php if( $member['name_title'] == "Miss" ) echo "selected"; ?>>Miss</option>
      </select>
    </span>
    <span>
      <label for="firstname">Firstname</label>
      <input type="text" name="first_name" id="firstname" value="<?php echo $member['first_name']; ?>">
    </span>
    <span>
      <label for="lastname">Lastname</label>
      <input type="text" name="last_name" id="lastname" value="<?php echo $member['last_name']; ?>">
    </span>
  </div>
  <div class="row">
    <span>
      <label for="mobile"><i class='icon-mobile'></i>Mobile Phone</label>
      <input type="number" name="mobile" id="mobile" size="8" value="<?php echo $member['mobile']; ?>">
    </span>
    <span>
      <label><i class='icon-gift'></i>Date of Birth</label>
      <select title="Select a date" name="bdate" id="bdate">
        <?php date_options( 'dates', $bday[2]  ); ?>
      </select>
      <select title="Select a date" name="bmonth" id="bmonth">
        <?php date_options( 'months', $bday[1] ); ?>
      </select>
      <select title="Select a year" name="byear" id="byear">
        <?php date_options( 'birthyears', $bday[0] ); ?>
      </select>
    </span>
  </div>

  <hr>

  <h2 class="title">Office Details</h2>
  <div class="row">
    <span>
      <label for="mesno"><i class='icon-shield'></i>MES Number:</label>
      <input type="number" name="mesno" id="mesno" value="<?php echo $member['mesno']; ?>">
    </span>
    <span>
      <label for="designation"><i class='icon-user-tie'></i>Designation</label>
      <select name="designation" id="designation">
        <?php designation_options($member['designation']); ?>
      </select>
    </span>
    <span>
      <label><i class='icon-calendar'></i>Present TOS Date</label>
      <select title="Select a date" name="tosdate" id="tos-date">
        <?php date_options( 'dates', $tosd[2] ); ?>
      </select>
      <select title="Select a month" name="tosmonth" id="tos-month">
        <?php date_options( 'months', $tosd[1] ); ?>
      </select>
      <select title="Select a year" name="tosyear" id="tos-year">
        <?php date_options( 'years', $tosd[0] ); ?>
      </select>
    </span>
    <span>
      <label for="office"><i class='icon-briefcase'></i>Office</label>
      <select name="office" id="office">
        <?php office_options( $member['office'] ); ?>
      </select>
    </span>
  </div>
  <div class="row">
    <span>
      <label for="stdcode"><i class='icon-phone'></i>STD Code</label>
      <input type="number" name="stdcode" id="stdcode" size="8" value="<?php echo $member['stdcode']; ?>">
    </span>
    <span>
      <label for="phone"><i class='icon-phone'></i>Office Phone</label>
      <input type="number" name="phone" id="phone" size="8" value="<?php echo $member['phone']; ?>">
    </span>
  </div>

  <hr>

  <div class="row">
    <div class="four columns">
      <p>Subscription:</p>
      <label class="radio" for="sub-status">
        <input type='radio' class='sub-status' name='sub_status' value='1' <?php if($member['status']==1) { echo "checked='checked'"; } ?>>
        <span class='label-body'>Paid</span>
      </label>

      <label class="radio" for="sub-status">
        <input type='radio' class='sub-status' name='sub_status' value='0' <?php if($member['status']==0) { echo "checked='checked'"; } ?>>
        <span class="label-body">Not Paid</span>
      </label>

    </div>
  </div>
  <hr>

  <div class="row">
    <p class="save-profile">
      <a class="button" href="<?php site_url( '/member-profile/', null ); ?>"><i class="icon-cancel-circle"></i>Cancel</a>
      <button class="button-primary" type="submit" name="profile-submit"><i class="icon-floppy-disk"></i>Save Profile</button>
    </p>
  </div>

</form>