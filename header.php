<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <link href="" rel="stylesheet" type="text/css">
  <link rel="icon" type="image/jpg" href="<?php echo get_template_directory_uri();?>/images/favicon.png">
  <script type="text/javascript">
    var templateUrl = '<?php echo get_template_directory_uri(); ?>/images/';
  </script>
  <?php wp_head(); ?>
</head>
<body>
  <div class="full-width-container">
    <header id="header">
      <div class="row">
        <div class="header-left">
          <img src="<?php echo get_template_directory_uri();?>/images/flag.gif">
        </div>
        <div class="header-center">
          <div id="branding">
            <a href="<?php echo site_url(); ?>" id="logo-primary">
              <h1>INDIAN DEFENCE CONTRACT MANAGEMENT SERVICE OFFICERS ASSOCIATION</h1>
            </a>
          </div>
        </div>
        <div class="header-right">
          <img src="<?php echo get_template_directory_uri();?>/images/logo2.jpg" id="logo-secondary" alt="">
        </div>
      </div>
    </header>
    <div class="row">
