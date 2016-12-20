<?php
/**
 * Template Name: Member Register Page
 * @package WordPress
 * @subpackage IDCMS
 */
?>
<?php $member_role = $current_user->roles[0]; ?>
<?php check_admin_login( $member_role ); ?>
<?php get_header(); ?>
<?php get_sidebar('left'); ?>
<h2 class="title"><?php the_title(); ?></h2>
<hr>
<?php
// REGISTER A NEW MEMBER
if ( isset($_POST['add-member']) ) {
  add_member();
} ?>

<form method="POST" action="" enctype="multipart/form-data">
  <div class="row">
    <div class="form-inline">
      <label for="email">Email</label>
      <input type="email" name="email" id="email">
    </div>
    <div class="form-inline">
      <label for="mesno">MES Number:</label>
      <input type="number" name="mesno" id="mesno">
    </div>
  </div>

  <div class="row">
    <div class="form-inline">
      <label for="nametitle">Title</label>
      <select name="nametitle" id="nametitle">
        <option value="Shri">Shri</option>
        <option value="Smt">Smt</option>
        <option value="Mr">Mr</option>
        <option value="Mrs">Mrs</option>
        <option value="Miss">Miss</option>
      </select>
    </div>
    <div class="form-inline">
      <label for="firstname">Firstname</label>
      <input type="text" name="firstname" id="firstname">
    </div>
    <div class="form-inline">
      <label for="lastname">Lastname</label>
      <input type="text" name="lastname" id="lastname">
    </div>
  </div>

  <div class="row">
    <div class="four columns">
      <label for="designation">Designation</label>
      <select name="designation" id="designation">
        <?php get_designation_options($d); ?>
      </select>
    </div>
  </div>

  <div class="row">
    <label for="">&nbsp;</label>
    <input type="submit" name="add-member" id="add-member" value="Add Member" class="button-primary">
  </div>
</form>

<?php get_sidebar('right'); ?>
<?php get_footer(); ?>