<?php

/**
 * @file
 * Contains theme override functions and preprocess functions for the theme.
 */
function in_transition_preprocess_search_result(&$vars) {

  $info = array();

  $result = $vars['result'];

  $vars['url'] = check_url($result['link']);

  $vars['title'] = check_plain($result['title']);

  if ($result['type'] == 'Post') {
    $vars['title'] = truncate_utf8($vars['title'], 50, TRUE, TRUE);
  }

  $vars['thumbnail'] = $result['node']->ss_thumbnail;

  // to-do
  if (!$vars['thumbnail']) {
    $vars['thumbnail'] = '<img src="http://mediacommons.futureofthebook.org/imr/files/theme-weeks/tw-placeholder.png" alt="thumbnail" />';
  }

  if (!empty($result['type'])) {
    $info['type'] = check_plain($result['type']);
  }
  
  if (!empty($result['user'])) {
    $info['user'] = $result['user'];
  }
  
  if (!empty($result['date'])) {
    $info['date'] = format_date($result['date'], 'small');
  }
  
  if (isset($result['extra']) && is_array($result['extra'])) {
    $info = array_merge($info, $result['extra']);
  }
  
  // Check for existence. User search does not include snippets.
  $vars['snippet'] = isset($result['snippet']) ? $result['snippet'] : '';
  
  $vars['contributor'] = $info['user'];

  // Provide separated and grouped meta information.
  $vars['info_split'] = $info;
  
  $vars['info'] = implode(' - ', $info);
  
  // Provide alternate search result template.
  $vars['template_files'][] = 'search-result-'. $vars['type'];

}

/** Theme the taxonomy links From http://drupal.org/node/133223#comment-634019 */
function in_transition_taxonomy_links($node, $vid) {

  $output = '';
  $tags = array();
  
  // if the current node has taxonomy terms, get them
  if (count($node->taxonomy)) {

    foreach ($node->taxonomy as $term) {
      if ($term->vid == $vid) {
        $tags[] = l($term->name, taxonomy_term_path($term), array('attributes' =>  array('rel' => 'tag', 'title' => check_plain($term->name))));
      }
	}
	
    if (!empty($tags)) {
	  //get the vocabulary name and name it $name
      $vocab = taxonomy_vocabulary_load($vid);
	  $output .= '<ul class="' . $vocab->name . '"><li><span>' . $vocab->name . '</span><br /> ' . implode(' |  </li><li>', $tags) . '</li></ul>';
    }
    
  }

  return $output;

}

/** 
 * function to theme the comments and nodes to use real names from their profile $nodeOrComment 
 * needs to be passed either $node or $comment 
 */
function in_transition_realname_links($nodeOrComment) {

  $account = user_load(array('uid' => $nodeOrComment->uid));
  $realname = check_plain($account->profile_name);
  $output = '';
  
  if (empty($realname)) {
    $output = t('!username', array('!username' => theme('username', $nodeOrComment)));
  } 
  else {
    $output = l(t('!realname', array('!realname' => $account->profile_name)), 'user/'. $nodeOrComment->uid, array('attributes' =>  array('title' => t("View !realname's profile", array('!realname' => $account->profile_name)),'class' => 'realname'))); 
  }
  
  return $output;
  
}

/**
 * function to theme the comments and nodes to use real names from their profile 
 * $nodeOrComment needs to be passed either $node or $comment
 */ 
function in_transition_university_affiliation($nodeOrComment) {

  $account = user_load(array('uid' => $nodeOrComment->uid)); 
  $university = check_plain($account->profile_affiliation);
  $output = '';

  if (!empty($university)) {
    $output = t(' — @university', array('@university' => $account->profile_affiliation));
  }

  return $output;

}

