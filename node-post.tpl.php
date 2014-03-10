<div class="node <?php print $classes ?>" id="node-<?php print $node->nid; ?>">
  <div class="node-inner">
    <?php if ($teaser): ?>
	  <div class="content"><?php print $content; ?></div>  
  	  <h2 class="title"><a href="<?php print $node_url; ?>" title="<?php print check_plain($title); ?>"><?php print truncate_utf8($title, 70, TRUE, TRUE); ?></a></h2>
	  <?php if ($submitted): ?>
	    <div class="submitted">by <strong><?php print in_transition_realname_links($node); ?></strong>		
        
        <?php
	      if (user_access('access comments')) {

	 	    $all = comment_num_all($node->nid);

	 	    $links = $node->links;

	 	    if ($all) {
	 	      $new = comment_num_new($node->nid);
	 		  
	 		  $links['comment_comments'] = array(
				'title' => format_plural($all, '(1)', '(@count)'),
 				'href' => "node/$node->nid",
	 			'attributes' => array('title' => t('Jump to the first comment of this posting.')),					 						        										
				'fragment' => 'comments'
			  );

      		  
    	      if ($new) {
		        $links['comment_new_comments'] = array(
			      'title' => format_plural($new, ' new', ' new'),
			      'href' => "node/$node->nid",
			      'attributes' => array('title' => t('Jump to the first new comment of this posting.')),															
			      'fragment' => 'new'
			    );
              }
	 	    }
	      }
	    ?>

	<?php print theme_links($links, $attributes = array('class' => 'links-inline')); ?>
	  	</div>
    <?php endif; ?>
<?php endif; ?>
<!--End Teaser Only-->

<!--Page Only -->
<?php if ($page): ?>
  <?php if ($unpublished) : ?>
    <div class="unpublished"><?php print t('Unpublished'); ?></div>
  <?php endif; ?>
  <?php if ($submitted): ?>
	<div class="submitted-post">
	  <p>by <strong><?php print in_transition_realname_links($node); ?></strong><?php print in_transition_university_affiliation($node); ?><br /><?php print t('!date', array('!date' => format_date($node->created, 'custom', 'F d, Y – H:i'))); ?></p>
	</div>
  <?php endif; ?>
  <div class="content"><?php print $content; ?></div>
    <?php if (count($taxonomy)): ?>
	  <div class="taxonomy"><?php print in_transition_taxonomy_links($node, 1); ?></div>
    <?php endif; ?>
  <?php endif; ?>
  </div>
</div>