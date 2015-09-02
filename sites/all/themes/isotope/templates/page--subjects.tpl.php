<?php
  // 1728148 drupal page.tpl.php
  global $base_url;
  $theme_url = $base_url.'/sites/all/themes/isotope/images/';
  global $user;
  $logged_in = ($user->uid)?true:false;
?>

<div id="wrapper">
  <div id="top-nav">
    <div id="progressbar"><div id="currentProgress"></div></div>
    <div id="logo"><a href="<?php print $base_url; ?>"><?php print $site_name; ?></a></div>
    <p id="settings"><a href="admin" target="_blank"></a></p>
    <?php print drupal_render($page['navigation']); ?>
  </div>
  <div id="main-container">
    <div class="col" id="right-side">
      <div class="padd">
        <div id="user-info">
          <div id="profile-pic"><img src="<?php print $theme_url ?>user.png" /></div>
          <p><a href="#profile">سمانه محبی</a></p>
        </div>
        <ul id="dashboard">
          <li id="dsh-home"><a href="#/">خانه</a></li>
          <li id="dsh-timeline"><a href="#/timeline">تایم‌لاین</a></li>
          <li id="dsh-subjects"><a href="#/subjects">موضوعات</a></li>
          <li id="dsh-followers"><a href="#/followers">دنبال کنندگان</a><span class="counter"><?php print isotope_persian_digits(isotope_get_follower_count('user',$user->uid)); ?></span></li>
          <li id="dsh-following"><a href="#/following">دنبال شوندگان</a><span class="counter"><?php print isotope_persian_digits(isotope_get_flag_count('user',$user->uid)); ?></span></li>
          <li id="dsh-bookmarks"><a href="#/bookmarks">مطالب برگزیده</a></li>
        </ul>
      </div>
    </div>
    <div id="in-main">
      <div class="col" id="middle">
        <div id="midd-header">
          <h2><?php print $title; ?></h2>
        </div>
        <div id="main" class="grid">
            <?php print drupal_render($page['content']); ?>
        </div>
      </div>
      <div class="col" id="left-side">
        <div class="padd">
          <?php print drupal_render($page['left_side']); ?>
        </div>
      </div>
    </div>
  </div>
</div>