/*  Theme week page */
function in_transition_themeweek($post, $placeholder, $truncChar) {

	$item_id = $post[0]['nid'];
	$pl_id = $placeholder[0]['view'];
	$truncChar2 = $truncChar + 18;
	$theme_week_item = node_load($item_id);
	$theme_week_item = node_build_content($theme_week_item, FALSE, FALSE);
	$account = user_load(array('uid' => $theme_week_item->uid)); 
	$emImage = $theme_week_item->field_image_embed[0]['value'];
	$image = $theme_week_item->field_tease_image[0]['filepath'];
	$twT = truncate_utf8($theme_week_item->title,  $truncChar, TRUE, TRUE);
	$twP = truncate_utf8($pl_id, $truncChar2, TRUE, TRUE);
	
	if (empty($emImage) && empty($image) && empty($twP) && empty($twT)) {  print ''; }
	
        else {
	  print '<div class="twp"><div class="twp-teaser-image">';
	}

	if (empty($emImage) && empty($image) && !empty($twP) && empty($twT)) {
	  print '<img src="'.base_path().'files/theme-weeks/twp-placeholder.png" alt="Theme Week"  />';
	} 
	elseif(!empty($image)) {	
	  print '<img src="'.base_path().$theme_week_item->field_tease_image[0]["filepath"].'" alt="'.$theme_week_item->title.'"  />';
	} 
	elseif(!empty($emImage)) {
	  print check_markup($theme_week_item->field_image_embed[0]['safe']);
	}
 
	if (!empty($emImage) || !empty($image) || !empty($twP)) { print "</div>"; }
	
	/** Item  Title */	
	if (!empty($twT) || !empty($twP)) {
	  print '<div class="twp-node-teaser">';
	} 
	
	if (!empty($twT)) {
	  print '<h2>';
	  print l(t('!title', array('!title' => check_plain(truncate_utf8($theme_week_item->title,  $truncChar, TRUE, TRUE)))), $theme_week_item->path, array('html' => TRUE, 'attributes' => array('title' => t('!title', array('!title' => $theme_week_item->title)),'class' => 'title'))); 
	  print '<br />by <strong>';
	  print l(t('!realname', array('!realname' => check_plain($account->profile_name))), 'user/'.$theme_week_item->uid, array('html' => TRUE, 'attributes' => array('title' => t("View !realname's profile", array('!realname' => $account->profile_name)),'class' => 'realname'))); 
	  print '</strong></h2>';
	} 
	elseif (empty($twT) && !empty($twP)) {
	  print '<h2>' . $twP . '</h2>';
	} 

	if (!empty($twT) || !empty($twP)) {
	  print "</div>";
	} 

	if (empty($emImage) && empty($image) && empty($twP) && empty($twT)) {
	  print '';
	} 
	else {
	  print '</div>';
	}
}

/*  Theme week RSS */
function in_transition_themeweek_rss_image($post, $placeholder) {
	$item_id = $post[0]['nid'];
	$pl_id = $placeholder[0]['view'];
	$theme_week_item = node_load($item_id);
	$theme_week_item = node_build_content($theme_week_item, FALSE, FALSE);
	$emImage = $theme_week_item->field_image_embed[0]['safe'];
	$image = $theme_week_item->field_tease_image[0]['filepath'];
	$twT = truncate_utf8($theme_week_item->title,  $truncChar, TRUE, TRUE);
	$twP = truncate_utf8($pl_id, $truncChar2, TRUE, TRUE);

	$printDefault = '<img src="'.$base_url.'/files/theme-weeks/twp-placeholder.png" alt="Theme Week"  />';
	
	$printImage = '<img src="'.$base_url.'/'.$theme_week_item->field_tease_image[0]["filepath"].'" />';
	
	$printEmImage = check_markup($theme_week_item->field_image_embed[0]['safe']);

	if (empty($emImage) && empty($image) && !empty($twP) && empty($twT)) {
	  $img = $printDefault;
	} 
	elseif(!empty($image)) {	
	  $img =  $printImage;
	} 
	elseif(!empty($emImage)) {
	  $img =  $printEmImage;
	}
	
	return $img;
	
}
function in_transition_themeweek_rss_title($post, $placeholder, $truncChar) {

  $title = '';
  $item_id = $post[0]['nid'];
  $pl_id = $placeholder[0]['view'];
  $truncChar2 = $truncChar + 18;
  $theme_week_item = node_load($item_id);
  $theme_week_item = node_build_content($theme_week_item, FALSE, FALSE);
  $account = user_load(array('uid' => $theme_week_item->uid)); 
  $twT = truncate_utf8($theme_week_item->title,  $truncChar, TRUE, TRUE);
  $twP = truncate_utf8($pl_id, $truncChar2, TRUE, TRUE);
	
  if (!empty($twT)) {
    $title = '<h3>'.l(t('!title', array('!title' => truncate_utf8($theme_week_item->title,  $truncChar, TRUE, TRUE))), $theme_week_item->path, array('attributes' => array('title' => t('!title', array('!title' => $theme_week_item->title)), 'class' => 'title'))).' by <strong>'.l(t('!realname', array('!realname' => $account->profile_name)), 'user/'.$theme_week_item->uid, array('attributes' => array('title' => t("View !realname's profile", array('!realname' => $account->profile_name)),'class' => 'realname'))).'</strong></h3>';
  }
   
  elseif (empty($twT) && !empty($twP)) {
    $title = '<h3>'.$twP.'</h3>';
  }

  return $title;

}

