<div class="themeweek-container"> 
  <?php include_once 'sites/mediacommons.futureofthebook.org.intransition/themes/in_transition/template.php'; ?>
  <?php print in_transition_themeweek($field_featured_post_1, $node->field_featured_1_placeholder, 40); ?>
  <?php print in_transition_themeweek($field_featured_post_2, $node->field_featured_2_placeholder, 40); ?>
  <?php print in_transition_themeweek($field_featured_post_3, $node->field_featured_3_placeholder, 40); ?>
  <?php print in_transition_themeweek($field_featured_post_4, $node->field_featured_4_placeholder, 40); ?>
  <?php print in_transition_themeweek($field_featured_post_5, $node->field_feature_5_placeholder, 40); ?>
</div>
<?php
  $twImage = $node->field_theme_week_image[0]['filename'];
  if (empty($twImage)) {
    print '<div class="theme_week_image"><img src="' . base_path() . 'files/theme-weeks/theme-week-default.png" alt="Theme Week" /></div>';
  }
  else {
    print '<div class="theme_week_image2"><img src="' . base_path() . $node->field_theme_week_image[0]['filepath'].'" alt="' . $title . '"  /></div>';
  }
?>
<h2 class="title-below"><a href="<?php print $node_url . $node->path ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
<div class="theme_week_text"><?php print $node->field_homepage_teaser_text[0]['safe'] ?></div>
<div class="clear"></div>
<div class="theme_week_bottom"></div>