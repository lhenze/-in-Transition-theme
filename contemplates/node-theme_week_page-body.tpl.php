<div class="themeweek-container"> 
  <?php include_once 'sites/mediacommons.futureofthebook.org.intransition/themes/in_transition/template.php'; ?>
  <?php print in_transition_themeweek($field_featured_post_1, $node->field_featured_1_placeholder, 55); ?>
  <?php print in_transition_themeweek($field_featured_post_2, $node->field_featured_2_placeholder, 55); ?>
  <?php print in_transition_themeweek($field_featured_post_3, $node->field_featured_3_placeholder, 55); ?>
  <?php print in_transition_themeweek($field_featured_post_4, $node->field_featured_4_placeholder, 55); ?>
  <?php print in_transition_themeweek($field_featured_post_5, $node->field_feature_5_placeholder, 55); ?>
</div>
<?php 

  $twImage = $node->field_theme_week_image[0]['filename'];

  if (empty($twImage)) {
    print '<div class="theme_week_image"><img src="' . base_path() . 'files/theme-weeks/theme-week-default.png" alt="Theme Week" title="Theme Week"/></div>';
  }
  else {
    print '<div class="theme_week_image2"><img src="' . base_path() . $node->field_theme_week_image[0]['filepath'] . '" alt="' . $title . '" title="' . $title . '" /></div>';
  }
?>
<div class="theme_week_text"><?php print $node->content['body']['#value'] ?></div>
<div class="clear"></div>