function in_transition_themeweek_rss_body($post, $placeholder) {
	$body = NULL;
	
	$item_id = $post[0]['nid'];
	$pl_id = $placeholder[0]['view'];
	$theme_week_item = node_load($item_id);
	$theme_week_item = node_build_content($theme_week_item, FALSE, FALSE);
	$twT = $theme_week_item->title;
	$twP = $pl_id;
		
	if (!empty($twT)) {
	  $body = $theme_week_item->content['body']['#value'];
	} 

	return $body;
}
	
/** Theme week views teaser */
function in_transition_themeweek_views($post, $placeholder, $truncChar) {

  $item_id = $post;
  $pl_id = $placeholder;
  $truncChar2 = $truncChar + 18;
  $theme_week_item = node_load($item_id);
  $theme_week_item = node_build_content($theme_week_item, FALSE, FALSE);
  $account = user_load(array('uid' => $theme_week_item->uid)); 
  $emImage = $theme_week_item->field_image_embed[0]['value'];
  $image = $theme_week_item->field_tease_image[0]['filepath'];
  $twT = truncate_utf8($theme_week_item->title,  $truncChar, TRUE, TRUE);
  $twP = truncate_utf8($pl_id, $truncChar2, TRUE, TRUE);
	
  /** Item  Image*/	
  if (!empty($emImage) && !empty($image) && !empty($twP) && !empty($twT)) {
    print '<div class="twp"><div class="twp-teaser-image">';
  }

  if (empty($emImage) && empty($image) && !empty($twP) && empty($twT)) {
    print '<img src="' . base_path() . 'files/theme-weeks/twp-placeholder.png" alt="Theme Week" />';
  }
	 
  elseif (!empty($image)) {	
    print '<img src="' . base_path() . $theme_week_item->field_tease_image[0]["filepath"].'" alt="'.$theme_week_item->title.'"  />';
  }
	 
  elseif (!empty($emImage)) {
    print check_markup($theme_week_item->field_image_embed[0]['safe']);
  }

  if (!empty($emImage) || !empty($image) || !empty($twP)) {
    print '</div>';
  }

  /** Item  Title */	
  if (!empty($twT) || !empty($twP)) {
    print '<div class="twp-node-teaser">';
  }

  if (!empty($twT)) {
    print '<h2>';
    print l(t('!title', array('!title' => check_plain(truncate_utf8($theme_week_item->title,  $truncChar, TRUE, TRUE)))), $theme_week_item->path, array('html' => TRUE, 'attributes' => array('title' => t('!title', array('!title' => $theme_week_item->title)),'class' => 'title'))); 
    print '<br />by <strong>';
    print l(t('!realname', array('!realname' => check_plain($account->profile_name))), 'user/'.$theme_week_item->uid, array('html' => TRUE, 'attributes' =>array('title' => t("View !realname's profile", array('!realname' => $account->profile_name)),'class' => 'realname'))); 
    print '</strong></h2>';
  }

  elseif (empty($twT) && !empty($twP)) {
    print '<h2>' . $twP . '</h2>';
  }

  if (!empty($twT) || !empty($twP)) {
    print '</div>';
  } 

  if (!empty($emImage) && !empty($image) && !empty($twP) && !empty($twT)) {
    print '</div>';
  }

}

