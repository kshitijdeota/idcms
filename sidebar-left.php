<?php
/**
 * @package WordPress
 * @subpackage IDCMS
 */
?>
<?php

$president = get_users( array( 'role' => 'President' ) );
$image_url = $president[0]->image_url;
$name_title = $president[0]->name_title;
$first_name = $president[0]->first_name;
$last_name = $president[0]->last_name;
$full_name = $name_title . " " . $first_name . " " . $last_name;
$desig = $president[0]->designation;
$office = $president[0]->office;

?>
<div id="sidebar-left">
  <div id="navigation">
    <?php wp_nav_menu('primary') ?>
    <ul class="secondary">
      <li><a href="#">SENIORITY LIST</a>
        <ul class="subnav">
          <li><a href="seniority-adg.php">ADG (QS&amp;C)</a></li>
          <li><a href="seniority-ce.php">CE (QS&amp;C)</a></li>
          <li><a href="seniority-se.php">SE (QS&amp;C)</a></li>
          <li><a href="seniority-ee.php">EE (QS&amp;C)</a></li>
          <li><a href="seniority-aee.php">AEE (QS&amp;C)</a></li>
        </ul>
      </li>
      <li><a href="#">PROMOTIONS</a>
        <ul class="subnav">
          <li><a href="promo-ce-adg.php">CE to ADG</a></li>
          <li><a href="promo-se-ce.php">SE to CE</a></li>
          <li><a href="promo-ee-se.php">EE to SE</a></li>
          <li><a href="promo-aee-ee.php">AEE to EE</a></li>
        </ul>
      </li>
      <li><a href="#">POSTINGS</a>
        <ul class="subnav">
          <li><a href="postings-adg.php">ADG (QS&amp;C)</a></li>
          <li><a href="postings-ce.php">CE (QS&amp;C)</a></li>
          <li><a href="postings-se.php">SE (QS&amp;C)</a></li>
          <li><a href="postings-ee.php">EE (QS&amp;C)</a></li>
          <li><a href="postings-aee.php">AEE (QS&amp;C)</a></li>
        </ul>
      </li>
    </ul>
  </div>
  <div id="president">
    <h3>PRESIDENT - IDCMSOA</h3>
    <img src="<?php echo $image_url; ?>" alt="">
    <p>
      <?php echo "<span>" . $full_name . "</span>"; ?>
      <?php echo format_designation($desig); ?><br />
      <?php echo $office; ?><br />
    </p>
    <a href="./presidents-message/" class="button button-primary">President's Message</a>
  </div>
</div><!-- #left-sidebar -->

<!-- MAIN CONTENT STARTS -->
<div id="content">
