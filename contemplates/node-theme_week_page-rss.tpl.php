<?php
print $node->content['body']['#value'];
print "<ul>";
$img1 = in_transition_themeweek_rss_image($field_featured_post_1, $node->field_featured_1_placeholder);
$title1 = in_transition_themeweek_rss_title($field_featured_post_1, $node->field_featured_1_placeholder, 40);
$body1 = in_transition_themeweek_rss_body($field_featured_post_1, $node->field_featured_1_placeholder);
print "<li>";
print $img1;
print $title1;
print "</li>";
if(!empty($body1)){
print $body1;
}

$img2 = in_transition_themeweek_rss_image($field_featured_post_2, $node->field_featured_2_placeholder);
$title2 = in_transition_themeweek_rss_title($field_featured_post_2, $node->field_featured_2_placeholder, 40);
$body2 = in_transition_themeweek_rss_body($field_featured_post_2, $node->field_featured_2_placeholder);
print "<li>";
print $img2;
print $title2;
print "</li>";
if(!empty($body2)){
print $body2;
}

$img3 = in_transition_themeweek_rss_image($field_featured_post_3, $node->field_featured_3_placeholder);
$title3 = in_transition_themeweek_rss_title($field_featured_post_3, $node->field_featured_3_placeholder, 40);
$body3 = in_transition_themeweek_rss_body($field_featured_post_3, $node->field_featured_3_placeholder);
print "<li>";
print $img3;
print $title3;
print "</li>";
if(!empty($body3)){
print $body3;
}

$img4 = in_transition_themeweek_rss_image($field_featured_post_4, $node->field_featured_4_placeholder);
$title4 = in_transition_themeweek_rss_title($field_featured_post_4, $node->field_featured_4_placeholder, 40);
$body4 = in_transition_themeweek_rss_body($field_featured_post_4, $node->field_featured_4_placeholder);
print "<li>";
print $img4;
print $title4;
print "</li>";
if(!empty($body4)){
print $body4;
}

$img5 = in_transition_themeweek_rss_image($field_featured_post_5, $node->field_feature_5_placeholder);
$title5 = in_transition_themeweek_rss_title($field_featured_post_5, $node->field_feature_5_placeholder, 40);
$body5 = in_transition_themeweek_rss_body($field_featured_post_5, $node->field_feature_5_placeholder);
if(!empty($title5)){
print "<li>";
print $img5;
print $title5;
print "</li>";
print $body5;
}
print "</ul>";
?>