/**
 * Removes the display of the log message from post form except for admins 
 * http://drupal.org/node/117148#comment-1192506
 */
function in_transition_node_form($form) {
  $form['revision_information']['#access'] = user_access('administer posts');
  return theme_node_form($form);
}

function in_transition_nodereview_teaser($review, $node) {
  if (!NODEREVIEW_FIVESTAR_ENABLE) {
    if($review['checked'] ==  1) {
	    $title .= $review['tag'];
	    $title .=  "TEMPLATE";
    }
    else {
	    $title .=  "TEMPLATE";
	  }
  }  
  return theme('box', $title, $output . $review['review']);
}


function in_transition_nodereview_review_body($review, $node) {

  $title = $output  = '';

  // get the axes from the url i.e. 
  if ( arg(0) == 'node' && is_numeric(arg(1)) && arg(2) == 'feedback' && is_numeric(arg(3)) ) {
    $arg = arg(3);
  }
	
  if (($review['checked'] ==  1 ) &&($review['aid'] == $arg)) {	  
    $title .= '<h4 class="feedback-title-'.$review['aid'].'">'.$review['tag'].'</h4>';
    if (!empty($review['review'])) {	  
      $output .= '<div class="feedback"><span class="feedback-more">Read feedback...</span><span class="feedback-hide">'.$review['review'].'</span></div>';
    }
  }
  
  return $title . $output;

}

