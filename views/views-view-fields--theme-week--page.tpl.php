<?php
// $Id: views-view-fields.tpl.php,v 1.6 2008/09/24 22:48:21 merlinofchaos Exp $
/**
 * @file views-view-fields.tpl.php
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->separator: an optional separator that may appear before a field.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
?>
	<?php 
	print '<h1>';
	print l(t('!title', array('!title' => check_plain($row->node_title),)), 'node/'.$row->nid,  array('html' => TRUE, 'attributes' => array('title' => t('!title', array('!title' => $row->node_title)),'class' => 'title')));
	print '</h1>';
	?>

<div class="themeweek-container">	
	<?php print in_transition_themeweek_views($row->node_data_field_theme_week_check_field_featured_post_1_nid, $row->node_data_field_theme_week_check_field_featured_1_placeholder_value, 55); ?>
	<?php print in_transition_themeweek_views($row->node_data_field_theme_week_check_field_featured_post_2_nid, $row->node_data_field_theme_week_check_field_featured_2_placeholder_value, 55); ?>
	<?php print in_transition_themeweek_views($row->node_data_field_theme_week_check_field_featured_post_3_nid, $row->node_data_field_theme_week_check_field_featured_3_placeholder_value, 55); ?>
	<?php print in_transition_themeweek_views($row->node_data_field_theme_week_check_field_featured_post_4_nid, $row->node_data_field_theme_week_check_field_featured_4_placeholder_value, 55); ?>
	<?php print in_transition_themeweek_views($row->node_data_field_theme_week_check_field_featured_post_5_nid, $row->node_data_field_theme_week_check_field_feature_5_placeholder_value, 55); ?>
</div>

<?php $twImage = $fields['field_theme_week_image_fid']->content; 
	if (empty($twImage)) {
		print '<div class="theme_week_image"><img src="'.base_path().'files/theme-weeks/theme-week-default.png" alt="Theme Week"  /></div>';
	} else {
		print '<div class="theme_week_image">';
		print $fields['field_theme_week_image_fid']->content; 
		print '</div>';		
	}
?>
<div class="theme_week_text">
<?php print $row->node_data_field_theme_week_check_field_homepage_teaser_text_value; ?>
</div>
<div class="clear"></div>

<?php //print_r($row) ?>