function in_transition_load_nodereview_block($node) {

  global $user;
	
  // load the popups api for the links
  popups_add_popups();
	
  if ( arg(0) == 'node' && is_numeric(arg(1)) && ! arg(2) ) {
    $node = node_load(arg(1));
    $nodeId = $node->nid;
  }
	
  // Query the DB to see if there are any reviews
  $sql = "SELECT `nid` FROM {nodereview} WHERE `reviewed_nid` = %d ORDER BY `nid` DESC";

  $result = db_query_range(db_rewrite_sql($sql), $nodeId, 0, 10);

  // Count the reviews
  // TODO add check to make sure it is published
  $total = db_affected_rows($result);
	
  $result2 = db_query_range(db_rewrite_sql($sql), $nodeId, 0, 10);

  print '<div class="embedded-nodereview-form">';
	
  // Find the number of people who have revied this post 
  if ($total == 1) {
    print '<h4><strong>'.$total .' person</strong> reported using this</h4><br />';	
  }
 
  elseif($total > 1)  {
    print '<h4><strong>'.$total .' people</strong> reported using this</h4><br />';
  }

  while ($data = db_fetch_object($result2)) {	
    $review_node = node_load($data->nid);
    $current_user = $user->uid;
    $review_user = $review_node->uid;

    if ($review_user == $current_user){
      $reviewed_by_user = 1;
	  break;
    } 
    else {
      $reviewed_by_user = 0;
    }
  }

  $tag1_counter = $tag2_counter = $tag3_counter = $tag4_counter = $tag5_counter = 0;

  while ($data = db_fetch_object($result)) {	
    $review_node = node_load($data->nid);
    $review_node_reviews = $review_node->reviews;

    if ($review_node_reviews[1]['checked'] == 1) {
      $tag1_counter++; 
    }
	 
    if ($review_node_reviews[2]['checked'] == 1) {
      $tag2_counter++; 
    }
	
    if ($review_node_reviews[3]['checked'] == 1) {
      $tag3_counter++; 
    }

    if ($review_node_reviews[4]['checked'] == 1) {
      $tag4_counter++; 
    }

    if ($review_node_reviews[5]['checked'] == 1) {
      $tag5_counter++; 
    }
  }

  if (
    $tag1_counter >= 1 
    || 
    $tag2_counter >= 1 
    || 
    $tag3_counter >= 1 
    || 
    $tag4_counter >= 1 
    || 
    $tag5_counter >= 1 
  ) {
  	
    print '<ul class="nodereviews-list">';

    if ($tag1_counter == 1) {
      print '<li>Feedback on <strong>'. l($review_node_reviews[1]['tag'], 'node/'.$nodeId.'/feedback/1', array('html' => TRUE, 'attributes' => array('class' => 'popups-form-reload'))).'</strong> from '.$tag1_counter.' user</li>';
    }
	 
    elseif ($tag1_counter > 1)  {
      print '<li>Feedback on <strong>'. l($review_node_reviews[1]['tag'], 'node/'.$nodeId.'/feedback/1', array('html' => TRUE, 'attributes' => array('class' => 'popups-form-reload'))).'</strong> from '.$tag1_counter.' users</li>';
    }

    if ($tag2_counter == 1) {
      print '<li>Feedback on <strong>'. l($review_node_reviews[2]['tag'], 'node/'.$nodeId.'/feedback/2', array('html' => TRUE, 'attributes' => array('class' => 'popups-form-reload'))).'</strong> from '.$tag2_counter.' user</li>';
    }
	
	elseif($tag2_counter > 1)  {
      print '<li>Feedback on <strong>'. l($review_node_reviews[2]['tag'], 'node/'.$nodeId.'/feedback/2', array('html' => TRUE, 'attributes' => array('class' => 'popups-form-reload'))).'</strong> from '.$tag2_counter.' users</li>';
    }

    if ($tag3_counter == 1) {
      print '<li>Feedback on <strong>'. l($review_node_reviews[3]['tag'], 'node/'.$nodeId.'/feedback/3', array('html' => TRUE, 'attributes' => array('class' => 'popups-form-reload'))).'</strong> from '.$tag3_counter.' user</li>';
    }
	
	elseif($tag3_counter > 1)  {
      print '<li>Feedback on <strong>'. l($review_node_reviews[3]['tag'], 'node/'.$nodeId.'/feedback/3', array('html' => TRUE, 'attributes' => array('class' => 'popups-form-reload'))).'</strong> from '.$tag3_counter.' users</li>';
    }
	
    if ($tag4_counter == 1) {
      print '<li>Feedback on <strong>'. l($review_node_reviews[4]['tag'], 'node/'.$nodeId.'/feedback/4', array('html' => TRUE, 'attributes' => array('class' => 'popups-form-reload'))).'</strong> from '.$tag4_counter.' user</li>';
    }
	
    elseif($tag4_counter > 1)  {
      print '<li>Feedback on <strong>'. l($review_node_reviews[4]['tag'], 'node/'.$nodeId.'/feedback/4', array('html' => TRUE, 'attributes' => array('class' => 'popups-form-reload'))).'</strong> from '.$tag4_counter.' users</li>';
    }
	
    if ($tag5_counter == 1) {
      print '<li>Feedback on <strong>'. l($review_node_reviews[5]['tag'], 'node/'.$nodeId.'/feedback/5', array('html' => TRUE, 'attributes' => array('class' => 'popups-form-reload'))).'</strong> from '.$tag5_counter.' user</li>';	
    }
	
	elseif($tag5_counter > 1)  {
      print '<li>Feedback on <strong>'. l($review_node_reviews[5]['tag'], 'node/'.$nodeId.'/feedback/5', array('html' => TRUE, 'attributes' => array('class' => 'popups-form-reload'))).'</strong> from '.$tag5_counter.' users</li>';
    }

	print '</ul>';

  }	

  // print out user edit review link
  $account = user_load(array('uid' => $user->uid)); 

  if ($reviewed_by_user == 1) {
    $account = user_load(array('uid' => $user->uid)); 
    $realname = check_plain($account->profile_name);
    if (empty($realname)) {
      print  '<h4><strong>'.$user->name.'</strong>'.l(' edit your review', 'node/'.$nodeId.'/editreview', array('html' => TRUE, 'attributes' => array('class' => 'popups-form-reload'))).'</h5>';	
    } 
    else {
      print '<h4><strong>'.$account->profile_name.'</strong>'.l(' edit your review', 'node/'.$nodeId.'/editreview', array('html' => TRUE, 'attributes' => array('class' => 'popups-form-reload'))).'</h4>';
    }	
  }

  // if the SQL returns 0 = No reviews 
  if (($total == 0)  && (!$user->uid)) {
	print '<h4>No one has reviewed this post&hellip; but you need to '.l('login', 'user/login', array('html' => TRUE, 'attributes' => array('class' => 'popups-form-reload'))).' to submit feedback</h4>';
  }
 
  elseif(($total > 0)  && (!$user->uid)) {
	print '<h4>You need to '.l('login', 'user/login', array('html' => TRUE, 'attributes' => array('class' => 'popups-form-reload'))).' to submit feedback or edit your feedback of this post!</h4>';	
  }
   
  elseif(($total == 0)  && ($user->uid)) {	
	print '<h4>No one has reviewed this post&hellip; be the first</h4><br />';
	print in_transition_nodereview_add_form(); 
  }
   
  elseif(($total > 0)  && ($user->uid)  && ($reviewed_by_user == 0)) {	
	print in_transition_nodereview_add_form();
  } 

  print '</div>';

}


function in_transition_nodereview_add_form() {
	
  include_once(drupal_get_path('module', 'node') . '/node.pages.inc');

  // create an empty $form_state array
  $form_state = array();

  // define the content type of the form you'd like to load
  $nodeType = 'nodereview';

  // create a string of the $form_id
  $form_id = $nodeType . '_node_form';

  // create a basic $node array
  $node = array('type' => $nodeType, 'uid' => $GLOBALS['user']->uid, 'name' => $GLOBALS['user']->name);

  // load the $form
  $form = drupal_retrieve_form($form_id, $form_state, $node);

  // prepare the $form
  drupal_prepare_form($form_id, $form, $form_state);

  print drupal_get_form($form_id, $node);

}


function in_transition_nodereview_edit_form() {
	
  include_once(drupal_get_path('module', 'node') . '/node.pages.inc');

  // create an empty $form_state array
  $form_state = array();

  // define the content type of the form you'd like to load
  $nodeType = 'nodereview';

  // create a string of the $form_id
  $form_id = $nodeType . '_node_form';

  // create a basic $node array
  $node = array('type' => $nodeType, 'uid' => $GLOBALS['user']->uid, 'name' => $GLOBALS['user']->name);

  // load the $form
  $form = drupal_retrieve_form($form_id, $form_state, $node);

  // prepare the $form
  drupal_prepare_form($form_id, $form, $form_state);

  print drupal_get_form($form_id, $node);
		
}

/* Alter the Comment and Post Node forms */
function in_transition_theme(&$existing, $type, $theme, $path) {
  $hooks = zen_theme($existing, $type, $theme, $path);
  $hooks['comment_form'] = array('arguments' => array('form' => NULL));
  $hooks['post_node_form'] = array('arguments' => array('form' => NULL)); 
  return $hooks;
}

/* remove input filters on comment forms except for admins */
function in_transition_comment_form($form) {

  // deactivate the input filter options of the form except for admins and editors
  global $user;
  
  if (($user->roles[3] != 'admin') && ($user->roles[4] != 'editor')) {
    $form['comment_filter']['format']['#prefix'] = '<div class="input-formats">'; 
    $form['comment_filter']['format']['#suffix'] = '</div>';    
  }

  return drupal_render($form);
}

/* remove input filters on post node forms except for admins and editors */
function in_transition_post_node_form($form) {

  // deactivate the input filter options of the form except for admins and editors 
  global $user;

  if (($user->roles[3] != 'admin') && ($user->roles[4] != 'editor')) {
    $form['body_field']['format']['#prefix'] = '<div class="input-formats">';
    $form['body_field']['format']['#suffix'] = '</div>';
    $form['field_video_embed_link'][0]['format']['#prefix'] = '<div class="input-formats">'; 
    $form['field_video_embed_link'][0]['format']['#suffix'] = '</div>';
  }

  // REMOVE LOG INFO.
  $form['revision_information']['#access'] = user_access('administer posts');
  
  // remove Preview button
  unset($form['buttons']['preview']);
    
  // fix buttons so they are at the bottom of the form
  $buttons = drupal_render($form['buttons']);
  
  return drupal_render($form) . $buttons;
  
}
